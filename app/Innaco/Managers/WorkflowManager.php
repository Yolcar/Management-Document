<?php namespace Innaco\Managers;

class WorkflowManager extends BaseManager{

    public function getRules()
    {
        $rules = [
            'documents_id' => 'required',
            'users_id' => 'required',
            'states_id' => 'required',
            'stepsdocuments_id'  => 'required'
        ];

        return $rules;
    }
}