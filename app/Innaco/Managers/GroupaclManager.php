<?php

namespace Innaco\Managers;

class GroupaclManager extends BaseManager
{
    public function getRules()
    {
        $rules = [
            'name'      => 'required|unique:groupacls,name,'.$this->entity->id,
            'available' => '',
        ];

        return $rules;
    }
}
