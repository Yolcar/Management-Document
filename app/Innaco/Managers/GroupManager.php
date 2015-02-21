<?php namespace Innaco\Managers;

class GroupManager extends BaseManager{

    public function getRules()
    {
        $rules = [
            'name' => 'required|unique:groups,name,' . $this->entity->id,
            'available' => ''
        ];

        return $rules;
    }
}