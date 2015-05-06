<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPicFieldsToNpc extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('npcs', function(Blueprint $table)
		{
			$table->string('npc_pic')->nullable()->default(null);
            $table->string('npc_pic_ext')->nullable()->default(null);;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('npcs', function(Blueprint $table)
		{
			$table->dropColumn('npc_pic');
            $table->dropColumn('npc_pic_ext');
		});
	}

}
