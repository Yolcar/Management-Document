<?php

namespace Innaco\Repositories;

use Innaco\Entities\User;

class UserRepo extends BaseRepo
{
    public function getModel()
    {
        return new user();
    }

    public function newUser()
    {
        $user = new user();

        return $user;
    }
}
