<?php namespace Innaco\Repositories;

use Innaco\Entities\Document;

class DocumentRepo extends BaseRepo{

    public function getModel()
    {
        return new Document;
    }

    public function newDocument()
    {
        $document = new Document();
        return $document;
    }

}