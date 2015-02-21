<?php namespace Innaco\Repositories;
use Innaco\Entities\Group;

class GroupRepo extends BaseRepo {

    public function getModel()
    {
        return new group();
    }

    public function newGroup()
    {
        $group = new group();
        return $group;
    }

}