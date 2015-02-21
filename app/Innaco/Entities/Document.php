<?php namespace Innaco\Entities;

use Nicolaslopezj\Searchable\SearchableTrait;

class Document extends \Eloquent {

	use SearchableTrait;

	/**
	 * Searchable rules.
	 *
	 * @var array
	 */
	protected $searchable = [
		'columns' => [
			'serial' => 5,
			'documents.name' => 4,
			'templates.name' => 3,
			'documents.body' => 2,
			'execute_date' => 1,
			'documents.created_at' =>1,
		],
		'joins' => [
			'templates' => ['documents.templates_id','templates.id']
		]
	];

	protected $fillable = ['serial','name', 'body','templates_id','execute_date'];

	public function template(){
		return $this->belongsTo('Innaco\Entities\Template','templates_id','id');
	}

	public function workflow(){
		return $this->hasMany('Innaco\Entities\Workflow','documents_id','id');
	}

}