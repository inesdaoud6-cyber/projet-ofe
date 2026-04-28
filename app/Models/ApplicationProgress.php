<?php
<<<<<<< HEAD
=======

>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

<<<<<<< HEAD

class ApplicationProgress extends Model
{
    protected $fillable = [
        'candidate_id',   
=======
class ApplicationProgress extends Model
{
    protected $fillable = [
        'candidate_id',
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
        'offre_id',
        'test_id',
        'status',
        'current_level',
        'main_score',
        'secondary_score',
        'apply_enabled',
        'score_published',
<<<<<<< HEAD
=======
        'is_archived',
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    ];

    protected $casts = [
        'apply_enabled'   => 'boolean',
        'score_published' => 'boolean',
<<<<<<< HEAD
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

   
    public function candidateProfile(): BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'user_id');
=======
        'is_archived'     => 'boolean',
        'main_score'      => 'decimal:2',
        'secondary_score' => 'decimal:2',
    ];

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    }

    public function offre(): BelongsTo
    {
        return $this->belongsTo(Offre::class);
    }

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }
<<<<<<< HEAD
public function application()
{
    return $this->belongsTo(Candidate::class);
}
public static function canGoToNextLevel($applicationId, $currentLevel)
{
    return self::where('application_id', $applicationId)
        ->where('level', $currentLevel)
        ->where('status', 'approved')
        ->exists();
}
=======
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class, 'application_id');
    }
<<<<<<< HEAD
=======

    public static function canGoToNextLevel(int $applicationId, int $currentLevel): bool
    {
        return self::where('id', $applicationId)
            ->where('current_level', '>', $currentLevel)
            ->where('status', 'validated')
            ->exists();
    }
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
}
