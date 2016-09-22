<?php

use Innaco\Managers\UserManager;
use Innaco\Repositories\GroupaclRepo;
use Innaco\Repositories\GroupRepo;
use Innaco\Repositories\UserRepo;
use Innaco\Repositories\WorkflowRepo;

class userController extends \BaseController
{
    protected $userRepo;
    protected $workflowRepo;
    protected $groupRepo;
    protected $groupaclRepo;

    public function __construct(UserRepo $userRepo, WorkflowRepo $workflowRepo, GroupRepo $groupRepo, GroupaclRepo $groupaclRepo)
    {
        $this->userRepo = $userRepo;
        $this->workflowRepo = $workflowRepo;
        $this->groupRepo = $groupRepo;
        $this->groupaclRepo = $groupaclRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /user.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->userRepo->getModel()->where('available', '=', 1)->paginate(20);

        return View::make('user.list', compact('users'));
    }

    public function activation()
    {
        $users = $this->userRepo->getModel()->where('available', '=', 0)->paginate(20);

        return View::make('user.activation', compact('users'));
    }

    public function active($id)
    {
        $user = $this->userRepo->find($id);

        $user->update(['available' => 1]);

        return Redirect::route('userActivation');
    }

    /**
     * Show the form for creating a new resource.
     * GET /user/create.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('user.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /user.
     *
     * @return Response
     */
    public function store()
    {
        $data = Input::all();
        $data += ['available' => 1];
        $user = $this->userRepo->newUser();
        $manager = new UserManager($user, $data);
        $manager->save();

        return Redirect::route('user.edit', $user->id);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /user/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepo->find($id);
        $group = $this->groupRepo->getModel()->get()->lists('name', 'id');
        $groupacl = $this->groupaclRepo->getModel()->get()->lists('name', 'id');

        return View::make('user.edit')->with('user', $user)->with('group', $group)->with('groupacl', $groupacl);
    }

    public function addGroup()
    {
        $user = $this->userRepo->find(Input::get('user_id'));
        if (Input::get('group_id') != 0) {
            $group = $this->groupRepo->find(Input::get('group_id'));
            if (!$user->hasGroup($group->name)) {
                $user->groups()->attach($group->id);
            }

            return Redirect::action('userController@edit', ['id' => $user->id])->withMessage('Grupo Asignado Satisfactoriamente');
        }

        return Redirect::action('userController@edit', ['id' => $user->id])->withMessage('Seleccione un Grupo');
    }

    public function addGroupFun()
    {
        $user = $this->userRepo->find(Input::get('user_id'));
        if (Input::get('groupacl_id') != 0) {
            $groupacl = $this->groupaclRepo->find(Input::get('groupacl_id'));
            if (!$user->hasGroupAcl($groupacl->name)) {
                $user->groupacls()->attach($groupacl->id);
            }

            return Redirect::action('userController@edit', ['id' => $user->id])->withMessage('Grupo Asignado Satisfactoriamente');
        }

        return Redirect::action('userController@edit', ['id' => $user->id])->withMessage('Seleccione un Grupo');
    }

    public function deleteGroup()
    {
        $user = $this->userRepo->find(Input::get('user_id'));
        if (Input::get('group_id') != 0) {
            $group = $this->groupRepo->find(Input::get('group_id'));
            $user->groups()->detach($group->id);

            return Redirect::action('userController@edit', ['id' => $user->id])->withMessage('Grupo removido satisfactoriamente');
        }

        return Redirect::action('userController@edit', ['id' => $user->id])->withMessage('Seleccione un Grupo');
    }

    public function deleteGroupFun()
    {
        $user = $this->userRepo->find(Input::get('user_id'));
        if (Input::get('groupacl_id') != 0) {
            $groupacl = $this->groupaclRepo->find(Input::get('groupacl_id'));
            $user->groupacls()->detach($groupacl->id);

            return Redirect::action('userController@edit', ['id' => $user->id])->withMessage('Grupo removido satisfactoriamente');
        }

        return Redirect::action('userController@edit', ['id' => $user->id])->withMessage('Seleccione un Grupo');
    }

    public function profile()
    {
        $user = Auth::user();

        return View::make('user.profile')->with('user', $user);
    }

    public function updateProfile($id)
    {
        $user = $this->userRepo->find($id);
        $manager = new UserManager($user, Input::all());
        $manager->save();

        return Redirect::action('userController@profile')->withMessage('Datos Actualizados Satisfactoriamente');
    }

    /**
     * Update the specified resource in storage.
     * PUT /user/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $user = $this->userRepo->find($id);
        if (Input::hasFile('sign')) {
            $old_image = Auth::getUser()->sign;
            $image = Input::file('sign');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('img/sign/'.$filename);
            Image::make($image->getRealPath())->resize(300, 150)->save($path);
            $user->sign = 'img/sign/'.$filename;
            $user->save();
            File::delete($old_image);
        }
        $manager = new UserManager($user, Input::all());
        $manager->save();

        return Redirect::action('userController@edit', ['id' => $user->id])->withMessage('Usuario Modificado Satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /user/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $workflow = $this->workflowRepo->getModel()->where('users_id', '=', $id)->get();

        if ($workflow->count() == 0) {
            $user = $this->userRepo->find($id);
            $user->delete();
        } else {
            $this->userRepo->getModel()->where('id', '=', $id)->update(['available' => 0]);
        }

        return Redirect::route('user.index');
    }
}
