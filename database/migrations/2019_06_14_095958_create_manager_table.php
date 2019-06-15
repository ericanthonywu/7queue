<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique()->index();
            $table->string('nickname');
            $table->string('email')->unique()->nullable()->index();
            $table->unsignedTinyInteger('email_st')->index()->nullable()->default(0);
            $table->string('emailtoken')->index()->nullable();
            $table->string('password');
            $table->unsignedTinyInteger('status')->default(0)->index();
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
        Schema::dropIfExists('manager');
    }
}
