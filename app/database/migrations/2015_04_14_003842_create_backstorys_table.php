<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackstorysTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backstorys', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('sheet_id');
            $table->string('personality_traits');
            $table->string('ideals');
            $table->string('bonds');
            $table->string('flaws');
            $table->string('backstory');
            $table->string('notes');
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
        Schema::drop('backstorys');
    }

}
