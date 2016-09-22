<?php

namespace Innaco\Entities;

/**
 * Innaco\Entities\Group.
 *
 * @property int $id
 * @property string $name
 * @property bool $available
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\StepDocument[] $stepDocuments
 *
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Group whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Group whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Group whereAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Group whereUpdatedAt($value)
 */
class Group extends \Eloquent
{
    protected $fillable = ['name', 'available'];

    public function users()
    {
        return $this->belongsToMany('Innaco\Entities\User');
    }

    public function stepDocuments()
    {
        return $this->hasMany('Innaco\Entities\StepDocument', 'groups_id', 'id');
    }
}
