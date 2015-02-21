<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStepdocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('step_documents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('templates_id');
			$table->integer('tasks_id');
			$table->integer('groups_id');
			$table->integer('order');
			$table->boolean('available');
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
		Schema::drop('step_documents');
	}

}
