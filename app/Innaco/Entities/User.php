<?php

namespace Innaco\Entities;

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;

/**
 * Innaco\Entities\User.
 *
 * @property int $id
 * @property string $full_name
 * @property mixed $sign
 * @property string $email
 * @property string $cedula
 * @property string $password
 * @property string $last_session
 * @property bool $available
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\Groupacl[] $groupacls
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\Group[] $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\Workflow[] $workflow
 *
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\User whereFullName($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\User whereSign($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\User whereCedula($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\User whereLastSession($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\User whereAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\User whereUpdatedAt($value)
 */
class User extends \Eloquent implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;

    public function groupacls()
    {
        return $this->belongsToMany('Innaco\Entities\Groupacl');
    }

    public function groups()
    {
        return $this->belongsToMany('Innaco\Entities\Group');
    }

    public function hasGroup($check)
    {
        return in_array($check, array_fetch($this->groups->toArray(), 'name'));
    }

    public function hasGroupAcl($check)
    {
        return in_array($check, array_fetch($this->groupacls->toArray(), 'name'));
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = \Hash::make($value);
        }
    }

    protected $fillable = ['full_name', 'email', 'cedula', 'password', 'available'];

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
    protected $hidden = ['password', 'remember_token'];

    public function workflow()
    {
        return $this->hasMany('Innaco\Entities\Workflow', 'users_id', 'id');
    }
}
