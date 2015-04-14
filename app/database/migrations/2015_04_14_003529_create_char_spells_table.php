<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharSpellsTable extends Migration {


    public function up()
    {
        Schema::create('char_spells', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('sheet_id');
            $table->integer('spell_id');
            $table->boolean('prepared');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('char_spells');
    }

}
