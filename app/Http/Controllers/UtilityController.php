<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use App\Services\Application\AuthService;
use App\Services\Domain\UserService;
use Hash;

class UtilityController extends Controller
{
    public $upload_path         = 'users/img';
    public $upload_path_thumb   = 'users/img/thumb';
    public function dashboard()
    {
        return view('dashboard');
    }

    public function updateProfile(Request $request, User $user, UserService $userservice)
    {
        if ($request->post()) {
            if (!Hash::check($request->post('old_password'), $currentuser->getPassword())) {
                $request->session()->flash('old_password', 'Password lama salah');
                return redirect()->route('update.profile',['id'=>$currentuser->getId()]);
            }

            $request->validate([
                'photo'                 => 'mimes:jpeg,jpg,png,bmp|max:540',
                'name'                  => 'required',
                'password'              => 'required||confirmed',
                'password_confirmation' => 'required|same:password',
            ]);

            try {
                $requestData = $request->all();
                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoname = $photo->hashName();
                    if ($photo->move($this->upload_path, $photoname)) {
                        $requestData['uploaded_img'] = $this->upload_path .'/'. $photoname;
                    }
                }
                $request->session()->flash('success', 'Profil Berhasil Disimpan');
                $user = $userservice->update($user, collect($requestData));

            } catch (Exception $e) {
                $request->session()->flash('error', 'Profil Gagal Disimpan');
            }

        }
        return view('user/update_profile', ['user' => $user]);
    }
}
