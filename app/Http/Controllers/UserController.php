<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Organization;
use App\Rules\IsAllowedDomain;
use App\Services\Application\AuthService;
use App\Services\Domain\UserService;
use App\Services\Domain\OrgService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Image;

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
            $request->validate([
                'name' => 'required',
                'email' => ['required', 'email', new IsAllowedDomain],
                'password' => 'required||confirmed',
                'password_confirmation' => 'required|same:password',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540',
            ]);

            $messageBag = new MessageBag;
            $checkEmail = $userService->checkEmailExist($request->get('email'));

            if ($checkEmail) {
                $messageBag->add('email', 'Email is already used!');
                return redirect()->route('user.create', ['type' => $type])->withErrors($messageBag);
            }

            if ($type != User::ROLE_ADMIN) {
                $org = $orgService->findById($request->get('org'));

                if (!$org) {
                    $messageBag->add('org', 'Organisasi tidak valid!');
                    return redirect()->route('user.create', ['type' => $type])->withErrors($messageBag);
                }
            } else {
                $org = false;
            }

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(User::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

                $requestData['authority'] = $type;
                $userService->create(collect($requestData), $org, true);

                $alert = 'alert_success';
                $message = 'User ' . $type . ' berhasil ditambahkan.';
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = 'Tidak dapat menambah user. Silakan kontak web administrator!';
            }

            return redirect()->route('user.index')->with($alert, $message);
        }

        if ($type == User::ROLE_SUPPLY) {
            $dataOrg = $orgService->getRepository()->findBy(['type' => Organization::TYPE_SUPPLY]);
        } elseif ($type == User::ROLE_DEMAND) {
            $dataOrg = $orgService->getRepository()->findBy(['type' => Organization::TYPE_DEMAND]);
        } else {
            $dataOrg = [];
        }

        return view('user.create', ['type' => $type, 'dataOrg' => $dataOrg]);
    }

    public function update(Request $request, UserService $userService, User $user, OrgService $orgService)
    {
        if ($request->method() == 'POST') {
            $validation = [
                'name' => 'required',
                'email' => ['required', 'email', new IsAllowedDomain],
                'active' => 'required',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540',
            ];

            if (!empty($request->get('password'))) {
                $validation['password'] = 'required||confirmed';
                $validation['password_confirmation'] = 'required_with:password|required|same:password';
            }

            $request->validate($validation);

            $messageBag = new MessageBag;
            $checkEmail = $userService->checkEmailExist($request->get('email'), $user->getId());

            if ($checkEmail) {
                $messageBag->add('email', 'Email is already used!');
                return redirect()->route('user.update', ['id' => $user->getId()])->withErrors($messageBag);
            }

            if ($user->getAuthority() != User::ROLE_ADMIN) {
                $org = $orgService->findById($request->get('org'));

                if (!$org) {
                    $messageBag->add('org', 'Organisasi tidak valid!');
                    return redirect()->route('user.update', ['id' => $user->getId()])->withErrors($messageBag);
                }
            } else {
                $org = false;
            }

            try {
                $requestData = $request->all();

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    $img = Image::make($photo->getRealPath())->fit(100);
                    $img->save(public_path(User::UPLOAD_PATH).'/'.$photoName);

                    $requestData['uploaded_img'] = $photoName;
                } else {
                    $requestData['uploaded_img'] = false;
                }

                $userService->update($user, collect($requestData), $org, true);

                $alert = 'alert_success';
                $message = 'User ' . $user->getName() . ' berhasil diubah.';
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = 'Tidak dapat mengubah user ' . $user->getName() . '. Silakan kontak web administrator!';
            }

            return redirect()->route('user.index')->with($alert, $message);
        }

        if ($user->getAuthority() == User::ROLE_SUPPLY) {
            $dataOrg = $orgService->getRepository()->findBy(['type' => Organization::TYPE_SUPPLY]);
        } elseif ($user->getAuthority() == User::ROLE_DEMAND) {
            $dataOrg = $orgService->getRepository()->findBy(['type' => Organization::TYPE_DEMAND]);
        } else {
            $dataOrg = [];
        }

        return view('user.update', compact('user', 'dataOrg'));
    }

    public function delete(AuthService $authService, UserService $userService, User $user)
    {
        if ($user->getId() == $authService->user()->getId()) {
            $alert = 'alert_error';
            $message = 'Tidak dapat menghapus diri sendiri.';

            return redirect()->route('user.index')->with($alert, $message);
        }

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
