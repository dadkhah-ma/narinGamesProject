<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function getAuthCode(Request $request)
    {

        $authCode = $this->generateAuthCode();
        $password = app('hash')->make($authCode);
        $mobileNumber = $request->input('mobile_number');

        AuthRepository::setPassword($mobileNumber, $password);

        return json_encode([
            'message' => 'The auth code is :',
            'data' => [
                'auth_code' => $authCode,
            ]
        ]);
    }

    public function login(Request $request)
    {

        $attempt = [
            'password' => $request->input('auth_code'),
            'mobile_number' => $request->input('mobile_number'),
        ];

        return response()->json([
            'message' => 'Login was successful',
            'data' => [
                'token_type' => 'bearer',
                'access_token' => Auth::attempt($attempt),
                'expires_in' => Auth::factory()->getTTL()
            ]
        ], 200);
    }

    private function generateAuthCode()
    {

        return rand(1, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
    }

}
