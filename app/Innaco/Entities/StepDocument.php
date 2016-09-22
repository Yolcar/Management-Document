<?php

namespace Innaco\Entities;

/**
 * Innaco\Entities\stepDocument.
 *
 * @property int $id
 * @property int $templates_id
 * @property int $tasks_id
 * @property int $groups_id
 * @property int $order
 * @property bool $edit
 * @property bool $available
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Innaco\Entities\Template $template
 * @property-read \Innaco\Entities\Task $task
 * @property-read \Innaco\Entities\Group $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\Workflow[] $workflow
 *
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\stepDocument whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\stepDocument whereTemplatesId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\stepDocument whereTasksId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\stepDocument whereGroupsId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\stepDocument whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\stepDocument whereEdit($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\stepDocument whereAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\stepDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\stepDocument whereUpdatedAt($value)
 */
class StepDocument extends \Eloquent
{
    protected $fillable = ['templates_id', 'tasks_id', 'groups_id', 'order', 'available', 'edit'];

    public function template()
    {
        return $this->belongsTo('Innaco\Entities\Template', 'templates_id', 'id');
    }

    public function task()
    {
        return $this->belongsTo('Innaco\Entities\Task', 'tasks_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo('Innaco\Entities\Group', 'groups_id', 'id');
    }

    public function workflow()
    {
        return $this->hasMany('Innaco\Entities\Workflow', 'id', 'stepsdocuments_id');
    }
}
