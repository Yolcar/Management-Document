<?php

use Innaco\Repositories\DocumentRepo;
use Innaco\Repositories\TemplateRepo;
use Innaco\Repositories\StepDocumentRepo;
use Innaco\Repositories\WorkflowRepo;
use Innaco\Managers\DocumentManager;

class documentController extends \BaseController {


	protected $documentRepo;
	protected $templateRepo;
    protected $stepDocumentRepo;
	protected $workflowRepo;

	public function __construct(DocumentRepo $documentRepo, TemplateRepo $templateRepo, StepDocumentRepo $stepDocumentRepo, WorkflowRepo $workflowRepo)
	{
		$this->documentRepo = $documentRepo;
		$this->templateRepo = $templateRepo;
        $this->stepDocumentRepo = $stepDocumentRepo;
		$this->workflowRepo = $workflowRepo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $user = \Auth::User();
        $templates_id = $this->stepDocumentRepo->getModel()->select('templates_id')->distinct();

		if(Input::has('search'))
		{
		$documents = $this->documentRepo->getModel()->search(Input::get('search'));
		}
		else{
			$documents = $this->documentRepo->getModel();
		}
		if($templates_id->count()!=0){
			foreach($user->groups()->get() as $group)
			{
				$templates_id->orWhere('groups_id','=',$group->id);
			}
			if($templates_id->count()!=0){
				$templates_id = $templates_id->get();
				foreach ($templates_id as $template_id) {
					$documents = $documents->orWhere('templates_id','=',$template_id->templates_id);
				}
				$documents = $documents->paginate(20);
				return View::make('document.list',compact('documents'));
			}
			else{
				$documents = $documents->where('id','=',0)->paginate(20);
				return View::make('document.list',compact('documents'));
			}
		}
		else{
			$documents = $documents->where('id','=',0)->paginate(20);
			return View::make('document.list',compact('documents'));
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = \Auth::User();
		$templates_id = $this->stepDocumentRepo->getModel()->select('templates_id')->distinct();

		if(Input::has('search'))
		{
			$templates = $this->templateRepo->getModel()->search(Input::get('search'),0);
		}
		else{
			$templates = $this->templateRepo->getModel();
		}
        if($user->groups->count() != 0) {
            if ($templates_id->count() != 0) {
                foreach ($user->groups()->get() as $group) {
                    $templates_id->orWhere(function ($query) use ($group) {
                        $query->where('groups_id', '=', $group->id)->where('tasks_id', '=', 1);
                    });
                }
                if ($templates_id->count() != 0) {
                    $templates_id = $templates_id->get();
                    foreach ($templates_id as $template_id) {
                        $templates = $templates->orWhere('id', '=', $template_id->templates_id)->where('available', '=', 1);
                    }
                    $templates = $templates->paginate(20);
                    return View::make('document.selectTemplate', compact('templates'));
                } else {
                    $templates = $templates->where('id', '=', 0)->paginate(20);
                    return View::make('document.selectTemplate', compact('templates'));
                }
            } else {
                $templates = $templates->where('id', '=', 0)->paginate(20);
                return View::make('document.selectTemplate', compact('templates'));
            }
        } else {
            $templates = $templates->where('id', '=', 0)->paginate(20);
            return View::make('document.selectTemplate', compact('templates'));
        }
	}

	public function writeDocument($id)
	{
		$user = \Auth::User();
		$templates_id = $this->stepDocumentRepo->getModel()->select('templates_id')->distinct();

		$template = $this->templateRepo->getModel();
		if($template->count()!=0) {//si encuenta la plantilla
			if ($templates_id->count() != 0) {
				foreach ($user->groups()->get() as $group) {
					$templates_id->orWhere(function ($query) use ($group) {
						$query->Where('groups_id', '=', $group->id)->where('tasks_id', '=', 1);
					});
				}
				if ($templates_id->count() != 0) {
					$templates_id = $templates_id->get();
					foreach ($templates_id as $template_id) {
						if ($template_id->templates_id==$id){
							$template = $template->find($id);
						}
					}
					if($template->id==$id){
						return View::make('document.create')->with('template',$template);
					}
					else{
						//Error cuando no se tiene permiso para esa plantilla
						return Response::view('errors.missing', array(), 404);
					}
				} else {
					//Error cuando no se tiene el permiso para crear
					return Response::view('errors.missing', array(), 404);
				}
			} else {
				//Error cuando no hay ni pasos creados
				return Response::view('errors.missing', array(), 404);
			}
		}
		else{ //si NO se encuenta la plantilla
			return Response::view('errors.missing', array(), 404);
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if(Input::has('execute_date')) {
            Input::merge(array('execute_date' => date("Y-m-d", strtotime(Input::get('execute_date')))));
        }
        $serial = $this->documentRepo->getModel()->where('templates_id','=',Input::get('templates_id'))->orderBy('serial','desc')->first();
        if ($serial) {
            $serial = $serial->serial+1;
        } else {
            $serial = 1;
        }
        $data = Input::all();
        $data += array('serial' => $serial);
        $document = $this->documentRepo->newDocument();
        $manager = new DocumentManager($document, $data);
        $manager->save();
        $datos = array('documents_id' => $document->id, 'templates_id' => $document->templates_id);
        return Redirect::route('workflow.create',$datos);

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = \Auth::User();
		$templates_id = $this->stepDocumentRepo->getModel()->select('templates_id')->distinct();
		$document = $this->documentRepo->find($id);


		if($templates_id->count()!=0){
			foreach($user->groups()->get() as $group)
			{
				$templates_id->orWhere('groups_id','=',$group->id);
			}
			if($templates_id->count()!=0){
				$templates_id = $templates_id->get();
				foreach ($templates_id as $template_id) {
					if ($document->templates_id == $template_id->templates_id){
						return View::make('document.show')->with('document',$document);
					}
				}
				return Response::view('errors.missing', array(), 404);
			}
			else{
				return Response::view('errors.missing', array(), 404);
			}
		} else{
			return Response::view('errors.missing', array(), 404);
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = \Auth::User();
		$workflows = $this->workflowRepo->getModel()->where('documents_id','=',$id)->where('users_id','=',intval($user->id))->get()->first();
		$workflowsNext = $this->workflowRepo->getModel()->where('id','=',$workflows->id+1)->where('documents_id','=',$id)->get()->first();

		if ($workflows){
			if ($workflowsNext){
				if($workflows->documents_id==$id and $workflowsNext->users_id==0){
					$document = $this->documentRepo->find($id);
					return View::make('document.edit')->with('document',$document);
				} else {
					return Response::view('errors.missing', array(), 404);
				}
			} elseif ($workflows->documents_id==$id) {
				$document = $this->documentRepo->find($id);
				return View::make('document.edit')->with('document',$document);
			}else {
				return Response::view('errors.missing', array(), 404);
			}
		} else {
			return Response::view('errors.missing', array(), 404);
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(Input::has('execute_date'))
		{
			Input::merge(array('execute_date' => date("Y-m-d", strtotime(Input::get('execute_date')))));
		}
		$serial = $this->documentRepo->getModel()->where('templates_id','=',Input::get('templates_id'))->orderBy('serial','desc')->first();
		$data = Input::all();
		$data += array('serial' => $serial);
		$document = $this->documentRepo->find($id);
		$manager = new DocumentManager($document, $data);
		$manager->save();
		return Redirect::route('document.index');
	}

    public function printDocument($id){
        $workflows = $this->workflowRepo->getModel()->where('documents_id','=',$id);
        if($workflows->count() == $workflows->where('states_id','=',3)->count()) {
            if($workflows->where('users_id','=',Auth::getUser()->id)){
                $document = $this->documentRepo->find($id);
                $pdf = PDF::loadView('document.print', compact('document'));
                $pdf = $pdf->setOption("footer-html", "footer.html");
                //$pdf = $pdf->setOption("header-html", "header.html");
                return $pdf->stream($document->name.date("Y-m-d H:i:s").'.pdf');
                //return View::make('document.print', compact('document'));
            }
        }else{
            return Response::view('errors.missing', array(), 404);
        }
    }

}
