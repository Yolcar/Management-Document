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
			$table->integer('templates_id')->unsigned();
            $table->foreign('templates_id')->references('id')->on('templates');
			$table->integer('tasks_id')->unsigned();
            $table->foreign('tasks_id')->references('id')->on('tasks');
			$table->integer('groups_id')->unsigned();
            $table->foreign('groups_id')->references('id')->on('groups');
			$table->integer('order');
            $table->boolean('edit');
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
