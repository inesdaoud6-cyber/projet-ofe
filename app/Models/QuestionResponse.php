<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionResponse extends Model
{
    protected $fillable = [
        'response_id',
        'question_id',
        'answer_id',
        'auto_score',
        'manual_score',
        'obtained_score',
    ];

    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }

    public function getAnswerTextAttribute(): string
    {
        if (!$this->answer) return 'No answer provided';
        return $this->answer->text ?? $this->answer->name ?? 'No answer';
    }

    public function getScoreAttribute(): float
    {
        return $this->obtained_score ?? $this->auto_score ?? 0;
    }
}