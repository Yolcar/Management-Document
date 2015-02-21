<?php namespace Innaco\Repositories;
use Innaco\Entities\State;

class StateRepo extends BaseRepo {

    public function getModel()
    {
        return new State();
    }

    public function newState()
    {
        $state = new State();
        return $state;
    }

}