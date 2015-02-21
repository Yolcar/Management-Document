<?php namespace Innaco\Entities;

use Nicolaslopezj\Searchable\SearchableTrait;


class State extends \Eloquent {

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

	protected $fillable = ['name'];

	public function workflow(){
		return $this->hasMany('Innaco\Entities\Workflow','states_id','id');
	}
}