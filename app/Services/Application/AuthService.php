<?php

namespace App\Services\Application;

use App\Entities\User;
use App\Exceptions\InvalidLogin;
use App\Exceptions\LoginException;
use App\Interfaces\UserInterface;
use App\Services\Domain\UserService;
use Hash;

class AuthService
{
    /** @var UserService $userService */
    private $userService;

    public function __construct()
    {
        $this->userService = app(UserService::class);
    }

    /**
     * @return bool
     * @throws InvalidLogin
     * @throws LoginException
     */
    public function authenticate()
    {
        $email = request()->get('email');
        $password = request()->get('password');

        $user = $this->userService->getRepository()->findOneBy([
            'email' => $email,
            'isActive' => 1,
            'isDelete' => 0,
        ]);

        if ($user instanceof UserInterface) {
            if (Hash::check($password, $user->getPassword())) {
                session()->put('logged', [
                    'id' => $user->getId(),
                    'authority' => $user->getAuthority(),
                ]);

                return true;
            }

            throw new InvalidLogin('Invalid login for ' . $email);
        }

        throw new LoginException('Cannot logging in for ' . $email);
    }

    /**
     * @return array|bool
     */
    public function check()
    {
        if (session()->has('logged')) {
            $logged = session()->get('logged');

            if (is_array($logged)) {
                if (isset($logged['id']) && isset($logged['authority'])) {
                    return [
                        'id' => $logged['id'],
                        'authority' => $logged['authority']
                    ];
                }
            }
        }

        return false;
    }

    /**
     * @return bool|User
     */
    public function user()
    {
        $currentUser = $this->check();

        if ($currentUser) {
            return $this->userService->getRepository()->find($currentUser['id']);
        }

        return false;
    }

    /**
     * @return void
     */
    public function logout()
    {
        session()->flush();
    }
}
