<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkflowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workflows', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('documents_id')->unsigned();
            $table->foreign('documents_id')->references('id')->on('documents');
			$table->integer('users_id')->nullable()->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
			$table->integer('states_id')->unsigned();
            $table->foreign('states_id')->references('id')->on('states');
			$table->integer('stepsdocuments_id')->unsigned();
            $table->foreign('stepsdocuments_id')->references('id')->on('step_documents');
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
		Schema::drop('workflows');
	}

}
