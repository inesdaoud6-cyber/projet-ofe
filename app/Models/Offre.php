<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offre extends Model
{
    protected $fillable = [
        'title',
        'description',
        'domain',
        'location',
        'contract_type',
        'is_published',
        'deadline',
        'test_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'deadline'     => 'date',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(ApplicationProgress::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}