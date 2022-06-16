<?php


namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class customValidation
{

    public static function validation(Request $request,$rules)
    {

        $validator = Validator::make($request->all(), $rules);

        if (!empty($validator->errors()->all())) {

            return response()->json([
                'message' => 'unsuccessful',
                'data' => [
                    'errors' => $validator->errors()->all()
                ]
            ], 422);
        }

        return false;
    }
}
