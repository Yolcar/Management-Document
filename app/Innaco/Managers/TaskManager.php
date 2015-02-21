<?php namespace Innaco\Managers;

class TaskManager extends BaseManager{

    public function getRules()
    {
        $rules = [
            'name' => 'required|unique:tasks,name,' . $this->entity->id,
            'available' => ''
        ];

        return $rules;
    }
}