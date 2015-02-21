<?php

use Innaco\Repositories\TaskRepo;
use Innaco\Repositories\UserRepo;
use Innaco\Repositories\DocumentRepo;
use Innaco\Repositories\TemplateRepo;
use Innaco\Repositories\GroupRepo;
use Innaco\Repositories\TypeDocumentRepo;
use Innaco\Repositories\StepDocumentRepo;
use Innaco\Repositories\StateRepo;
use Innaco\Repositories\WorkflowRepo;

class reportController extends \BaseController {


	protected $taskRepo;
    protected $userRepo;
    protected $documentRepo;
    protected $templateRepo;
    protected $groupRepo;
    protected $typeDocumentRepo;
	protected $stepDocumentRepo;
    protected $stateRepo;
    protected $workflowRepo;

	public function __construct(TaskRepo $taskRepo, UserRepo $userRepo, DocumentRepo $documentRepo, TemplateRepo $templateRepo,
                                GroupRepo $groupRepo, TypeDocumentRepo $typeDocumentRepo,StepDocumentRepo $stepDocumentRepo,
                                StateRepo $stateRepo, WorkflowRepo $workflowRepo)
	{
		$this->taskRepo = $taskRepo;
        $this->userRepo = $userRepo;
        $this->documentRepo = $documentRepo;
        $this->templateRepo = $templateRepo;
        $this->groupRepo = $groupRepo;
        $this->typeDocumentRepo = $typeDocumentRepo;
		$this->stepDocumentRepo = $stepDocumentRepo;
        $this->stateRepo = $stateRepo;
        $this->workflowRepo = $workflowRepo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $total_users = $this->userRepo->getModel()->get();
        $total_tasks = $this->taskRepo->getModel()->get();
        $total_documents = $this->documentRepo->getModel()->get();
        $total_templates = $this->templateRepo->getModel()->get();
        $total_groups = $this->groupRepo->getModel()->get();
        $total_typeDocuments = $this->typeDocumentRepo->getModel()->get();


        return View::make('report.list')->with(['total_users' => $total_users, 'total_tasks' => $total_tasks,
                                                'total_documents' => $total_documents, 'total_templates' => $total_templates,
                                                'total_groups' => $total_groups, 'total_typeDocuments' => $total_typeDocuments]);
	}

    public function getDocuments(){
        $templates = $this->templateRepo->getModel()->get();
        $typeDocuments = $this->typeDocumentRepo->getModel()->get();
        $users = $this->userRepo->getModel()->get();
        $states = $this->stateRepo->getModel()->where('id','>',1)->get()->lists('name','id');
        return View::make('report.document.index',compact('templates','typeDocuments','users'))->with('states',$states);
    }

    public function postDocuments(){
        $NameDocument = Input::get('NameDocument');
        $NameTypeDocument = Input::get('NameTypeDocument');
        $CreateDateBegin = Input::get('CreateDateBegin');
        $CreateDateEnd = Input::get('CreateDateEnd');
        $ExecuteDateBegin = Input::get('ExecuteDateBegin');
        $ExecuteDateEnd = Input::get('ExecuteDateEnd');
        $Estado = Input::get('State');
        $CreatedUser = Input::get('CreatedUser');
        $flag = false;


        $documents = $this->documentRepo->getModel();
        $campos = array();
        array_push($campos,['name' => 'Nombre', 'relacion1' => 'name','relacion2' => '']);
        if($NameDocument!=''){
            $documents = $documents->where('name','LIKE','%'.$NameDocument.'%');
        }
        if($NameTypeDocument!=''){
            $NameTypeDocument = explode('|',Input::get('NameTypeDocument'));
            $typeDocuments = $this->typeDocumentRepo->getModel();
            $templates = $this->templateRepo->getModel();

            for($i = 0; $i < count($NameTypeDocument); $i++){
                $typeDocuments = $typeDocuments->orWhere('name','=',$NameTypeDocument[$i]);
            }

            $typeDocuments = $typeDocuments->get();

            foreach($typeDocuments as $temp){
                $templates = $templates->orwhere('typedocuments_id','=',$temp->id);
            }

            $templates = $templates->get();
            if($templates->count() != 0){
                if($NameDocument!=''){
                    $documents = $documents->where(function($query) use ($templates){
                        foreach($templates as $template){
                            $query->orwhere('templates_id','=',$template->id);
                        }
                    });
                }else{
                    foreach($templates as $template){
                        $documents = $documents->orwhere('templates_id','=',$template->id);
                    }
                }

            }else{
                $documents = $documents->where('templates_id','=',0);
            }
            array_push($campos,['name' => 'Tipo de Documento', 'relacion1' => 'template','relacion2' => 'name']);
        }

        if($CreateDateBegin!='' and $CreateDateEnd!=''){
            $CreateDateBegin = date_format(date_create(date("Y-m-d", strtotime($CreateDateBegin))), 'Y-m-d H:i:s');
            $CreateDateEnd = date_format(date_create(date("Y-m-d", strtotime($CreateDateEnd))), 'Y-m-d H:i:s');

            if($CreateDateBegin <= $CreateDateEnd){
                $documents = $documents->where(function($query) use ($CreateDateBegin, $CreateDateEnd){
                    $query->whereBetween('created_at',array($CreateDateBegin,$CreateDateEnd));
                });
            }
            array_push($campos,['name' => 'Fecha de Creacion', 'relacion1' => 'created_at','relacion2' => '']);
        }

        if($ExecuteDateBegin!='' and $ExecuteDateEnd!=''){
            $ExecuteDateBegin = date_format(date_create(date("Y-m-d", strtotime($ExecuteDateBegin))), 'Y-m-d H:i:s');
            $ExecuteDateEnd = date_format(date_create(date("Y-m-d", strtotime($ExecuteDateEnd))), 'Y-m-d H:i:s');

            if($ExecuteDateBegin <= $ExecuteDateEnd){
                $documents = $documents->where(function($query) use ($ExecuteDateBegin, $ExecuteDateEnd){
                    $query->whereBetween('created_at',array($ExecuteDateBegin,$ExecuteDateEnd));
                });
            }
            array_push($campos,['name' => 'Fecha de Ejecucion', 'relacion1' => 'execute_date','relacion2' => '']);
        }

        if($Estado!=''){
            $flag = false;
            $documents = $documents->where(function($query) use ($Estado, $flag){
            $workflows = $this->workflowRepo->getModel()->select('documents_id')->where('states_id','=',$Estado)->distinct()->get();
            foreach($workflows as $workflow){
                if($Estado==2){
                        foreach($workflows as $workflow){
                            $query->orwhere('id','=',$workflow->documents_id);
                        }
                    $flag = true;
                }elseif($Estado==3){
                    if($this->workflowRepo->getModel()->where('documents_id','=',$workflow->documents_id)->get()->count() ==
                        $this->workflowRepo->getModel()->where('documents_id','=',$workflow->documents_id)->where('states_id','=',3)->get()->count()) {
                        $query->orwhere('id', '=', $workflow->documents_id);
                        $flag = true;
                    }
                }elseif($Estado==4){
                    if($this->workflowRepo->getModel()->where('documents_id','=',$workflow->documents_id)->get()->count() > 0) {
                        $query->orwhere('id', '=', $workflow->documents_id);
                        $flag = true;
                    }
                }
            }
                if($flag==false){
                    $query->where('id','=',0);
                }
            });
            array_push($campos,['name' => 'Estado', 'relacion1' => 'workflow','relacion2' => 'last', 'relacion3' => 'state', 'relacion4' => 'name']);
        }

        if($CreatedUser != '') {
            $flag=false;
            $CreatedUser = explode('|',Input::get('CreatedUser'));
            $documents = $documents->where(function($query) use ($CreatedUser,$flag) {
                for($i = 0; $i < count($CreatedUser); $i++){
                    $users = $this->userRepo->getModel()->Where('full_name','=',$CreatedUser[$i])->get();
                    foreach($users as $user){
                        $workflows = $this->workflowRepo->getModel()->where('users_id','=',$user->id)->get();
                        foreach($workflows as $workflow){
                            if($this->workflowRepo->getModel()->where('documents_id','=',$workflow->documents_id)->get()->first()->users_id == $user->id){
                                $query->orwhere('id','=',$workflow->documents_id);
                                $flag = true;
                            }
                        }
                    }
                }
                if($flag==false){
                    $query->where('id','=',0);
                }
            });

            array_push($campos, ['name' => 'Usuario Creador', 'relacion1' => 'workflow', 'relacion2' => 'first', 'relacion3' => 'user', 'relacion4' => 'full_name']);
        }
        $documents = $documents->get();
        if(Input::has('Print')){
            $pdf = PDF::loadView('report.document.printReport', compact('documents','campos'));
            $pdf = $pdf->setOption("footer-html", "footer.html");
            return $pdf->download('reporte_documentos_'.date("Y-m-d H:i:s").'.pdf');
            //return View::make('report.document.printReport',compact('documents','campos'));
        }
        return View::make('report.document.result',compact('documents','campos'))->with('NameDocument',Input::get('NameDocument'))->
        with('NameTypeDocument', Input::get('NameTypeDocument'))->with('CreateDateBegin',Input::get('CreateDateBegin'))->with('CreateDateEnd',Input::get('CreateDateEnd'))->
        with('ExecuteDateBegin',Input::get('ExecuteDateBegin'))->with('ExecuteDateEnd',Input::get('ExecuteDateEnd'))->with('State',Input::get('State'))->with('CreatedUser',Input::get('CreatedUser'));
    }

    public function printReportDocuments($documents){
        dd(Input::all());
        return View::make('report.document.printReport',compact('campos','documents'));
    }

}
