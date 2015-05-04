<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEquipmentFromSheets extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('character_sheets', function(Blueprint $table)
		{
			$table->dropColumn('equipment');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('character_sheets', function(Blueprint $table)
		{
			$table->string('equipment');
		});
	}

}
