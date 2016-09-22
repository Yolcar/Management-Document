<?php

namespace Innaco\Entities;

/**
 * Innaco\Entities\Task.
 *
 * @property int $id
 * @property string $name
 * @property bool $available
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\StepDocument[] $stepDocument
 *
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Task whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Task whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Task whereAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Task whereUpdatedAt($value)
 */
class Task extends \Eloquent
{
    protected $fillable = ['name', 'available'];

    public function stepDocument()
    {
        return $this->hasMany('Innaco\Entities\StepDocument', 'tasks_id', 'id');
    }
}
