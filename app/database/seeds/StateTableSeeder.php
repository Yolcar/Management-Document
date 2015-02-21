<?php

use Innaco\Entities\State;

class StateTableSeeder extends Seeder {

    public function run()
    {
        State::create([
            'name'	=> 'No Disponible',
        ]);
        State::create([
            'name'	=> 'Pendiente',
        ]);
        State::create([
            'name'	=> 'Listo',
        ]);
        State::create([
            'name'	=> 'Rechazado',
        ]);
    }

}