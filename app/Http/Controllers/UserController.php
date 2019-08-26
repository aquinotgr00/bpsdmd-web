<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Organization;
use App\Services\Domain\UserService;
use App\Services\Domain\OrgService;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public static $uploadPath         = 'users/img';

	public function index(UserService $userService)
	{
		$page = request()->get('page');
		$data = $userService->paginateorg(request()->get('page'));

		return view('user.index', compact('data', 'page'));
	}

	public function create($type = null, Request $request, UserService $userService, OrgService $orgService)
	{
		if ($request->method() == 'POST') {
			$checkUserName = $userService->createQueryBuilder('u')->where('u.username = :username')
			->setParameters([
				'username'  =>  $request->get('username')
			])->getQuery()->getResult();

			if (!empty($checkUserName)) {
				$request->session()->flash('username', 'Username sudah digunakan');
				return redirect()->route('user.create',['type' => $type]);
			}
			$request->validate([
				'name' 					=> 'required',
				'username' 				=> 'required',
				'password'              => 'required||confirmed',
				'password_confirmation' => 'required|same:password',
				'photo'                 => 'mimes:jpeg,jpg,png,bmp|max:540',
			]);
			try {
				$requestData = $request->all();
				if ($request->hasFile('photo')) {
					$photo = $request->file('photo');
					$photoName = $photo->hashName();
					if ($photo->move(self::$uploadPath, $photoName)) {
						$requestData['uploaded_img'] = self::$uploadPath .'/'. $photoName;
					}
				}
				
				$requestData['authority'] = $type;
				$org 		= $type <> User::ROLE_ADMIN ? $orgService->getRepository()->find($request->get('org')) : false;
				$userService->create(collect($requestData), $org);

				$alert 		= 'alert_success';
				$message 	= 'User '.$type.' berhasil ditambahkan.';

			} catch (\Exception $e) {
				report($e);
				$alert = 'alert_error';
				$message = 'Tidak dapat menambah user '.$type.'. Silakan kontak web administrator!';
			}

			return redirect()->route('user.index')->with($alert, $message);
		}

		$dataOrg = array();
		if ($type == User::ROLE_SUPPLY) {
			$dataOrg = $orgService->getRepository()->findBy(['type' => Organization::TYPE_SUPPLY]);
		}
		elseif ($type == User::ROLE_SUPPLY) {
			$dataOrg = $orgService->getRepository()->findBy(['type' =>Organization::TYPE_DEMAND]);
		}

		return view('user.create',['type' => $type, 'dataOrg' => $dataOrg]);
	}

	public function update(Request $request, UserService $userService, User $user, OrgService $orgService)
	{
		if ($request->method() == 'POST') {
			$checkUserName = $userService->createQueryBuilder('u')->where('u.id != :id')->andWhere('u.username = :username')
			->setParameters([
				'id'        => $user->getId(), 
				'username'  =>  $request->get('username')
			])->getQuery()->getResult();

			if (!empty($checkUserName)) {
				$request->session()->flash('username', 'Username sudah digunakan');
				return redirect()->route('update.profile',['id'=>$currentUser->getId()]);
			}
			$validate = [
				'name' 					=> 'required',
				'username' 				=> 'required',
				'photo'                 => 'mimes:jpeg,jpg,png,bmp|max:540',
			];
			if (!empty($request->get('pass'))) {
				$validate['password']              = 'required||confirmed';
				$validate['password_confirmation'] = 'required_with:password|required|same:password';
			}
			$request->validate($validate);

			try {
				$requestData = $request->all();
				if ($request->hasFile('photo')) {
					$photo = $request->file('photo');
					$photoName = $photo->hashName();
					if ($photo->move(self::$uploadPath, $photoName)) {
						$requestData['uploaded_img'] = self::$uploadPath .'/'. $photoName;
					}
				}
				$requestData['authority'] = $user->getAuthority();
				$org 		= $user->getAuthority() <> User::ROLE_ADMIN ? $orgService->getRepository()->find($request->get('org')) : false;

				$userService->update($user, collect($requestData), $org);
				
				$alert = 'alert_success';
				$message 	= 'User '.$user->getName().' berhasil diubah.';
			} catch (\Exception $e) {
				$alert = 'alert_error';
				$message = 'Tidak dapat mengubah user '.$user->getName().'. Silakan kontak web administrator!';
			}

			return redirect()->route('user.index')->with($alert, $message);
		}
		$dataOrg = array();
		if ($user->getAuthority() <> User::ROLE_ADMIN) {
			$dataOrg = $orgService->getRepository()->findBy(['type' => $user->getOrg()->getType()]);
		}

		return view('user.update', compact('user','dataOrg'));
	}

	public function delete(userService $userService, user $user)
	{
		try {
			$userService->delete($user);
			$alert = 'alert_success';
			$message = 'User berhasil dihapus.';
		} catch (\Exception $e) {
			dd($e->getMessage());
			report($e);
			$alert = 'alert_error';
			$message = 'Tidak dapat menghapus user. Silakan kontak web administrator!';
		}

		return redirect()->route('user.index')->with($alert, $message);
	}
}
