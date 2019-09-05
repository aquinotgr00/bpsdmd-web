<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Organization;
use App\Services\Domain\UserService;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use Illuminate\Support\Facades\Hash;

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
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'org' => 'required',
                'image_file' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($request->hasFile('image_file')) {
                $photo = $request->file('image_file');
                $photoName = $photo->hashName();
                if ($photo->move(User::UPLOAD_PATH, $photoName)) {
                    $request->merge([
                        'uploaded_image' => User::UPLOAD_PATH . '/' . $photoName
                    ]);
                }
            }
            $username = strtolower(preg_replace('/\s+/', '_', $request->name));
            $request->merge([
                'username' => $username,
                'password' => Hash::make('password'),
                'authority' => 'supply',
                'isActive' => 0
            ]);
            $org = $request->authority <> User::ROLE_ADMIN ? $orgService->getRepository()->find($request->get('org')) : false;
            $userService->create(collect($request->all()), $org);
            return redirect()->route('login')->with('alert_success', 'Silahkan cek email anda untuk aktivasi.');
        }

        return view('user.register');
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
