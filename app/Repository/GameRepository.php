<?php


namespace App\Repository;

use App\Models\Game;

class GameRepository
{

    public static function isIdExist($id)
    {

        return Game::query()
            ->where('id', $id)
            ->exists();
    }

    public static function getGames($queryConditions = [])
    {

        return Game::query()
            ->where($queryConditions)
            ->with(self::gameWith())
            ->paginate();
    }

    public static function gameWith()
    {

        return [
            'createdBy:id,mobile_number',
            'updatedBy:id,mobile_number',
        ];
    }

}
