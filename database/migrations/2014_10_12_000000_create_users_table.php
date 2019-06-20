<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique()->index();
            $table->string('nickname')->unique()->index();
            $table->string('email')->unique()->index();
            $table->unsignedTinyInteger('email_st')->default(0);
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('email_token')->index()->nullable();
            $table->timestamp('email_expired')->nullable();
            $table->unsignedTinyInteger('status')->index();
            $table->timestamp('suspend_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
