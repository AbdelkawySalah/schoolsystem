<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassroomsTable extends Migration {

	public function up()
	{
		Schema::create('Classrooms', function(Blueprint $table) {
			$table->increments('id');
			$table->string('Name_Class');
			$table->integer('Grade_Id')->unsigned();
		
			$table->timestamps();
		});
	}
	
	public function down()
	{
		Schema::drop('Classrooms');
	}
}