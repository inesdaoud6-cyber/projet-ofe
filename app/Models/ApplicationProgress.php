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
        'score_published',
        'is_archived',
    ];

    protected $casts = [
        'apply_enabled'   => 'boolean',
        'score_published' => 'boolean',
        'is_archived'     => 'boolean',
        'main_score'      => 'decimal:2',
        'secondary_score' => 'decimal:2',
    ];

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function offre(): BelongsTo
    {
        return $this->belongsTo(Offre::class);
    }

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class, 'application_id');
    }

    public static function canGoToNextLevel(int $applicationId, int $currentLevel): bool
    {
        return self::where('id', $applicationId)
            ->where('current_level', '>', $currentLevel)
            ->where('status', 'validated')
            ->exists();
    }
}
