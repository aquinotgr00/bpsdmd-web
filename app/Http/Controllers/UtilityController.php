<?php

namespace App\Http\Controllers;

use Exception;
use Hash;
use Illuminate\Http\Request;
use App\Entities\User;
use App\Services\Application\AuthService;
use App\Services\Domain\UserService;
use Illuminate\Support\MessageBag;

class UtilityController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.index');
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

    public function updateProfile(Request $request, User $user, UserService $userService, AuthService $authService)
    {
        $currentUser = $authService->user();
        if ($request->post()) {

            $messageBag = new MessageBag;

            $checkUserName = $userService->createQueryBuilder('u')->where('u.id != :id')->andWhere('u.username = :username')
                ->setParameters([
                    'id' => $currentUser->getId(),
                    'username' => $request->get('username')
                ])->getQuery()->getResult();

            if (!empty($checkUserName)) {
                $messageBag->add('username', 'Username sudah digunakan');
                return redirect()->route('update.profile')->withErrors($messageBag);
            }

            if (!Hash::check($request->post('old_password'), $currentUser->getPassword())) {
                $messageBag->add('old_password', 'Password lama salah');
                return redirect()->route('update.profile')->withErrors($messageBag);
            }

            $validate = [
                'name' => 'required',
                'username' => 'required',
                'photo' => 'mimes:jpeg,jpg,png,bmp|max:540',
                'language' => 'required|in:'.User::LOCALE_ID.','.User::LOCALE_EN,
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

                $request->session()->flash('success', 'Profil Berhasil Disimpan');
                $userService->updateProfile($user, collect($requestData));
            } catch (Exception $e) {
                $request->session()->flash('error', 'Profil Gagal Disimpan');
            }
        }

        return view('user/update_profile', ['user' => $currentUser]);
    }
}
