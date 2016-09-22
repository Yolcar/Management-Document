<?php

namespace Innaco\Entities;

/**
 * Innaco\Entities\typeDocument.
 *
 * @property int $id
 * @property string $name
 * @property bool $available
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\Template[] $template
 *
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\typeDocument whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\typeDocument whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\typeDocument whereAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\typeDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\typeDocument whereUpdatedAt($value)
 */
class TypeDocument extends \Eloquent
{
    protected $fillable = ['name', 'available'];

    public function template()
    {
        return $this->hasMany('Innaco\Entities\Template', 'typedocuments_id', 'id');
    }
}
