<?php namespace Innaco\Repositories;

use Innaco\Entities\stepDocument;

class StepDocumentRepo extends BaseRepo{

    public function getModel()
    {
        return new stepDocument();
    }

    public function newStepDocument()
    {
        $stepDocument = new stepDocument();
        return $stepDocument;
    }

}