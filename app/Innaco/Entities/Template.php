<?php namespace Innaco\Entities;

use Nicolaslopezj\Searchable\SearchableTrait;

class Template extends \Eloquent {

	use SearchableTrait;

	/**
	 * Searchable rules.
	 *
	 * @var array
	 */
	protected $searchable = [
		'columns' => [
			'name' => 10,
			'body' => 5
		],
	];

	protected $fillable = ['name', 'body','typedocuments_id','available'];

	public function document(){
		return $this->hasMany('Innaco\Entities\Document','templates_id','id');
	}

	public function typedocuments(){
		return $this->belongsTo('Innaco\Entities\TypeDocument','typedocuments_id','id');
	}

	public function stepdocuments(){
		return $this->hasMany('Innaco\Entities\StepDocument','id','templates_id');
	}


}