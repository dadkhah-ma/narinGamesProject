<?php

namespace App\Http\Middleware;

use Closure;
use App\Repository\AuthGetCodeRepository;

class AuthGetCodeMobileNumberMiddleware
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

        if (!(AuthGetCodeRepository::isMobileNumberExist($request->input('mobile_number')))) {

            AuthGetCodeRepository::createUser($request->input('mobile_number'));
        }

        return $next($request);
    }

}
