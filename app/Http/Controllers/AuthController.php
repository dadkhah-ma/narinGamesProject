<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\AuthGetCodeRepository;

class AuthController extends Controller
{

    public function getAuthCode(Request $request)
    {

        $authCode = $this->generateAuthCode();
        $password = app('hash')->make($authCode);
        $mobileNumber = $request->input('mobile_number');

        AuthGetCodeRepository::setPassword($mobileNumber, $password);

        return json_encode([
            'message' => 'The auth code is :',
            'data' => [
                'auth_code' => $authCode,
            ]
        ]);
    }

    private function generateAuthCode()
    {

        return rand(1, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
    }

}
