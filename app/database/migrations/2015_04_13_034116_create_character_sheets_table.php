<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterSheetsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_sheets', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('char_pic', 40)->nullable()->default(null);
            $table->text('abilities');
            $table->tinyInteger('insp');
            $table->tinyInteger('armor_class');
            $table->tinyInteger('initiative');
            $table->mediumInteger('speed');
            $table->string('proficiencies');
            $table->string('attack_spell_notes');
            $table->string('equipment');
            $table->string('features');
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
        Schema::dropIfExists('character_sheets');
    }

}
