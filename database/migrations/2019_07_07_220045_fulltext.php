<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fulltext extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `merchants` ADD FULLTEXT(nickname)");
        DB::statement("ALTER TABLE `manager` ADD FULLTEXT(nickname)");
        DB::statement("ALTER TABLE `products` ADD FULLTEXT(nama)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
