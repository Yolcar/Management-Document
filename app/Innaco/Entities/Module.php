<?php

namespace Innaco\Entities;

/**
 * Innaco\Entities\Module.
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Innaco\Entities\Groupacl[] $groupacls
 *
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Module whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Module whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Module whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Module whereUpdatedAt($value)
 */
class Module extends \Eloquent
{
    protected $fillable = ['name', 'available'];

    public function groupacls()
    {
        return $this->belongsToMany('Innaco\Entities\Groupacl');
    }
}
