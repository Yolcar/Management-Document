<?php

use Innaco\Repositories\GroupRepo;
use Innaco\Repositories\StepDocumentRepo;
use Innaco\Repositories\UserRepo;
use Innaco\Managers\GroupManager;

class groupController extends \BaseController {


	protected $groupRepo;
    protected $stepDocumentRepo;
    protected $userRepo;


	public function __construct(GroupRepo $groupRepo, StepDocumentRepo $stepDocumentRepo, UserRepo $userRepo)
	{
		$this->groupRepo = $groupRepo;
        $this->stepDocumentRepo = $stepDocumentRepo;
        $this->userRepo = $userRepo;
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
			$groups = $this->groupRepo->getModel()->search(Input::get('search'))->where('available','=',1)->paginate(20);
		}
		else{
			$groups = $this->groupRepo->getModel()->where('available','=',1)->paginate(20);
		}
		return View::make('group.list',compact('groups'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('group.create');
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
		$group = $this->groupRepo->newGroup();
		$manager = new GroupManager($group, $data);
		$manager->save();

		return Redirect::route('group.index');
	}

    /**
     * Show the form for editing the specified resource.
     * GET /user/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $group = $this->groupRepo->find($id);
        return View::make('group.edit')->with('group',$group);
    }

    public function update($id){
        $group = $this->groupRepo->find($id);
        $manager = new GroupManager($group, Input::all());
        $manager->save();

        return Redirect::route('group.index');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $group = $this->groupRepo->find($id);
        if($group->name != Config::get('custom.group_management.name')){
            $stepDocument = $this->stepDocumentRepo->getModel()->where('groups_id', '=' ,$id)->get();

            if($stepDocument->count()==0){
                $group = $this->groupRepo->find($id);
                $group->delete();
            } else{
                $this->groupRepo->getModel()->where('id','=',$id)->update(['available' => 0]);
            }
            return Redirect::route('group.index');
        }
	}

    public function activation()
    {
        if(Input::has('search'))
        {
            $groups= $this->groupRepo->getModel()->search(Input::get('search'))->where('available','=',0);
        }
        else{
            $groups= $this->groupRepo->getModel()->where('available','=',0)->paginate(20);
        }
        return View::make('group.activation',compact('groups'));
    }

    public function active($id){
        $group = $this->groupRepo->find($id);

        $group->update(['available' => 1]);
        return Redirect::route('groupActivation');

    }

}