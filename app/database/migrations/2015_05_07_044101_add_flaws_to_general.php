<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlawsToGeneral extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('character_generals', function(Blueprint $table)
		{
			$table->text('flaws');
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
			$table->dropColumn('flaws');
		});
	}

}
