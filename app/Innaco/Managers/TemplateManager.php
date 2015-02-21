<?php namespace Innaco\Managers;

class TemplateManager extends BaseManager{

    public function getRules()
    {
        $rules = [
            'name' => 'required|unique:templates,name,' . $this->entity->id,
            'body' => 'required',
            'typedocuments_id' => 'required',
            'available' => ''
        ];

        return $rules;
    }
}