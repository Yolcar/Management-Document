<?php namespace Innaco\Entities;

/**
 * Innaco\Entities\Groupacl
 *
 * @property integer $id 
 * @property string $name 
 * @property boolean $available 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\User[] $user 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\Module[] $module 
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Groupacl whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Groupacl whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Groupacl whereAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Groupacl whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Groupacl whereUpdatedAt($value)
 */
class Groupacl extends \Eloquent {

	protected $fillable = ['name','available'];


    public function user()
    {
        return $this->belongsToMany('Innaco\Entities\User');
    }

    public function module()
    {
        return $this->belongsToMany('Innaco\Entities\Module');
    }

    public function hasModule($check)
    {
        return in_array($check, array_fetch($this->module->toArray(), 'name'));
    }
    
}