<?php
use \Innaco\Entities\Module;

class ModulesTableSeeder extends Seeder {

	public function run()
	{
        Module::create([
            'name'      => 'Documentos',
        ]);

        Module::create([
            'name'      => 'Plantillas',
        ]);

        Module::create([
            'name'      => 'Tareas',
        ]);

        Module::create([
            'name'      => 'Tipos de Documentos',
        ]);

        Module::create([
            'name'      => 'Usuarios',
        ]);

        Module::create([
            'name'      => 'Grupos',
        ]);

        Module::create([
            'name'      => 'Reportes',
        ]);

        Module::create([
            'name'      => 'Grupos Funcionales'
        ]);

	}

}