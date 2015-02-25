<?php namespace Innaco\Entities;

/**
 * Innaco\Entities\Template
 *
 * @property integer $id 
 * @property string $name 
 * @property string $body 
 * @property integer $typedocuments_id 
 * @property boolean $available 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\Document[] $document 
 * @property-read \Innaco\Entities\TypeDocument $typedocuments 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\StepDocument[] $stepdocuments 
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Template whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Template whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Template whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Template whereTypedocumentsId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Template whereAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Template whereUpdatedAt($value)
 */
class Template extends \Eloquent {

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