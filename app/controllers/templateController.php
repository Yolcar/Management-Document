<?php

use Innaco\Repositories\TemplateRepo;
use Innaco\Repositories\TypeDocumentRepo;
use Innaco\Repositories\StepDocumentRepo;
use Innaco\Repositories\TaskRepo;
use Innaco\Repositories\WorkflowRepo;
use Innaco\Repositories\DocumentRepo;
use Innaco\Managers\TemplateManager;
use Innaco\Managers\StepDocumentManager;

class templateController extends \BaseController {


	protected $templateRepo;
	protected $typeDocumentRepo;
	protected $stepDocumentRepo;
	protected $taskRepo;
	protected $workflowRepo;
	protected $documentRepo;

	public function __construct(TemplateRepo $templateRepo, TypeDocumentRepo $typeDocumentRepo,
								StepDocumentRepo $stepDocumentRepo, TaskRepo $taskRepo, WorkflowRepo $workflowRepo,
								DocumentRepo $documentRepo)
	{
		$this->templateRepo = $templateRepo;
		$this->typeDocumentRepo = $typeDocumentRepo;
		$this->stepDocumentRepo = $stepDocumentRepo;
		$this->taskRepo = $taskRepo;
		$this->workflowRepo = $workflowRepo;
		$this->documentRepo = $documentRepo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Input::has('search'))
		{
			$templates = $this->templateRepo->getModel()->where('name','LIKE','%'.Input::get('search').'%')->where('available','=',1)->paginate(20);
		}
		else{
			$templates = $this->templateRepo->getModel()->where('available','=',1)->paginate(20);
		}
		return View::make('template.list',compact('templates'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Input::has('search'))
		{
			$typeDocuments = $this->typeDocumentRepo->getModel()->search(Input::get('search'))->paginate(5);
		}
		else{
			$typeDocuments= $this->typeDocumentRepo->getModel()->paginate(5);
		}
		return View::make('template.create',compact('typeDocuments'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$data += array('available' => 1);
		$template = $this->templateRepo->newTemplate();
		$manager = new TemplateManager($template, $data);
		$manager->save();

		return Redirect::route('template.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$template = $this->templateRepo->find($id);
		if($template->available == 1){
			return View::make('template.show')->with('template',$template);
		}else{
			return Response::view('errors.missing', array(), 404);
		}
	}

	public function steps($id)
	{
		$template = $this->templateRepo->find($id);

        $totalSteps = array();

        for($i=1; $i <= $this->taskRepo->getModel()->count();$i++){
            $totalSteps[$i]=$i;
        }

		if($template->available == 1){
			$steps = $this->taskRepo->findAll();
			$groups = DB::table('groups')->orderBy('id','asc')->lists('name','id');
			$stepDocuments = $this->stepDocumentRepo->getModel()->where('templates_id','=',$id)->where('available','=',1)->get();
			return View::make('stepdocument.step',compact('steps','groups','stepDocuments'))->with('template',$template)->with('totalSteps',$totalSteps);
		}else{
			return Response::view('errors.missing', array(), 404);
		}
	}

	public function activation()
	{
		if(Input::has('search'))
		{
			$templates = $this->templateRepo->getModel()->search(Input::get('search'))->where('available','=',0);
		}
		else{
			$templates = $this->templateRepo->getModel()->where('available','=',0)->paginate(20);
		}
		return View::make('template.activation',compact('templates'));
	}

	public function active($id){
		$template = $this->templateRepo->find($id);
		$stepDocuments = $this->stepDocumentRepo->getModel()->where('templates_id','=',$id)->where('available','=',0)->get();

		foreach ($stepDocuments as $stepDocument){
			$this->stepDocumentRepo->getModel()->where('id','=',$stepDocument->id)->update(['available' => 1]);
		}
		$template->update(['available' => 1]);
		return Redirect::route('templateActivation');

	}



	public function stepsSave()
	{
		$template_id = Input::get('templates_id');
		$groups_id = Input::get('groups_id');
		$tasks_id = Input::get('tasks_id');
		$order = Input::get('order');

		$stepDocument = $this->stepDocumentRepo->getModel()->where('templates_id', '=' ,$template_id)->get();


		foreach($stepDocument as $temp){
			$workflows = $this->workflowRepo->getModel()->where('stepsdocuments_id','=',$temp->id)->get()->first();
			if ($workflows){
				$this->stepDocumentRepo->getModel()->where('id','=',$temp->id)->update(['available' => 0]);
			}else{
				$this->stepDocumentRepo->getModel()->where('id','=',$temp->id)->delete();
			}
		}

		foreach ($tasks_id as $key => $n) {
			if($groups_id[$key] !=NULL AND $order[$key]!=NULL){
				$arrData = array('templates_id' => $template_id, 'tasks_id' => $tasks_id[$key], 'groups_id' => $groups_id[$key], 'order' => $order[$key],'available' => 1);
				$stepDocument = $this->stepDocumentRepo->newStepDocument();
				$manager = new StepDocumentManager($stepDocument, $arrData);
				$manager->save();
			}
		}

		return Redirect::route('template.index');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$template = $this->templateRepo->find($id);
		if($template->available == 1){
			return View::make('template.edit')->with('template',$template);
		}else{
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
		$template = $this->templateRepo->find($id);
		$data = Input::all();
		$manager = new TemplateManager($template, $data);
		$manager->save();

		return Redirect::route('template.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$template = $this->templateRepo->find($id);
		if($template->available == 1){
			$documents = $this->documentRepo->getModel()->where('templates_id','=',$id)->get();
			$stepdocuments = $this->stepDocumentRepo->getModel()->where('templates_id','=',$id)->get();
			if($documents->count()==0){
				$template->delete();
				foreach($stepdocuments as $stepdocument){
					$stepdocument->delete();
				}
			}else{
				$this->templateRepo->getModel()->where('id','=',$id)->update(['available' => 0]);
				foreach($stepdocuments as $stepdocument){
					$this->stepDocumentRepo->getModel()->where('id','=',$id)->update(['available' => 0]);
				}
			}
			return Redirect::route('template.index');
		}else{
			return Response::view('errors.missing', array(), 404);
		}

	}


}
