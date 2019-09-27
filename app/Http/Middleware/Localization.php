<?php

namespace App\Http\Middleware;

use App;
use App\Entities\User;
use Closure;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = currentUser();

        if ($user instanceof User) {
            App::setLocale(currentUser()->getLocale());
        }

        return $next($request);
    }
}
