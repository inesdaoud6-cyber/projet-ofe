<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    protected $fillable = [
        'name',
        'description',
        'eligibility_threshold',
        'talent_threshold',
        'offre_id',
    ];

    protected $casts = [
        'eligibility_threshold' => 'float',
        'talent_threshold'      => 'float',
    ];

    public function offre(): BelongsTo
    {
        return $this->belongsTo(Offre::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class);
    }
}