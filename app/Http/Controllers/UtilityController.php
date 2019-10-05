<?php

namespace App\Http\Controllers;

use App\Rules\IsAllowedDomain;
use App\Services\Application\UtilityService;
use Exception;
use Hash;
use Illuminate\Http\Request;
use App\Entities\User;
use App\Services\Application\AuthService;
use App\Services\Domain\UserService;
use Illuminate\Support\MessageBag;

class UtilityController extends Controller
{
    public function dashboard(UtilityService $utilityService)
    {
        list($countSchools, $countTeachers, $countStudents, $countShortCourses, $dataGraphTrend) = $utilityService->getDataForDashboard();

        return view('dashboard.index', compact('countSchools', 'countTeachers', 'countStudents', 'countShortCourses', 'dataGraphTrend'));
    }

    public function dataSchool()
    {
        return view('dashboard.school');
    }

    public function dataLecturer()
    {
        return view('dashboard.lecturer');
    }

    public function dataCadet()
    {
        return view('dashboard.cadet');
    }

    public function dataCourse()
    {
        return view('dashboard.course');
    }

    public function updateProfile(Request $request, UserService $userService, AuthService $authService)
    {
        $currentUser = $authService->user();

        if ($request->post()) {
            $messageBag = new MessageBag;
            $checkEmail = $userService->checkEmailExist($request->get('email'), $currentUser->getId());

            if ($checkEmail) {
                $messageBag->add('email', trans('common.email_used'));
                return redirect()->route('user.update', ['id' => $currentUser->getId()])->withErrors($messageBag);
            }

            $validation = [
                'name' => 'required',
                'email' => 'required',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540',
                'language' => 'required|in:'.User::LOCALE_ID.','.User::LOCALE_EN,
            ];

            if ($currentUser->getAuthority() == User::ROLE_DEMAND) {
                $validation['email'] = ['required', 'email', new IsAllowedDomain];
            } else {
                $validation['email'] = 'required|email';
            }

            if (!empty($request->get('password'))) {
                if (!Hash::check($request->post('old_password'), $currentUser->getPassword())) {
                    $messageBag->add('old_password', trans('common.wrong_password'));
                    return redirect()->route('update.profile')->withErrors($messageBag);
                }

                $validation['password'] = 'required||confirmed';
                $validation['password_confirmation'] = 'required_with:password|required|same:password';
            }

            $request->validate($validation, [], [
                'name' => ucfirst(trans('common.name')),
                'email' => ucfirst(trans('common.email')),
                'old_password' => ucfirst(trans('common.old_password')),
                'password' => ucfirst(trans('common.password')),
                'password_confirmation' => ucfirst(trans('common.confirm_password')),
                'photo' => ucfirst(trans('common.photo')),
                'language' => ucfirst(trans('common.language')),
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

                $request->session()->flash('success', trans('common.profile_success'));
                $userService->updateProfile($currentUser, collect($requestData));
            } catch (Exception $e) {
                $request->session()->flash('error', trans('common.profile_failed'));
            }

            return redirect()->route('update.profile')->withErrors($messageBag);
        }

        return view('user/update_profile', ['user' => $currentUser]);
    }
}
