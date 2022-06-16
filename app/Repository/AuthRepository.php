<?php

namespace App\Repository;

use App\Models\User;

class AuthRepository
{

    public static function isMobileNumberExist($mobileNumber)
    {

        return User::query()->where('mobile_number', $mobileNumber)->exists();
    }

    public static function createUser($mobileNumber)
    {

        User::query()->create([
            'mobile_number' => $mobileNumber,
        ]);
    }

    public static function setPassword($mobileNumber, $password)
    {

        User::query()->where('mobile_number', $mobileNumber)
            ->update([
                'password' => $password,
            ]);
    }

    public static function getPassword($mobileNumber)
    {

        $query = User::query()->select('password')
            ->where('mobile_number', $mobileNumber)
            ->first();

        if (!empty($query->password)) {

            return $query->password;
        }

        return null;
    }
}
