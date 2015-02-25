<?php namespace Innaco\Repositories;


abstract class BaseRepo {

    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findAll($paginate = false)
    {
        if($paginate)
        {
            return $this->model->paginate(20);
        }
        return $this->model->get();
    }

    public function destroy($id,$column)
    {
        return $this->model->where($column,'=',$id)->delete();
    }

}