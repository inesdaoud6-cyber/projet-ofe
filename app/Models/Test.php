<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    protected $fillable = [
        'name',
        'description',
        'eligibility_threshold',
        'talent_threshold',
    ];

    protected $casts = [
        'eligibility_threshold' => 'float',
        'talent_threshold' => 'float',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class);
    }
}