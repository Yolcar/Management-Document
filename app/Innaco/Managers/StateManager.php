<?php namespace Innaco\Managers;

class StateManager extends BaseManager{

    public function getRules()
    {
        $rules = [
            'name' => 'required|unique:states,name,' . $this->entity->id,
        ];

        return $rules;
    }
}