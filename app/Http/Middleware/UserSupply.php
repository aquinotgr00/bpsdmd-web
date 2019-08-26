<?php

namespace App\Http\Middleware;

use App\Entities\User;
use App\Services\Application\AuthService;
use Closure;
use Illuminate\Http\Request;

class UserSupply
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /** @var AuthService $authService */
        $authService = app(AuthService::class);

        if (session()->has('logged')) {
            $check = $authService->check();
            if ($check) {
                if ($check['authority'] == User::ROLE_SUPPLY) {
                    return $next($request);
                }
            }
        }

        return abort(404);
    }
}
