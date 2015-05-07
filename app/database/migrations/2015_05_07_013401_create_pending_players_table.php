<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendingPlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pending_players', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('campaign_id');
            $table->integer('user_id');
            $table->string('accept_hash', 64);
            $table->tinyInteger('accepted')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pending_players');
	}

}
