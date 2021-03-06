<?php

namespace App\Http\Controllers\Administrator;

use App\Entities\User;
use App\Entities\Organization;
use App\Http\Controllers\Controller;
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
            $validation = [
                'name' => 'required',
                'password' => 'required||confirmed',
                'password_confirmation' => 'required|same:password',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540',
                'language' => 'required|in:'.User::LOCALE_ID.','.User::LOCALE_EN,
            ];

            if ($type == User::ROLE_DEMAND) {
                $validation['email'] = ['required', 'email', new IsAllowedDomain];
            } else {
                $validation['email'] = 'required|email';
            }

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'email' => ucfirst(trans('common.email')),
                'password' => ucfirst(trans('common.password')),
                'password_confirmation' => ucfirst(trans('common.confirm_password')),
                'photo' => ucfirst(trans('common.photo')),
                'language' => ucfirst(trans('common.language')),
            ]);

            $messageBag = new MessageBag;
            $checkEmail = $userService->checkEmailExist($request->get('email'));

            if ($checkEmail) {
                $messageBag->add('email', trans('common.email_used'));
                return redirect()->route('administrator.user.create', ['type' => $type])->withErrors($messageBag);
            }

            if ($type != User::ROLE_ADMIN) {
                $org = false;

                if ($request->get('org')) {
                    $org = $orgService->findById($request->get('org'));
                }

                if (!$org) {
                    $messageBag->add('org', trans('common.invalid_institute'));
                    return redirect()->route('administrator.user.create', ['type' => $type])->withErrors($messageBag);
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
                $message = trans('common.create_success', ['object' => 'User']);
            } catch (Exception $e) {
                report($e);
                $alert = 'alert_error';
                $message = trans('common.create_failed', ['object' => 'User']);
            }

            return redirect()->route('administrator.user.index')->with($alert, $message);
        }

        if ($type == User::ROLE_SUPPLY) {
            $dataOrg = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        } elseif ($type == User::ROLE_DEMAND) {
            $dataOrg = $orgService->getOrgByType(Organization::TYPE_DEMAND);
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
                'active' => 'required',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540',
                'language' => 'required|in:'.User::LOCALE_ID.','.User::LOCALE_EN,
            ];

            if ($user->getAuthority() == User::ROLE_DEMAND) {
                $validation['email'] = ['required', 'email', new IsAllowedDomain];
            } else {
                $validation['email'] = 'required|email';
            }

            if (!empty($request->get('password'))) {
                $validation['password'] = 'required||confirmed';
                $validation['password_confirmation'] = 'required_with:password|required|same:password';
            }

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'email' => ucfirst(trans('common.email')),
                'password' => ucfirst(trans('common.password')),
                'password_confirmation' => ucfirst(trans('common.confirm_password')),
                'photo' => ucfirst(trans('common.photo')),
                'language' => ucfirst(trans('common.language')),
            ]);

            $messageBag = new MessageBag;
            $checkEmail = $userService->checkEmailExist($request->get('email'), $user->getId());

            if ($checkEmail) {
                $messageBag->add('email', trans('common.email_used'));
                return redirect()->route('administrator.user.update', ['id' => $user->getId()])->withErrors($messageBag);
            }

            if ($user->getAuthority() != User::ROLE_ADMIN) {
                $org = false;

                if ($request->get('org')) {
                    $org = $orgService->findById($request->get('org'));
                }

                if (!$org) {
                    $messageBag->add('org', trans('common.invalid_institute'));
                    return redirect()->route('administrator.user.update', ['id' => $user->getId()])->withErrors($messageBag);
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
                $message = trans('common.update_success', ['object' => 'User']);
            } catch (Exception $e) {
                $alert = 'alert_error';
                $message = trans('common.update_failed', ['object' => 'User']);
            }

            return redirect()->route('administrator.user.index')->with($alert, $message);
        }

        if ($user->getAuthority() == User::ROLE_SUPPLY) {
            $dataOrg = $orgService->getOrgByType(Organization::TYPE_SUPPLY);
        } elseif ($user->getAuthority() == User::ROLE_DEMAND) {
            $dataOrg = $orgService->getOrgByType(Organization::TYPE_DEMAND);
        } else {
            $dataOrg = [];
        }

        return view('user.update', compact('user', 'dataOrg'));
    }

    public function delete(AuthService $authService, UserService $userService, User $user)
    {
        if ($user->getId() == $authService->user()->getId()) {
            $alert = 'alert_error';
            $message = trans('common.self_delete_failed');

            return redirect()->route('administrator.user.index')->with($alert, $message);
        }

        try {
            $userService->delete($user);
            $alert = 'alert_success';
            $message = trans('common.delete_success', ['object' => 'User']);
        } catch (Exception $e) {
            report($e);
            $alert = 'alert_error';
            $message = trans('common.delete_failed', ['object' => 'User']);
        }

        return redirect()->route('administrator.user.index')->with($alert, $message);
    }

    public function enable(AuthService $authService, UserService $userService, User $user)
    {
        if ($authService->user()->getId() != $user->getId()) {
            $userService->enableUser($user);

            $alert = 'alert_success';
            $message = trans('common.update_success', ['object' => 'User']);

            return redirect()->route('administrator.user.index')->with($alert, $message);
        }

        return redirect()->route('administrator.user.index');
    }

    public function disable(AuthService $authService, UserService $userService, User $user)
    {
        if ($authService->user()->getId() != $user->getId()) {
            $userService->disableUser($user);

            $alert = 'alert_success';
            $message = trans('common.update_success', ['object' => 'User']);

            return redirect()->route('administrator.user.index')->with($alert, $message);
        }

        return redirect()->route('administrator.user.index');
    }

    public function ajaxDetailUser(Request $request, User $user)
    {
        if ($request->ajax()) {
            $data = [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'photo' => $user->getPhoto() ? url(url(User::UPLOAD_PATH.'/'.$user->getPhoto())) : url('img/avatar.png'),
                'org' => ($user->getOrg() instanceof Organization) ? $user->getOrg()->getName() : false,
                'authority' => $user->getAuthority(),
                'active' => $user->getIsActive()
            ];

            return response()->json($data);
        }

        return abort(404);
    }
}
