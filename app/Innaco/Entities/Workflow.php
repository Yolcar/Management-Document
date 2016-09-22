<?php

namespace Innaco\Entities;

/**
 * Innaco\Entities\Workflow.
 *
 * @property int $id
 * @property int $documents_id
 * @property int $users_id
 * @property int $states_id
 * @property int $stepsdocuments_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Innaco\Entities\Document $document
 * @property-read \Innaco\Entities\User $user
 * @property-read \Innaco\Entities\State $state
 * @property-read \Innaco\Entities\StepDocument $stepdocument
 *
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Workflow whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Workflow whereDocumentsId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Workflow whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Workflow whereStatesId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Workflow whereStepsdocumentsId($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Workflow whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Innaco\Entities\Workflow whereUpdatedAt($value)
 */
class Workflow extends \Eloquent
{
    protected $fillable = ['documents_id', 'users_id', 'states_id', 'stepsdocuments_id'];

    public function document()
    {
        return $this->belongsTo('Innaco\Entities\Document', 'document_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('Innaco\Entities\User', 'users_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo('Innaco\Entities\State', 'states_id', 'id');
    }

    public function stepdocument()
    {
        return $this->belongsTo('Innaco\Entities\StepDocument', 'stepsdocuments_id', 'id');
    }
}
