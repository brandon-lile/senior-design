<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpellsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spells', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('class');
            $table->text('desc');
            $table->string('cast_time');
            $table->string('duration');
            $table->string('range');
            $table->string('component');
            $table->tinyInteger('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spells');
    }

}
