<?php

namespace Innaco\Entities;

/**
 * Innaco\Entities\State.
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\Workflow[] $workflow
 *
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\State whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\State whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\State whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\State whereUpdatedAt($value)
 */
class State extends \Eloquent
{
    protected $fillable = ['name'];

    public function workflow()
    {
        return $this->hasMany('Innaco\Entities\Workflow', 'states_id', 'id');
    }
}
