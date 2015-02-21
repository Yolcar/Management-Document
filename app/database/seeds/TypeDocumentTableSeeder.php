<?php

use Innaco\Entities\typeDocument;

class TypeDocumentTableSeeder extends Seeder {

	public function run()
	{

		TypeDocument::create([
			'name' => 'Constancia',
			'available' => 1
		]);

		TypeDocument::create([
			'name' => 'Memorandum',
			'available' => 1
		]);

		TypeDocument::create([
			'name' => 'Solicitud',
			'available' => 1
		]);

	}

}