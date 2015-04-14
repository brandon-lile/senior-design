<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignCharactersTable extends Migration {


	public function up()
	{
		Schema::create('campaign_characters', function(Blueprint $table)
		{
			$table->increments('id');
            $table ->integer('camp_id');
            $table->integer('sheet_id');
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::dropIfExists('campaign_characters');
	}

}
