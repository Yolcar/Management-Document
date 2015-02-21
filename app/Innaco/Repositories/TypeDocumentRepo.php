<?php namespace Innaco\Repositories;
use Innaco\Entities\TypeDocument;

class TypeDocumentRepo extends BaseRepo {

    public function getModel()
    {
        return new typeDocument();
    }

    public function newTypeDocument()
    {
        $typeDocument = new typeDocument();
        return $typeDocument;
    }

}