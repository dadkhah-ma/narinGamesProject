<?php

namespace App\Http\Middleware;

use Closure;

class GameUpdateValidationMiddleware
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

        $request->merge(['id' => $request->route('id')]);
        if ($isValidate = customValidation::validation($request, $this->validationRules($request->route('id')))) {

            return $isValidate;
        }

        return $next($request);
    }


    private function validationRules($id): array
    {

        return [
            'id' => 'required|exists:games,id',
            'title' => 'string|min:4|max:255|unique:games,id,' . $id,
            'description' => 'string|min:4|max:255',
        ];
    }
}
