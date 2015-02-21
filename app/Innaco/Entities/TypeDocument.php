<?php namespace Innaco\Entities;

use Nicolaslopezj\Searchable\SearchableTrait;


class typeDocument extends \Eloquent {
	use SearchableTrait;

	protected $searchable = [
		'columns' => [
			'name' => 10,
		],
	];

	protected $fillable = ['name','available'];

	public function template(){
		return $this->hasMany('Innaco\Entities\Template','typedocuments_id','id');
	}
}