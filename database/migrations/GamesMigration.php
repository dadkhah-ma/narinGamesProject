<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GamesMigration extends Migration
{

    public function up()
    {

        Schema::dropIfExists('games');

        Schema::create('games', function (Blueprint $table) {

            $table->id();
            $table->string('title', 255);
            $table->string('description', 255);

            $table->bigInteger('created_by');
            $table->timestamp('created_at')
                ->useCurrent();
            $table->bigInteger('updated_by');
            $table->timestamp('updated_at')
                ->useCurrent()
                ->useCurrentOnUpdate();
            $table->bigInteger('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->index([
                'created_by',
                'updated_by',
                'deleted_by',
            ]);
        });
    }

    public function down()
    {

        Schema::drop('games');
    }
}
