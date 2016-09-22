<?php

namespace Innaco\Repositories;

use Innaco\Entities\Groupacl;

class GroupaclRepo extends BaseRepo
{
    public function getModel()
    {
        return new groupacl();
    }

    public function newGroupacl()
    {
        $groupacl = new groupacl();

        return $groupacl;
    }
}
