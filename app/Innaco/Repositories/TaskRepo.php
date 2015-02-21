<?php namespace Innaco\Repositories;
use Innaco\Entities\Task;

class TaskRepo extends BaseRepo {

    public function getModel()
    {
        return new task();
    }

    public function newTask()
    {
        $task = new task();
        return $task;
    }

}