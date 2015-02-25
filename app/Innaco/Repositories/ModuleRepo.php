<?php namespace Innaco\Repositories;
use Innaco\Entities\Module;

class ModuleRepo extends BaseRepo {

    public function getModel()
    {
        return new module();
    }

    public function newModule()
    {
        $module = new module();
        return $module;
    }

}