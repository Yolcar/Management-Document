<?php

use Innaco\Repositories\DocumentRepo;
use Innaco\Repositories\GroupRepo;
use Innaco\Repositories\StateRepo;
use Innaco\Repositories\StepDocumentRepo;
use Innaco\Repositories\TaskRepo;
use Innaco\Repositories\TemplateRepo;
use Innaco\Repositories\TypeDocumentRepo;
use Innaco\Repositories\UserRepo;
use Innaco\Repositories\WorkflowRepo;

class reportController extends \BaseController
{
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
                                GroupRepo $groupRepo, TypeDocumentRepo $typeDocumentRepo, StepDocumentRepo $stepDocumentRepo,
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
        $chartsDocumentYear = [];
        $chartsDocumentState = [];

        $CreateDateBegin = date_format(date_time_set(date_create(date('Y-m-d', strtotime('01-01-'.date('Y')))), 0, 0, 0), 'Y-m-d H:i:s');
        $CreateDateEnd = date_format(date_time_set(date_create(date('Y-m-d', strtotime(date('j').'-'.date('n').'-'.date('Y')))), 0, 0, 0), 'Y-m-d H:i:s');
        for ($i = 2; $i <= 4; $i++) {
            $flag = false;
            $documents = $this->documentRepo->getModel();
            $documents = $documents->where(function ($query) use ($i, $flag) {
                $workflows = $this->workflowRepo->getModel()->select('documents_id')->where('states_id', '=', $i)->distinct()->get();
                foreach ($workflows as $workflow) {
                    if ($i == 2) {
                        foreach ($workflows as $workflow) {
                            $query->orwhere('id', '=', $workflow->documents_id);
                        }
                        $flag = true;
                    } elseif ($i == 3) {
                        if ($this->workflowRepo->getModel()->where('documents_id', '=', $workflow->documents_id)->get()->count() ==
                            $this->workflowRepo->getModel()->where('documents_id', '=', $workflow->documents_id)->where('states_id', '=', 3)->get()->count()
                        ) {
                            $query->orwhere('id', '=', $workflow->documents_id);
                            $flag = true;
                        }
                    } elseif ($i == 4) {
                        if ($this->workflowRepo->getModel()->where('documents_id', '=', $workflow->documents_id)->get()->count() > 0) {
                            $query->orwhere('id', '=', $workflow->documents_id);
                            $flag = true;
                        }
                    }
                }
                if ($flag == false) {
                    $query->where('id', '=', 0)->get();
                } else {
                    $query->get();
                }
            });
            array_push($chartsDocumentState, ['name' => $i, 'value' => $documents->count()]);
        }
        for ($i = 1; $i <= date('n'); $i++) {
            $CreateDateBegin = date_format(date_time_set(date_create(date('Y-m-d', strtotime('01-'.$i.'-'.date('Y')))), 0, 0, 0), 'Y-m-d H:i:s');
            $CreateDateEnd = date_format(date_time_set(date_create(date('Y-m-d', strtotime('31-'.$i.'-'.date('Y')))), 0, 0, 0), 'Y-m-d H:i:s');
            $documents = $this->documentRepo->getModel()->whereBetween('created_at', [$CreateDateBegin, $CreateDateEnd])->get();
            array_push($chartsDocumentYear, ['month' => $i, 'value' => $documents->count()]);
        }

        return View::make('report.list')->with(['total_users'        => $total_users, 'total_tasks' => $total_tasks,
                                                'total_documents'    => $total_documents, 'total_templates' => $total_templates,
                                                'total_groups'       => $total_groups, 'total_typeDocuments' => $total_typeDocuments,
                                                'chartsDocumentYear' => $chartsDocumentYear, 'chartsDocumentState' => $chartsDocumentState, ]);
    }

    public function getDocuments()
    {
        $templates = $this->templateRepo->getModel()->get();
        $typeDocuments = $this->typeDocumentRepo->getModel()->get();
        $users = $this->userRepo->getModel()->get();
        $states = $this->stateRepo->getModel()->where('id', '>', 1)->get()->lists('name', 'id');

        return View::make('report.document.index', compact('templates', 'typeDocuments', 'users'))->with('states', $states);
    }

    public function postDocuments()
    {
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
        $campos = [];
        array_push($campos, ['name' => 'Nombre', 'relacion1' => 'name', 'relacion2' => '']);
        if ($NameDocument != '') {
            $documents = $documents->where('name', 'LIKE', '%'.$NameDocument.'%');
        }
        if ($NameTypeDocument != '') {
            $NameTypeDocument = explode('|', Input::get('NameTypeDocument'));
            $typeDocuments = $this->typeDocumentRepo->getModel();
            $templates = $this->templateRepo->getModel();

            for ($i = 0; $i < count($NameTypeDocument); $i++) {
                $typeDocuments = $typeDocuments->orWhere('name', '=', $NameTypeDocument[$i]);
            }

            $typeDocuments = $typeDocuments->get();

            foreach ($typeDocuments as $temp) {
                $templates = $templates->orwhere('typedocuments_id', '=', $temp->id);
            }

            $templates = $templates->get();
            if ($templates->count() != 0) {
                if ($NameDocument != '') {
                    $documents = $documents->where(function ($query) use ($templates) {
                        foreach ($templates as $template) {
                            $query->orwhere('templates_id', '=', $template->id);
                        }
                    });
                } else {
                    foreach ($templates as $template) {
                        $documents = $documents->orwhere('templates_id', '=', $template->id);
                    }
                }
            } else {
                $documents = $documents->where('templates_id', '=', 0);
            }
            array_push($campos, ['name' => 'Tipo de Documento', 'relacion1' => 'template', 'relacion2' => 'name']);
        }

        if ($CreateDateBegin != '' and $CreateDateEnd != '') {
            $CreateDateBegin = date_format(date_time_set(date_create(date('Y-m-d', strtotime($CreateDateBegin))), 0, 0, 0), 'Y-m-d H:i:s');
            $CreateDateEnd = date_format(date_time_set(date_create(date('Y-m-d', strtotime($CreateDateEnd))), 23, 59, 59), 'Y-m-d H:i:s');

            if ($CreateDateBegin <= $CreateDateEnd) {
                $documents = $documents->where(function ($query) use ($CreateDateBegin, $CreateDateEnd) {
                    $query->whereBetween('created_at', [$CreateDateBegin, $CreateDateEnd]);
                });
            }
            array_push($campos, ['name' => 'Fecha de Creacion', 'relacion1' => 'created_at', 'relacion2' => '']);
        }

        if ($ExecuteDateBegin != '' and $ExecuteDateEnd != '') {
            $ExecuteDateBegin = date_format(date_create(date('Y-m-d', strtotime($ExecuteDateBegin))), 'Y-m-d H:i:s');
            $ExecuteDateEnd = date_format(date_create(date('Y-m-d', strtotime($ExecuteDateEnd))), 'Y-m-d H:i:s');

            if ($ExecuteDateBegin <= $ExecuteDateEnd) {
                $documents = $documents->where(function ($query) use ($ExecuteDateBegin, $ExecuteDateEnd) {
                    $query->whereBetween('created_at', [$ExecuteDateBegin, $ExecuteDateEnd]);
                });
            }
            array_push($campos, ['name' => 'Fecha de Ejecucion', 'relacion1' => 'execute_date', 'relacion2' => '']);
        }

        if ($Estado != '') {
            $flag = false;
            $documents = $documents->where(function ($query) use ($Estado, $flag) {
                $workflows = $this->workflowRepo->getModel()->select('documents_id')->where('states_id', '=', $Estado)->distinct()->get();
                foreach ($workflows as $workflow) {
                    if ($Estado == 2) {
                        foreach ($workflows as $workflow) {
                            $query->orwhere('id', '=', $workflow->documents_id);
                        }
                        $flag = true;
                    } elseif ($Estado == 3) {
                        if ($this->workflowRepo->getModel()->where('documents_id', '=', $workflow->documents_id)->get()->count() ==
                        $this->workflowRepo->getModel()->where('documents_id', '=', $workflow->documents_id)->where('states_id', '=', 3)->get()->count()) {
                            $query->orwhere('id', '=', $workflow->documents_id);
                            $flag = true;
                        }
                    } elseif ($Estado == 4) {
                        if ($this->workflowRepo->getModel()->where('documents_id', '=', $workflow->documents_id)->get()->count() > 0) {
                            $query->orwhere('id', '=', $workflow->documents_id);
                            $flag = true;
                        }
                    }
                }
                if ($flag == false) {
                    $query->where('id', '=', 0);
                }
            });
            array_push($campos, ['name' => 'Estado', 'relacion1' => 'workflow', 'relacion2' => 'last', 'relacion3' => 'state', 'relacion4' => 'name']);
        }

        if ($CreatedUser != '') {
            $flag = false;
            $CreatedUser = explode('|', Input::get('CreatedUser'));
            $documents = $documents->where(function ($query) use ($CreatedUser, $flag) {
                for ($i = 0; $i < count($CreatedUser); $i++) {
                    $users = $this->userRepo->getModel()->Where('full_name', '=', $CreatedUser[$i])->get();
                    foreach ($users as $user) {
                        $workflows = $this->workflowRepo->getModel()->where('users_id', '=', $user->id)->get();
                        foreach ($workflows as $workflow) {
                            if ($this->workflowRepo->getModel()->where('documents_id', '=', $workflow->documents_id)->get()->first()->users_id == $user->id) {
                                $query->orwhere('id', '=', $workflow->documents_id);
                                $flag = true;
                            }
                        }
                    }
                }
                if ($flag == false) {
                    $query->where('id', '=', 0);
                }
            });

            array_push($campos, ['name' => 'Usuario Creador', 'relacion1' => 'workflow', 'relacion2' => 'first', 'relacion3' => 'user', 'relacion4' => 'full_name']);
        }
        $documents = $documents->get();
        if (Input::has('Print')) {
            $pdf = PDF::loadView('report.document.printReport', compact('documents', 'campos'));
            $pdf = $pdf->setOption('footer-html', 'footer.html');

            return $pdf->download('reporte_documentos_'.date('Y-m-d H:i:s').'.pdf');
            //return View::make('report.document.printReport',compact('documents','campos'));
        }

        return View::make('report.document.result', compact('documents', 'campos'))->with('NameDocument', Input::get('NameDocument'))->
        with('NameTypeDocument', Input::get('NameTypeDocument'))->with('CreateDateBegin', Input::get('CreateDateBegin'))->with('CreateDateEnd', Input::get('CreateDateEnd'))->
        with('ExecuteDateBegin', Input::get('ExecuteDateBegin'))->with('ExecuteDateEnd', Input::get('ExecuteDateEnd'))->with('State', Input::get('State'))->with('CreatedUser', Input::get('CreatedUser'));
    }

    public function getUsers()
    {
        $groups = $this->groupRepo->getModel()->get();

        return View::make('report.user.index', compact('groups'));
    }

    public function postUsers()
    {
        $NameUser = Input::get('NameUser');
        $Cedula = Input::get('Cedula');
        $Email = Input::get('Email');
        $Groups = Input::get('Groups');
        $CreateDateBegin = Input::get('CreateDateBegin');
        $CreateDateEnd = Input::get('CreateDateEnd');
        $Estado = Input::get('State');
        $flag = false;

        $users = $this->userRepo->getModel();
        $campos = [];
        array_push($campos, ['name' => 'Nombre', 'relacion1' => 'full_name', 'relacion2' => '']);
        if ($NameUser != '') {
            $users = $users->where('full_name', 'LIKE', '%'.$NameUser.'%');
        }

        if ($Cedula != '') {
            $users = $users->where('cedula', 'LIKE', '%'.$Cedula.'%');
            array_push($campos, ['name' => 'Cedula', 'relacion1' => 'cedula', 'relacion2' => '']);
        }

        if ($Email != '') {
            $users = $users->where('email', 'LIKE', '%'.$Email.'%');
            array_push($campos, ['name' => 'Email', 'relacion1' => 'email', 'relacion2' => '']);
        }

        if ($Groups != '') {
            $flag = false;
            $Groups = explode('|', Input::get('Groups'));
            $usuarios = $this->userRepo->findAll();
            $users = $users->where(function ($query) use ($Groups, $flag, $usuarios) {
                for ($i = 0; $i < count($Groups); $i++) {
                    foreach ($usuarios as $usuario) {
                        if ($usuario->hasGroup($Groups[$i])) {
                            $query->orwhere('id', '=', $usuario->id);
                            $flag = true;
                        }
                    }
                }
                if ($flag == false) {
                    $query->where('id', '=', 0);
                }
            });

            array_push($campos, ['name' => 'Grupos']);
        }

        if ($CreateDateBegin != '' and $CreateDateEnd != '') {
            $CreateDateBegin = date_format(date_time_set(date_create(date('Y-m-d', strtotime($CreateDateBegin))), 0, 0, 0), 'Y-m-d H:i:s');
            $CreateDateEnd = date_format(date_time_set(date_create(date('Y-m-d', strtotime($CreateDateEnd))), 23, 59, 59), 'Y-m-d H:i:s');

            if ($CreateDateBegin <= $CreateDateEnd) {
                $users = $users->where(function ($query) use ($CreateDateBegin, $CreateDateEnd) {
                    $query->whereBetween('created_at', [$CreateDateBegin, $CreateDateEnd]);
                });
            }
            array_push($campos, ['name' => 'Fecha de Creacion', 'relacion1' => 'created_at', 'relacion2' => '']);
        }

        if ($Estado != '') {
            if ($Estado == 0 or $Estado == 1) {
                $users = $users->where('available', '=', intval($Estado));
            }
            array_push($campos, ['name' => 'Estado', 'relacion1' => 'available', 'relacion2' => '']);
        }



        $users = $users->get();
        if (Input::has('Print')) {
            $Groups = Input::get('Groups');
            $pdf = PDF::loadView('report.user.printReport', compact('users', 'campos', 'Groups'));
            $pdf = $pdf->setOption('footer-html', 'footer.html');

            return $pdf->download('reporte_usuarios_'.date('Y-m-d H:i:s').'.pdf');
            //return View::make('report.document.printReport',compact('documents','campos'));
        }

        return View::make('report.user.result', compact('users', 'campos'))->with('NameUser', Input::get('NameUser'))->
        with('Cedula', Input::get('Cedula'))->with('Email', Input::get('Email'))->with('Groups', Input::get('Groups'))->
        with('CreateDateBegin', Input::get('CreateDateBegin'))->with('CreateDateEnd', Input::get('CreateDateEnd'))->with('State', Input::get('State'));
    }

    public function getTasks()
    {
        return View::make('report.task.index');
    }

    public function postTasks()
    {
        $NameTask = Input::get('NameTask');
        $CreateDateBegin = Input::get('CreateDateBegin');
        $CreateDateEnd = Input::get('CreateDateEnd');
        $Estado = Input::get('State');
        $flag = false;

        $tasks = $this->taskRepo->getModel();
        $campos = [];
        array_push($campos, ['name' => 'Nombre', 'relacion1' => 'name', 'relacion2' => '']);
        if ($NameTask != '') {
            $tasks = $tasks->where('name', 'LIKE', '%'.$NameTask.'%');
        }

        if ($CreateDateBegin != '' and $CreateDateEnd != '') {
            $CreateDateBegin = date_format(date_time_set(date_create(date('Y-m-d', strtotime($CreateDateBegin))), 0, 0, 0), 'Y-m-d H:i:s');
            $CreateDateEnd = date_format(date_time_set(date_create(date('Y-m-d', strtotime($CreateDateEnd))), 23, 59, 59), 'Y-m-d H:i:s');

            if ($CreateDateBegin <= $CreateDateEnd) {
                $tasks = $tasks->where(function ($query) use ($CreateDateBegin, $CreateDateEnd) {
                    $query->whereBetween('created_at', [$CreateDateBegin, $CreateDateEnd]);
                });
            }
            array_push($campos, ['name' => 'Fecha de Creacion', 'relacion1' => 'created_at', 'relacion2' => '']);
        }

        if ($Estado != '') {
            if ($Estado == 0 or $Estado == 1) {
                $tasks = $tasks->where('available', '=', intval($Estado));
            }
            array_push($campos, ['name' => 'Estado', 'relacion1' => 'available', 'relacion2' => '']);
        }



        $tasks = $tasks->get();
        if (Input::has('Print')) {
            $pdf = PDF::loadView('report.task.printReport', compact('tasks', 'campos'));
            $pdf = $pdf->setOption('footer-html', 'footer.html');

            return $pdf->download('reporte_tareas_'.date('Y-m-d H:i:s').'.pdf');
            //return View::make('report.document.printReport',compact('documents','campos'));
        }

        return View::make('report.task.result', compact('tasks', 'campos'))->with('NameTask', Input::get('NameTask'))->
        with('CreateDateBegin', Input::get('CreateDateBegin'))->with('CreateDateEnd', Input::get('CreateDateEnd'))->with('State', Input::get('State'));
    }

    public function getTypeDocuments()
    {
        return View::make('report.typeDocument.index');
    }

    public function postTypeDocuments()
    {
        $NameTypeDocument = Input::get('NameTypeDocument');
        $CreateDateBegin = Input::get('CreateDateBegin');
        $CreateDateEnd = Input::get('CreateDateEnd');
        $Estado = Input::get('State');
        $flag = false;

        $typeDocuments = $this->typeDocumentRepo->getModel();
        $campos = [];
        array_push($campos, ['name' => 'Nombre', 'relacion1' => 'name', 'relacion2' => '']);
        if ($NameTypeDocument != '') {
            $typeDocuments = $typeDocuments->where('name', 'LIKE', '%'.$NameTypeDocument.'%');
        }

        if ($CreateDateBegin != '' and $CreateDateEnd != '') {
            $CreateDateBegin = date_format(date_time_set(date_create(date('Y-m-d', strtotime($CreateDateBegin))), 0, 0, 0), 'Y-m-d H:i:s');
            $CreateDateEnd = date_format(date_time_set(date_create(date('Y-m-d', strtotime($CreateDateEnd))), 23, 59, 59), 'Y-m-d H:i:s');

            if ($CreateDateBegin <= $CreateDateEnd) {
                $typeDocuments = $typeDocuments->where(function ($query) use ($CreateDateBegin, $CreateDateEnd) {
                    $query->whereBetween('created_at', [$CreateDateBegin, $CreateDateEnd]);
                });
            }
            array_push($campos, ['name' => 'Fecha de Creacion', 'relacion1' => 'created_at', 'relacion2' => '']);
        }

        if ($Estado != '') {
            if ($Estado == 0 or $Estado == 1) {
                $typeDocuments = $typeDocuments->where('available', '=', intval($Estado));
            }
            array_push($campos, ['name' => 'Estado', 'relacion1' => 'available', 'relacion2' => '']);
        }



        $typeDocuments = $typeDocuments->get();
        if (Input::has('Print')) {
            $pdf = PDF::loadView('report.typeDocument.printReport', compact('typeDocuments', 'campos'));
            $pdf = $pdf->setOption('footer-html', 'footer.html');

            return $pdf->download('reporte_tipos_de_documentos_'.date('Y-m-d H:i:s').'.pdf');
            //return View::make('report.document.printReport',compact('documents','campos'));
        }

        return View::make('report.typeDocument.result', compact('typeDocuments', 'campos'))->with('NameTypeDocument', Input::get('NameTypeDocument'))->
        with('CreateDateBegin', Input::get('CreateDateBegin'))->with('CreateDateEnd', Input::get('CreateDateEnd'))->with('State', Input::get('State'));
    }

    public function getTemplates()
    {
        $typeDocuments = $this->typeDocumentRepo->findAll();

        return View::make('report.template.index', compact('typeDocuments'));
    }

    public function postTemplates()
    {
        $NameTemplate = Input::get('NameTemplate');
        $TypeDocuments = Input::get('TypeDocuments');
        $CreateDateBegin = Input::get('CreateDateBegin');
        $CreateDateEnd = Input::get('CreateDateEnd');
        $Estado = Input::get('State');
        $flag = false;

        $templates = $this->templateRepo->getModel();
        $campos = [];
        array_push($campos, ['name' => 'Nombre', 'relacion1' => 'name', 'relacion2' => '']);
        if ($NameTemplate != '') {
            $templates = $templates->where('name', 'LIKE', '%'.$NameTemplate.'%');
        }

        if ($TypeDocuments != '') {
            $flag = false;
            $TypeDocuments = explode('|', Input::get('TypeDocuments'));
            $plantillas = $this->templateRepo->findAll();
            $templates = $templates->where(function ($query) use ($TypeDocuments, $flag, $plantillas) {
                for ($i = 0; $i < count($TypeDocuments); $i++) {
                    foreach ($plantillas as $plantilla) {
                        if ($plantilla->typedocuments->name == $TypeDocuments[$i]) {
                            $query->orwhere('id', '=', $plantilla->id);
                            $flag = true;
                        }
                    }
                }
                if ($flag == false) {
                    $query->where('id', '=', 0);
                }
            });
            array_push($campos, ['name' => 'Tipo de Documento', 'relacion1' => 'typedocuments', 'relacion2' => 'name']);
        }

        if ($CreateDateBegin != '' and $CreateDateEnd != '') {
            $CreateDateBegin = date_format(date_time_set(date_create(date('Y-m-d', strtotime($CreateDateBegin))), 0, 0, 0), 'Y-m-d H:i:s');
            $CreateDateEnd = date_format(date_time_set(date_create(date('Y-m-d', strtotime($CreateDateEnd))), 23, 59, 59), 'Y-m-d H:i:s');

            if ($CreateDateBegin <= $CreateDateEnd) {
                $templates = $templates->where(function ($query) use ($CreateDateBegin, $CreateDateEnd) {
                    $query->whereBetween('created_at', [$CreateDateBegin, $CreateDateEnd]);
                });
            }
            array_push($campos, ['name' => 'Fecha de Creacion', 'relacion1' => 'created_at', 'relacion2' => '']);
        }

        if ($Estado != '') {
            if ($Estado == 0 or $Estado == 1) {
                $templates = $templates->where('available', '=', intval($Estado));
            }
            array_push($campos, ['name' => 'Estado', 'relacion1' => 'available', 'relacion2' => '']);
        }

        $templates = $templates->get();
        if (Input::has('Print')) {
            $pdf = PDF::loadView('report.template.printReport', compact('templates', 'campos'));
            $pdf = $pdf->setOption('footer-html', 'footer.html');

            return $pdf->download('reporte_plantillas_'.date('Y-m-d H:i:s').'.pdf');
            //return View::make('report.document.printReport',compact('documents','campos'));
        }

        return View::make('report.template.result', compact('templates', 'campos'))->with('NameTemplate', Input::get('NameTemplate'))->
        with('TypeDocuments', Input::get('TypeDocuments'))->with('CreateDateBegin', Input::get('CreateDateBegin'))->
        with('CreateDateEnd', Input::get('CreateDateEnd'))->with('State', Input::get('State'));
    }
}
