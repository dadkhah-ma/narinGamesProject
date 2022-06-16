<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserMigration extends Migration
{

    public function up()
    {

        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_number');
            $table->string('password');
        });
    }

    public function down()
    {

        Schema::drop('users');
    }
}
