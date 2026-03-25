<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offre extends Model
{
    protected $fillable = [
        'title',
        'description',
        'domain',
        'contract_type',
        'is_published',
        'deadline',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'deadline' => 'datetime',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(ApplicationProgress::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}