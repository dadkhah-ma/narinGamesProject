<?php

namespace App\Http\Middleware;

use Closure;
use App\Repository\GameRepository;

class GameViewCheckIdMiddleware
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

        if ($request->has('id') && (!GameRepository::isIdExist($request->input('id')))) {

            return response()->json([
                'message' => 'The game is not exist',
            ], 422);
        }

        return $next($request);
    }
}
