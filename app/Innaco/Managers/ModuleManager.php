<?php namespace Innaco\Managers;

class ModuleManager extends BaseManager{

    public function getRules()
    {
        $rules = [
            'name' => 'required|unique:modules,name,' . $this->entity->id,

        ];

        return $rules;
    }
}