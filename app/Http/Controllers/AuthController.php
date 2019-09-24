<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Mail\VerificationMail;
use App\Rules\IsAllowedDomain;
use App\Services\Application\AuthService;
use App\Services\Domain\OrgService;
use App\Services\Domain\UserService;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Mail;

class AuthController extends Controller
{
    public function login(Request $request, AuthService $authService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            try {
                $authService->authenticate();

                return redirect(route('dashboard'));
            } catch (Exception $e) {
                report($e);
                $request->session()->flash('alert', 'Email atau password salah.');
            }
        }

        return view('auth.login');
    }

    public function logout(AuthService $authService)
    {
        $authService->logout();

        return redirect(route('login'));
    }

    public function register(Request $request, UserService $userService, OrgService $orgService)
    {
        if ($request->method() === 'POST') {
            $request->validate([                            // validate the request
                'name' => 'required|string',
                'email' => ['required', 'email', new IsAllowedDomain],
                'org' => 'required',
                'org_type' => 'required',
                'org_address' => 'required',
                'image_file' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->hasFile('image_file')) {          // if the request has image file in it
                $request->image_file->store(User::UPLOAD_PATH, 'public');
                $photoName = $request->file('image_file')->hashName();

                $request->merge([
                    'uploaded_img' => User::UPLOAD_PATH . '/' . $photoName
                ]);
            }

            $username = strtolower(preg_replace('/\s+/', '_', $request->name));     // create username
            $request->merge([                               // merge request
                'username' => $username,
                'password' => substr(str_shuffle(md5(time())), 0, 8),
                'authority' => 'demand',
                'isActive' => 0
            ]);
            $org = $request->authority <> User::ROLE_ADMIN ? $orgService->getRepository()->find($request->get('org')) : false;
            $user = $userService->create(collect($request->all()), $org);                   // create user

            $randomString = substr(str_shuffle(md5(time())), 0, 15);
            $url = env('APP_URL') . '/verify/' . $randomString . '/' . $user->getId();
            Mail::to($request->email)->send(new VerificationMail($url, $request));                // send verification email

            return redirect()->route('login')->with('alert', 'Silahkan cek email anda untuk aktivasi.');
        }

        return view('auth.register');
    }

    public function verifyUser(Request $request, $any, $id, UserService $userService)
    {
        if ($request->method() === 'POST') {
            $user = $userService->getRepository()->findOneBy([ 'id' => $id ]);
            if (Hash::check($request->old_password, $user->getPassword())) {
                if ($user->getIsActive() == 0) {
                    $userArr = [
                        'username' => $user->getUsername(),
                        'name' => $user->getName(),
                        'password' => $request->password,
                        'isActive' => 1
                    ];
                    $userService->updateProfile($user, collect($userArr));
                }

                return redirect()->route('login')->with('alert', 'Your account has been confirmed, go ahead and login.');
            }
            return redirect()->back()->with('alert', 'Your password is wrong.');
        }
        return view('auth.verify-form');
    }
}
