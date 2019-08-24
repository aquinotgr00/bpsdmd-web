<?php

namespace App\Http\Middleware;

use App\Services\Application\AuthService;
use Closure;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return mixed|void
     */
    public function handle($request, Closure $next)
    {
        /** @var AuthService $authService */
        $authService = app(AuthService::class);

        if (session()->has('logged')) {
            if ($authService->check()) {
                return $next($request);
            }
        }

        return redirect(route('login'));
    }
}
