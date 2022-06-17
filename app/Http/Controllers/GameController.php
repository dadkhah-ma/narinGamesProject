<?php

namespace App\Http\Controllers;

use App\Repository\GameRepository;
use Illuminate\Http\Request;
use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

    public function view(Request $request)
    {

        return json_encode([
            'message' => 'The game list is :',
            'data' => [
                'games' => GameRepository::get($this->generateViewQueryConditions($request)),
            ]
        ]);
    }

    public function create(Request $request)
    {

        $game = GameRepository::create(
            Auth::id(),
            $request->input('title'),
            $request->has('description') ? $request->input('description') : null,
        );

        return response()->json([
            'message' => 'The game created successfully :',
            'data' => [
                'game' => $game,
            ]
        ], 201);
    }


    private function generateViewQueryConditions(Request $request)
    {

        $queryConditions = [];
        if ($request->has('id')) {

            array_push($queryConditions, [
                'id', '=', $request->input('id')
            ]);
        }

        if ($request->has('title')) {

            array_push($queryConditions, [
                'title', '%like%', $request->input('title')
            ]);
        }

        return $queryConditions;
    }
}
