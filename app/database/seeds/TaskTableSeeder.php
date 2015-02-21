<?php

use Innaco\Entities\Task;

class taskTableSeeder extends Seeder {

	public function run()
	{
		Task::create([
			'name' => 'Crear',
			'available' => '1'
		]);

		Task::create([
			'name' => 'Revisar',
			'available' => '1'
		]);

		Task::create([
			'name' => 'Validar',
			'available' => '1'
		]);

		Task::create([
			'name' => 'Autorizar',
			'available' => '1'
		]);

		Task::create([
			'name' => 'Aprobar',
			'available' => '1'
		]);

	}

}