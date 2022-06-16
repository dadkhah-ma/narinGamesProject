<?php

namespace App\Http\Middleware;

use Closure;
use App\Repository\AuthRepository;

class AuthMobileNumberMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!(AuthRepository::isMobileNumberExist($request->input('mobile_number')))) {

            AuthRepository::createUser($request->input('mobile_number'));
        }

        return $next($request);
    }

}
