<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraitsTable extends Migration {


    public function up()
    {
        Schema::create('traits', function (Blueprint $table){
            $table->increments('id');
            $table->integer('sheet_id');
            $table->string('title', 150);
            $table->text('desc');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('traits');
    }

}
