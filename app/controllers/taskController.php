<?php

use Innaco\Repositories\TaskRepo;
use Innaco\Managers\TaskManager;
use Innaco\Repositories\StepDocumentRepo;

class taskController extends \BaseController {


	protected $taskRepo;
	protected $stepDocumentRepo;

	public function __construct(TaskRepo $taskRepo, StepDocumentRepo $stepDocumentRepo)
	{
		$this->taskRepo = $taskRepo;
		$this->stepDocumentRepo = $stepDocumentRepo;
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
			$tasks = $this->taskRepo->getModel()->search(Input::get('search'))->where('available','=',1)->paginate(20);
		}
		else{
			$tasks = $this->taskRepo->getModel()->where('available','=',1)->paginate(20);
		}
		return View::make('task.list',compact('tasks'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('task.create');
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
		$task = $this->taskRepo->newTask();
		$manager = new TaskManager($task, $data);
		$manager->save();

		return Redirect::route('task.index');
	}



    public function activation()
    {
        if(Input::has('search'))
        {
            $tasks= $this->taskRepo->getModel()->search(Input::get('search'))->where('available','=',0);
        }
        else{
            $tasks= $this->taskRepo->getModel()->where('available','=',0)->paginate(20);
        }
        return View::make('task.activation',compact('tasks'));
    }

    public function active($id){
        $task = $this->taskRepo->find($id);
        $stepDocuments = $this->stepDocumentRepo->getModel()->where('tasks_id','=',$id)->where('available','=',0)->get();

        foreach ($stepDocuments as $stepDocument){
            $this->stepDocumentRepo->getModel()->where('id','=',$stepDocument->id)->update(['available' => 1]);
        }
        $task->update(['available' => 1]);
        return Redirect::route('taskActivation');

    }


    /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$stepDocument = $this->stepDocumentRepo->getModel()->where('tasks_id', '=' ,$id)->get();

		if($stepDocument->count()==0){
			$task = $this->taskRepo->find($id);
			$task->delete();
		} else{
			$this->taskRepo->getModel()->where('id','=',$id)->update(['available' => 0]);
		}
		return Redirect::route('task.index');
	}


}
