<?php namespace Innaco\Entities;


class Workflow extends \Eloquent {

	protected $fillable = ['documents_id','users_id', 'states_id','stepsdocuments_id'];

	public function document(){
		return $this->belongsTo('Innaco\Entities\Document','document_id','id');
	}

	public function user(){
		return $this->belongsTo('Innaco\Entities\User','users_id','id');
	}

	public function state(){
		return $this->belongsTo('Innaco\Entities\State','states_id','id');
	}

	public function stepdocument(){
		return $this->belongsTo('Innaco\Entities\StepDocument','stepsdocuments_id','id');
	}


}