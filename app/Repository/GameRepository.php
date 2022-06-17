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

    public static function get($queryConditions = [])
    {

        return Game::query()
            ->where($queryConditions)
            ->with(self::with())
            ->paginate();
    }

    public static function with()
    {

        return [
            'createdBy:id,mobile_number',
            'updatedBy:id,mobile_number',
        ];
    }

    public static function create($userId, $title, $description = null)
    {

        return Game::query()->create([
            'title' => $title,
            'description' => $description,
            'created_by' => $userId,
            'updated_by' => $userId,
        ]);
    }

    public static function update($id, $update)
    {

        return Game::query()
            ->where('id', $id)
            ->update($update);
    }

}
