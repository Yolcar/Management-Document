<?php namespace Innaco\Entities;

use Nicolaslopezj\Searchable\SearchableTrait;

class Task extends \Eloquent {

	use SearchableTrait;

	/**
	 * Searchable rules.
	 *
	 * @var array
	 */
	protected $searchable = [
		'columns' => [
			'name' => 10,
		],
	];

	protected $fillable = ['name','available'];

	public function stepDocument(){
		return $this->hasMany('Innaco\Entities\StepDocument','tasks_id','id');
	}
}