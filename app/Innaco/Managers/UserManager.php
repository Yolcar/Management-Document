<?php

namespace Innaco\Managers;

class UserManager extends BaseManager
{
    public function getRules()
    {
        $rules = [
            'full_name'             => 'required',
            'email'                 => 'required|email|unique:users,email,'.$this->entity->id,
            'cedula'                => 'required|unique:users,cedula,'.$this->entity->id,
            'password'              => 'confirmed',
            'password_confirmation' => '',
            'available'             => '',
        ];

        return $rules;
    }
}
