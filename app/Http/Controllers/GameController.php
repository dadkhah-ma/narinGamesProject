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
                'games' => GameRepository::getGames($this->generateViewQueryConditions($request)),
            ]
        ]);
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
