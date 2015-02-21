<?php namespace Innaco\Entities;

use Nicolaslopezj\Searchable\SearchableTrait;

class Group extends \Eloquent {

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

    public function groups()
    {
        return $this->belongsToMany('Innaco\Entities\User');
    }

    public function stepDocuments()
    {
        return $this->hasMany('Innaco\Entities\StepDocument','groups_id','id');
    }
}