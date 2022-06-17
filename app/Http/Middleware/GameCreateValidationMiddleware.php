<?php

namespace App\Http\Middleware;

use Closure;

class GameCreateValidationMiddleware
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
            'title' => 'required|string|min:4|max:255|unique:games',
            'description' => 'string|min:4|max:255',
        ];
    }
}
