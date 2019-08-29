<?php

namespace App\Http\Controllers;

use App\Services\Application\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request, AuthService $authService)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            try {
                $authService->authenticate();

                return redirect(route('dashboard'));
            } catch (Exception $e) {
                report($e);
                $request->session()->flash('alert', 'Username atau password salah.');
            }
        }

        return view('login');
    }

    public function logout(AuthService $authService)
    {
        $authService->logout();

        return redirect(route('login'));
    }
}
