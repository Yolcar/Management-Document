<?php

use Innaco\Repositories\DocumentRepo;
use Innaco\Repositories\TemplateRepo;
use Innaco\Repositories\TypeDocumentRepo;
use Innaco\Managers\DocumentManager;

class pruebaController extends \BaseController
{


    protected $documentRepo;
    protected $typeDocumentRepo;
    protected $templateRepo;

    public function __construct(DocumentRepo $documentRepo, TypeDocumentRepo $typeDocumentRepo, TemplateRepo $templateRepo)
    {
        $this->documentRepo = $documentRepo;
        $this->typeDocumentRepo = $typeDocumentRepo;
        $this->templateRepo = $templateRepo;
    }


    public function getCustomfilter()
    {
        $filter = DataFilter::source(Article::with('author','categories'));
        $filter->text('src','Search')->scope('freesearch');
        $filter->build();

        $set = DataSet::source($filter);
        $set->paginate(9);
        $set->build();

        return  View::make('rapyd::demo.customfilter', compact('filter', 'set'));
    }



    public function index()
    {
        $documents = $this->documentRepo->findAll();
        $plantillas = $this->templateRepo->findAll();

        if(Input::has('search'))
        {
            $documents = $this->documentRepo->search (Input::get('search'));
        }
        else{
            $documents = $this->documentRepo->findAll(true);
        }

        return View::make('prueba',compact('documents','plantillas'));
    }


}