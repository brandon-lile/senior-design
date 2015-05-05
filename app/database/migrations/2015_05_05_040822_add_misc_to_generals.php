<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMiscToGenerals extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('character_generals', function(Blueprint $table)
		{
			$table->text('traits');
            $table->text('ideals');
            $table->text('bonds');
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
			$table->dropColumn('traits');
            $table->dropColumn('ideals');
            $table->dropColumn('bonds');
		});
	}

}
