<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterHpsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_hps', function(Blueprint $table){
            $table->increments('id');
            $table->integer('sheet_id');
            $table->integer('max');
            $table->integer('current');
            $table->integer('temp');
            $table->tinyInteger('dice_total');
            $table->tinyInteger('dice_type');
            $table->tinyInteger('death_save_fails');
            $table->tinyInteger('death_save_success');
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
        Schema::dropIfExists('character_hps');
    }

}
