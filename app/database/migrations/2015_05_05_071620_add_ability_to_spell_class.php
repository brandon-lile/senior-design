<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAbilityToSpellClass extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('spell_classes', function(Blueprint $table)
		{
			$table->tinyInteger('ability')->nullable()->default(null);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('spell_classes', function(Blueprint $table)
		{
			$table->dropColumn('ability');
		});
	}

}
