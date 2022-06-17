<?php

namespace App\Http\Middleware;

use Closure;

class GameViewValidationMiddleware
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
            'id' => 'string|exists:games,id',
            'title' => 'string|min:4|max:255',
        ];
    }
}
