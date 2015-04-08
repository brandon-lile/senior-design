<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttackSpellsTable extends Migration {


	public function up()
	{
		Schema::create('attackSpells', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('sheet_id');
            $table->string('name');
            $table->tiny('atk_bonus');
            $table->string('dmg_type');
            $table->timestamps();
        });
	}


	public function down()
	{
		Schema::dropIfExists('attackSpells');
	}

}
