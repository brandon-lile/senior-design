<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBackstoryToBackground extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('character_generals', function(Blueprint $table)
        {
            $table->renameColumn('backstory', 'background');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('character_generals', function(Blueprint $table)
        {
            $table->renameColumn('background', 'backstory');
        });
    }

}
