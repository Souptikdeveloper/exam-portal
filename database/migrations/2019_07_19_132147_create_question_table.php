<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionTable extends Migration {

	public function up()
	{
		Schema::create('question', function(Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->longText('answer')->nullable();
            $table->longText('correct_answer')->nullable();
            $table->longText('marks')->nullable();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('question');
	}
}
