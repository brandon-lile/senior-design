<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileExtToSheet extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('character_sheets', function(Blueprint $table)
		{
			$table->string('char_pic_ext', 5)->default(null);
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
			$table->dropColumn('char_pic_ext');
		});
	}

}
