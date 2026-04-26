<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Test extends Model
{
    protected $fillable = [
        'name',
        'description',
        'eligibility_threshold',
        'talent_threshold',
    ];

    public function offres(): HasMany
{
    return $this->hasMany(Offre::class, 'test_id');
}

    public function blocks()
    {
        return $this->belongsToMany(Block::class, 'test_block');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_test');
    }

    public function applicationProgresses(): HasMany
    {
        return $this->hasMany(ApplicationProgress::class);
    }
}