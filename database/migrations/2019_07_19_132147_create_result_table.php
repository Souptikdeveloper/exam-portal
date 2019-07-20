<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultTable extends Migration {

	public function up()
	{
		Schema::create('result', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->longText('questions')->nullable();
            $table->longText('answers')->nullable();
            $table->bigInteger('score')->nullable();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('result');
	}
}
