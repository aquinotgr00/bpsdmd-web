<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Mail\VerificationMail;
use App\Rules\IsAllowedDomain;
use App\Services\Application\AuthService;
use App\Services\Domain\OrgService;
use App\Services\Domain\UserService;
use Illuminate\Support\Facades\DB;
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
                'password' => 'required',
                'g-recaptcha-response' => 'required|captcha'
            ]);

            try {
                $authService->authenticate();

                return redirect(route('dashboard'));
            } catch (Exception $e) {
                report($e);
                $request->session()->flash('alert', trans('common.wrong_account'));
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
                'email' => ['required', 'email', 'unique:App\Entities\User,email', new IsAllowedDomain],
                'org' => 'required',
                'org_address' => 'required',
                'image_file' => 'image|mimes:jpeg,png,jpg|max:2048',
                'g-recaptcha-response' => 'required|captcha'
            ]);

            if ($request->hasFile('image_file')) {          // if the request has image file in it
                $request->file('image_file')->store(User::UPLOAD_PATH, 'public');
                $photoName = $request->file('image_file')->hashName();

                $request->merge([
                    'uploaded_img' => User::UPLOAD_PATH . '/' . $photoName
                ]);
            }

            $request->merge([                               // merge request
                'password' => substr(str_shuffle(md5(time())), 0, 8),
                'authority' => 'demand',
                'isActive' => 0
            ]);
            $org = $request->get('authority') <> User::ROLE_ADMIN ? $orgService->getRepository()->find($request->get('org')) : false;
            $user = $userService->create(collect($request->all()), $org);                   // create user

            $encryptedId = encrypt('activate-'.$user->getId());
            $url = env('APP_URL') .'/verify/'. $encryptedId;
            Mail::to($request->get('email'))->send(new VerificationMail($url, $request));                // send verification email

            return redirect()->route('login')->with('alert', trans('common.activate_account'));
        }

        $orgs = $orgService->getRepository()->findAll();

        return view('auth.register', compact('orgs'));
    }

    public function verifyUser(Request $request, $id, UserService $userService)
    {
        $decryptedId = decrypt($id);
        $id = explode("-", $decryptedId, 2);
        if ($request->method() === 'POST') {
            $user = $userService->getRepository()->findOneBy([ 'id' => $id[1] ]);
            if (Hash::check($request->get('old_password'), $user->getPassword())) {
                if ($user->getIsActive() == 0) {
                    $userArr = [
                        'email' => $user->getEmail(),
                        'name' => $user->getName(),
                        'password' => $request->get('password'),
                        'isActive' => 1,
                        'language' => 'id',
                    ];
                    $userService->updateProfile($user, collect($userArr));
                }

                return redirect()->route('login')->with('alert', trans('common.activate_success'));
            }

            return redirect()->back()->with('alert', trans('common.wrong_account'));
        }

        $user = $userService->getRepository()->findOneBy(['id' => $id[1]]);
        if ($user->getIsActive())
          return redirect('/');

        return view('auth.verify-form');
    }
}
