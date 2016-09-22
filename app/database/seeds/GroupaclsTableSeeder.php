<?php

use Innaco\Entities\Groupacl;

class GroupaclsTableSeeder extends Seeder
{
    public function run()
    {
        Groupacl::create([
            'name'      => Config::get('custom.group_management.name'),
            'available' => 1,
        ])->module()->attach([1, 2, 3, 4, 5, 6, 7, 8]);
    }
}
