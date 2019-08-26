<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use App\Services\Application\AuthService;
use App\Services\Domain\UserService;
use Hash;

class UtilityController extends Controller
{

    public function dashboard()
    {
        return view('dashboard');
    }

    public function updateProfile(Request $request, User $user, UserService $userService, AuthService $authService)
    {
        $currentUser = $authService->user(); 
        if ($request->post()) {
            $checkUserName = $userService->createQueryBuilder('u')->where('u.id != :id')->andWhere('u.username = :username')
            ->setParameters([
                'id'        => $currentUser->getId(), 
                'username'  =>  $request->get('username')
            ])->getQuery()->getResult();

            if (!empty($checkUserName)) {
                $request->session()->flash('username', 'Username sudah digunakan');
                return redirect()->route('update.profile',['id'=>$currentUser->getId()]);
            }

            if (!\Hash::check($request->post('old_password'), $currentUser->getPassword())) {
                $request->session()->flash('old_password', 'Password lama salah');
                return redirect()->route('update.profile',['id'=>$currentUser->getId()]);
            }

            $request->validate([
                'photo'                 => 'mimes:jpeg,jpg,png,bmp|max:540',
                'name'                  => 'required',
                'username'              => 'required',
                'password'              => 'required||confirmed',
                'password_confirmation' => 'required|same:password',
            ]);

            try {
                $requestData = $request->all();
                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = $photo->hashName();
                    if ($photo->move(\App\Http\Controllers\UserController::$uploadPath, $photoName)) {
                        $requestData['uploaded_img'] = \App\Http\Controllers\UserController::$uploadPath .'/'. $photoName;
                    }
                }
                $request->session()->flash('success', 'Profil Berhasil Disimpan');
                $user = $userService->updateProfile($user, collect($requestData));

            } catch (\Exception $e) {
                $request->session()->flash('error', 'Profil Gagal Disimpan');
            }

        }
        return view('user/update_profile', ['user' => $currentUser]);
    }
}
