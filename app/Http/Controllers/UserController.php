<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Organization;
use App\Mail\VerificationMail;
use App\Services\Domain\UserService;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Rules\IsAllowedDomain;

class UserController extends Controller
{
    public function index(UserService $userService)
    {
        $page = request()->get('page');
        $data = $userService->paginateUser(request()->get('page'));

        return view('user.index', compact('data', 'page'));
    }

    public function create(Request $request, UserService $userService, OrgService $orgService, $type = null)
    {
        if ($request->method() == 'POST') {
            $messageBag = new MessageBag;

            $checkUserName = $userService->createQueryBuilder('u')->where('u.username = :username')
                ->setParameters([
                    'username' => $request->get('username')
                ])->getQuery()->getResult();

            if (!empty($checkUserName)) {
                $messageBag->add('username', 'Username sudah digunakan');
                return redirect()->route('user.create', ['type' => $type])->withErrors($messageBag);
            }

            $request->validate([
                'name' => 'required',
                'username' => 'required',
                'password' => 'required||confirmed',
                'password_confirmation' => 'required|same:password',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540',
            ]);

            try {
                $requestData = $request->all();
                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    if ($photo->move(User::UPLOAD_PATH, $photoName)) {
                        $requestData['uploaded_img'] = User::UPLOAD_PATH . '/' . $photoName;
                    }
                }

                $requestData['authority'] = $type;
                $org = $type <> User::ROLE_ADMIN ? $orgService->getRepository()->find($request->get('org')) : false;
                $userService->create(collect($requestData), $org);

                $alert = 'alert_success';
                $message = 'User ' . $type . ' berhasil ditambahkan.';
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = 'Tidak dapat menambah user ' . $type . '. Silakan kontak web administrator!';
            }

            return redirect()->route('user.index')->with($alert, $message);
        }

        $dataOrg = array();

        if ($type == User::ROLE_SUPPLY) {
            $dataOrg = $orgService->getRepository()->findBy(['type' => Organization::TYPE_SUPPLY,'levelunit' => 2]);
        } elseif ($type == User::ROLE_SUPPLY) {
            $dataOrg = $orgService->getRepository()->findBy(['type' => Organization::TYPE_DEMAND,'parentunit' => null]);
        }

        return view('user.create', ['type' => $type, 'dataOrg' => $dataOrg]);
    }

    public function update(Request $request, UserService $userService, User $user, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $messageBag = new MessageBag;

            $checkUserName = $userService->createQueryBuilder('u')->where('u.id != :id')->andWhere('u.username = :username')
                ->setParameters([
                    'id' => $user->getId(),
                    'username' => $request->get('username')
                ])->getQuery()->getResult();

            if (!empty($checkUserName)) {
                $messageBag->add('username', 'Username sudah digunakan');
                return redirect()->route('update.profile', ['id' => $user->getId()])->withErrors($messageBag);
            }

            $validate = [
                'name' => 'required',
                'username' => 'required',
                'isactive' => 'required',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540',
            ];

            if (!empty($request->get('password'))) {
                $validate['password'] = 'required||confirmed';
                $validate['password_confirmation'] = 'required_with:password|required|same:password';
            }

            $request->validate($validate);

            try {
                $requestData = $request->all();
                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();

                    if ($photo->move(User::UPLOAD_PATH, $photoName)) {
                        $requestData['uploaded_img'] = User::UPLOAD_PATH . '/' . $photoName;
                    }
                }

                $requestData['authority'] = $user->getAuthority();
                $org = $user->getAuthority() <> User::ROLE_ADMIN ? $orgService->getRepository()->find($request->get('org')) : false;
                $userService->update($user, collect($requestData), $org);
                $alert = 'alert_success';
                $message = 'User ' . $user->getName() . ' berhasil diubah.';
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = 'Tidak dapat mengubah user ' . $user->getName() . '. Silakan kontak web administrator!';
            }

            return redirect()->route('user.index')->with($alert, $message);
        }

        $dataOrg = array();
        if ($user->getAuthority() == User::ROLE_SUPPLY) {
            $dataOrg = $orgService->getRepository()->findBy(['type' => Organization::TYPE_SUPPLY,'levelunit' => 2]);
        } elseif ($user->getAuthority() == User::ROLE_SUPPLY) {
            $dataOrg = $orgService->getRepository()->findBy(['type' => Organization::TYPE_DEMAND,'parentunit' => null]);
        }
        
        // if ($user->getAuthority() <> User::ROLE_ADMIN) {
        //     $dataOrg = $orgService->getRepository()->findBy(['tipe' => $user->getOrg()->getType(),'parentunit' => null]);
        // }

        return view('user.update', compact('user', 'dataOrg'));
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
                // $photoName = $photo->hashName();
                // if ($photo->move(User::UPLOAD_PATH, $photoName)) {
				$request->merge([
					'uploaded_img' => User::UPLOAD_PATH . '/' . $photoName
				]);
                // }
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

        return view('user.register');
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
        return view('user.verify-form');
    }

    public function delete(userService $userService, user $user)
    {
        try {
            $userService->delete($user);
            $alert = 'alert_success';
            $message = 'User berhasil dihapus.';
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = 'Tidak dapat menghapus user. Silakan kontak web administrator!';
        }

        return redirect()->route('user.index')->with($alert, $message);
    }
}
