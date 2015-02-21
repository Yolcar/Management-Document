<?php namespace Innaco\Entities;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'full_name' => 10,
            'email' => 10
        ],
    ];

    public function groups()
    {
        return $this->belongsToMany('Innaco\Entities\Group');
    }

    public function hasGroup($check)
    {
        return in_array($check, array_fetch($this->groups->toArray(), 'name'));
    }

    public function setPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
            $this->attributes['password'] = \Hash::make($value);
        }
    }

    protected $fillable = ['full_name','email','password','available'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function workflow(){
        return $this->hasMany('Innaco\Entities\Workflow','users_id','id');
    }
}
