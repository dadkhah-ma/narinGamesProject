<?php

namespace App\Http\Middleware;

use Closure;

class AuthGetCodeValidationMiddleware
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

        if ($isValidate = customValidation::validation($request, $this->validationRules())) {

            return $isValidate;
        }

        return $next($request);
    }


    private function validationRules(): array
    {

        return [
            'mobile_number' => ['required', 'string', 'min:11', 'max:11', 'regex:/^(\+98|0098|98|0)?9\d{9}$/'],
        ];
    }
}
