<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{

    use SoftDeletes;

    protected $perPage = "10";
    protected $table = "games";

    protected $fillable = [
        'title', 'description', 'created_by', 'updated_by', 'deleted_by'
    ];

    protected $hidden = [
        'deleted_at', 'deleted_by',
    ];

    public function createdBy()
    {

        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updatedBy()
    {

        return $this->hasOne(User::class, 'id', 'updated_by');
    }


}
