<?php

namespace Innaco\Entities;

/**
 * Innaco\Entities\Document.
 *
 * @property int $id
 * @property int $serial
 * @property string $name
 * @property string $body
 * @property int $templates_id
 * @property string $execute_date
 * @property string $observation
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Innaco\Entities\Template $template
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\Workflow[] $workflow
 *
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Document whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Document whereSerial($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Document whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Document whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Document whereTemplatesId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Document whereExecuteDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Document whereObservation($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Document whereUpdatedAt($value)
 */
class Document extends \Eloquent
{
    protected $fillable = ['serial', 'name', 'body', 'templates_id', 'execute_date'];

    public function template()
    {
        return $this->belongsTo('Innaco\Entities\Template', 'templates_id', 'id');
    }

    public function workflow()
    {
        return $this->hasMany('Innaco\Entities\Workflow', 'documents_id', 'id');
    }
}
