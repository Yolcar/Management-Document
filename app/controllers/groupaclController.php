<?php

use Innaco\Managers\GroupaclManager;
use Innaco\Repositories\GroupaclRepo;
use Innaco\Repositories\ModuleRepo;
use Innaco\Repositories\UserRepo;

class groupaclController extends \BaseController
{
    protected $groupaclRepo;
    protected $userRepo;
    protected $moduleRepo;

    public function __construct(GroupaclRepo $groupaclRepo, UserRepo $userRepo, ModuleRepo $moduleRepo)
    {
        $this->groupaclRepo = $groupaclRepo;
        $this->userRepo = $userRepo;
        $this->moduleRepo = $moduleRepo;
    }

    public function index()
    {
        $groupacls = $this->groupaclRepo->getModel()->where('available', '=', 1)->paginate(20);

        return View::make('groupacl.groupacllist', compact('groupacls'));
    }

    public function create()
    {
        return View::make('groupacl.create');
    }

    public function store()
    {
        $data = Input::all();
        $data += ['available' => 1];
        $groupacl = $this->groupaclRepo->newGroupacl();
        $manager = new GroupaclManager($groupacl, $data);
        $manager->save();

        return Redirect::route('groupacl.edit', $groupacl->id);
    }

    public function activation()
    {
        $groupacls = $this->groupaclRepo->getModel()->where('available', '=', 0)->paginate(20);

        return View::make('groupacl.activation', compact('groupacls'));
    }

    public function active($id)
    {
        $groupacl = $this->groupaclRepo->find($id);

        $groupacl->update(['available' => 1]);

        return Redirect::route('groupacl.activation');
    }

    public function destroy($id)
    {
        $groupacl = $this->groupaclRepo->find($id);

        if ($groupacl->name != Config::get('custom.group_management.name')) {
            if ($groupacl->user()->get()->count() == 0) {
                $groupacl->delete();
            } else {
                $groupacl->update(['available' => 0]);
            }

            return Redirect::route('groupacl.index');
        }
    }

    public function edit($id)
    {
        $groupacl = $this->groupaclRepo->find($id);
        $module = $this->moduleRepo->getModel()->get()->lists('name', 'id');

        return View::make('groupacl.edit')->with('groupacl', $groupacl)->with('module', $module);
    }

    public function addModule()
    {
        $groupacl = $this->groupaclRepo->find(Input::get('groupacl_id'));
        if (Input::get('module_id') != 0) {
            $module = $this->moduleRepo->find(Input::get('module_id'));
            if (!$groupacl->hasModule($module->name)) {
                $groupacl->module()->attach($module->id);
            }

            return Redirect::action('groupaclController@edit', ['id' => $groupacl->id])->withMessage('Grupo Asignado Satisfactoriamente');
        }

        return Redirect::action('groupaclController@edit', ['id' => $groupacl->id])->withMessage('Seleccione un Grupo');
    }

    public function deleteModule()
    {
        $groupacl = $this->groupaclRepo->find(Input::get('groupacl_id'));
        if (Input::get('module_id') == 8) {
            return Redirect::action('groupaclController@edit', ['id' => $groupacl->id])->withMessage('No se puede remover este modulo');
        } elseif (Input::get('module_id') != 0) {
            $module = $this->moduleRepo->find(Input::get('module_id'));
            $groupacl->module()->detach($module->id);

            return Redirect::action('groupaclController@edit', ['id' => $groupacl->id])->withMessage('Grupo removido satisfactoriamente');
        }

        return Redirect::action('groupaclController@edit', ['id' => $groupacl->id])->withMessage('Seleccione un Grupo');
    }

    public function update($id)
    {
        $groupacl = $this->groupaclRepo->find($id);
        $manager = new GroupaclManager($groupacl, Input::all());
        $manager->save();

        return Redirect::route('groupacl.edit', $groupacl->id)->withMessage('Grupo guardado satisfactoriamente');
    }
}
