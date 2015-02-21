<?php

use Innaco\Entities\Estado;

class EstadoTableSeeder extends Seeder {

	public function run()
	{
		Estado::create([
			'name'	=> 'No Disponible',
		]);
		Estado::create([
			'name'	=> 'Pendiente',
		]);
		Estado::create([
			'name'	=> 'Listo',
		]);
		Estado::create([
			'name'	=> 'Rechazado',
		]);
	}

}