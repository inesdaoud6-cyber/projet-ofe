<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

class Question extends Model
{
    protected $fillable = [
        'block_id',
        'group_id',
<<<<<<< HEAD
=======
        'offre_id',
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
        'question_fr',
        'question_en',
        'question_ar',
        'component',
        'level',
        'obligatory',
        'scorable',
        'auto_evaluation',
<<<<<<< HEAD
=======
        'correct_answer',
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
        'classification',
        'max_note',
        'second_ratio',
        'user_note',
        'note_rule',
        'possible_answers',
    ];

    protected $casts = [
        'possible_answers' => 'array',
        'obligatory'       => 'boolean',
        'scorable'         => 'boolean',
        'auto_evaluation'  => 'boolean',
    ];

    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

<<<<<<< HEAD
=======
    public function offre(): BelongsTo
    {
        return $this->belongsTo(Offre::class);
    }

>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

<<<<<<< HEAD
=======
    public function tests()
    {
        return $this->belongsToMany(Test::class, 'question_test');
    }

>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    public function questionResponses(): HasMany
    {
        return $this->hasMany(QuestionResponse::class);
    }
}