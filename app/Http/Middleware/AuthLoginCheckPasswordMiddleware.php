<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;
use App\Repository\AuthRepository;


class AuthLoginCheckPasswordMiddleware
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

        $authCode = $request->input('auth_code');
        $password = AuthRepository::getPassword($request->input('mobile_number'));

        if (!(Hash::check($authCode, $password))) {

            return response()->json([
                'message' => 'The password and mobile number are not match',
            ], 403);
        }

        return $next($request);
    }

}
