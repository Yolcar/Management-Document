<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('StateTableSeeder');
		$this->call('TypeDocumentTableSeeder');
		$this->call('TaskTableSeeder');
		$this->call('TemplateTableSeeder');
        $this->call('GroupTableSeeder');
        $this->call('UserTableSeeder');
	}

}
