<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->index();
            $table->string('file');
            $table->string('phone')->nullable();
            $table->string('url')->nullable();
            $table->string('lat', 50)->nullable();
            $table->string('long', 50)->nullable();
            $table->string('confirmation')->nullable();
            $table->unsignedInteger('order');
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
        Schema::dropIfExists('banner');
    }
}
