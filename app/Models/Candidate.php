<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
<<<<<<< HEAD
=======
        'phone',
        'birth_date',
        'address',
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
        'cv_path',
        'primary_score',
        'secondary_score',
        'status',
        'score_visibility',
    ];

    protected $casts = [
        'score_visibility' => 'boolean',
<<<<<<< HEAD
=======
        'birth_date'       => 'date',
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(ApplicationProgress::class);
    }

<<<<<<< HEAD
=======
    public function applicationProgresses(): HasMany
    {
        return $this->hasMany(ApplicationProgress::class, 'candidate_id');
    }

    public function getEmailAttribute(): string
    {
        return $this->attributes['email'] ?? $this->user?->email ?? '';
    }

>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name) ?: $this->user?->name ?? 'Unknown';
    }
<<<<<<< HEAD
=======

    public function getTotalApplicationsAttribute(): int
    {
        return $this->applicationProgresses()->count();
    }
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
}