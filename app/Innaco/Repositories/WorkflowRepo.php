<?php namespace Innaco\Repositories;
use Innaco\Entities\Workflow;

class WorkflowRepo extends BaseRepo {

    public function getModel()
    {
        return new Workflow;
    }

    public function newWorkflow()
    {
        $workflow = new Workflow();
        return $workflow;
    }

}