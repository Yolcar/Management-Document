<?php namespace Innaco\Managers;


class DocumentManager extends BaseManager{

    public function getRules()
    {
        $rules = [
            'name' => 'required',
            'body' => 'required',
            'execute_date'   =>  'required|date',
            'templates_id' => 'required',
            'serial' => 'required'
        ];

        return $rules;
    }

}