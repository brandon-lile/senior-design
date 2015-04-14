<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterGeneralsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_generals',function(Blueprint $table){
            $table->increments('id');
            $table->integer('sheet_id');
            $table->string('char_name');
            $table->tinyInteger('race');
            $table->tinyInteger('class');
            $table->tinyInteger('level');
            $table->tinyInteger('backstory');
            $table->tinyInteger('alignment');
            $table->tinyInteger('age');
            $table->tinyInteger('height');
            $table->string('eyes');
            $table->string('skin');
            $table->string('hair');
            $table->integer('xp');
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
        Schema::dropIfExists('character_generals');
    }

}
