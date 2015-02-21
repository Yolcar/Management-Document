<?php namespace Innaco\Entities;

use Nicolaslopezj\Searchable\SearchableTrait;


class stepDocument extends \Eloquent {

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

	protected $fillable = ['templates_id','tasks_id', 'groups_id','order','available'];

	public function template(){
		return $this->belongsTo('Innaco\Entities\Template','templates_id','id');
	}

	public function task(){
		return $this->belongsTo('Innaco\Entities\Task','tasks_id','id');
	}

	public function group(){
		return $this->belongsTo('Innaco\Entities\Group','groups_id','id');
	}

	public function workflow(){
		return $this->hasMany('Innaco\Entities\Workflow','id','stepsdocuments_id');
	}

}