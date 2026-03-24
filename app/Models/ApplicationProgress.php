<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApplicationProgress extends Model
{
    protected $fillable = [
        'candidate_id',
        'offre_id',
        'test_id',
        'status',
        'current_level',
        'main_score',
        'secondary_score',
        'apply_enabled',
        'score_published'
    ];

    protected $casts = [
        'apply_enabled' => 'boolean',
        'score_published' => 'boolean',
    ];

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function offre(): BelongsTo
    {
        return $this->belongsTo(Offre::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class, 'application_id');
    }

    public function getCandidateNameAttribute(): string
    {
        return $this->candidate?->name ?? 'Unknown Candidate';
    }

    public function getFullCandidateNameAttribute(): string
    {
        $user = $this->candidate;
        if (!$user) return 'Unknown Candidate';
        
        $firstName = $user->candidate?->first_name ?? '';
        $lastName = $user->candidate?->last_name ?? '';
        
        return trim("$firstName $lastName") ?: $user->name;
    }
}