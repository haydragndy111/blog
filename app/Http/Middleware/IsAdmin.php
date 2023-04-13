<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Policies\UserPolicy;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if(auth()->guard($guard)->user()->can(UserPolicy::ADMIN, User::class)){
            return $next($request);
        }

        throw new HttpException(403, 'Forbidden');
    }
}
