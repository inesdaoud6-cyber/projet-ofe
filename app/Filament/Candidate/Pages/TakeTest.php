<?php

namespace App\Filament\Candidate\Pages;

use Filament\Pages\Page;
use App\Models\Question;
use App\Models\ApplicationProgress;
use App\Models\Response;
use App\Models\QuestionResponse;
use Filament\Notifications\Notification;
use App\Models\Answer;

class TakeTest extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static string $view = 'filament.candidate.pages.take-test';
    protected static ?string $title = 'Take Test';
    protected static ?string $slug = 'take-test';

    public array $answers = [];
    public int $currentLevel = 1;
    public ?ApplicationProgress $application = null;

    public function mount(): void
    {
        $this->application = ApplicationProgress::where('candidate_id', auth()->id())
            ->latest()
            ->first();

        if (!$this->application) {
            $this->redirect('/candidate/dashboard');
            return;
        }

        $this->currentLevel = $this->application->current_level;
    }

    public function getQuestions()
    {
        return Question::where('level', $this->currentLevel)->get();
    }

    public function saveAnswers(): void
    {
        $response = Response::firstOrCreate([
            'application_id' => $this->application->id,
        ]);

        $mainScore = 0;
        $secondaryScore = 0;

        foreach ($this->answers as $questionId => $answer) {
            $question = Question::find($questionId);
            $autoScore = 0;

            if ($question && $question->scorable) {
                if (in_array($question->component, ['radio', 'list'])) {
                    $correctAnswer = Answer::where('question_id', $questionId)
                        ->where('is_correct', true)
                        ->first();

                    if ($correctAnswer && $correctAnswer->text === $answer) {
                        $autoScore = $question->max_note ?? 0;
                    }
                }

                if ($question->classification === 'primary') {
                    $mainScore += $autoScore;
                } else {
                    $secondaryScore += $autoScore;
                }
            }

            QuestionResponse::updateOrCreate(
                [
                    'response_id' => $response->id,
                    'question_id' => $questionId,
                ],
                [
                    'answer_id' => null,
                    'auto_score' => $autoScore,
                    'manual_score' => 0,
                    'obtained_score' => $autoScore,
                    'text_answer' => is_string($answer) ? $answer : null,
                ]
            );
        }

        $this->application->update([
            'main_score' => $mainScore,
            'secondary_score' => $secondaryScore,
        ]);

        Notification::make()
            ->title('Answers saved!')
            ->success()
            ->send();
    }

    public function submitLevel(): void
    {
        $this->saveAnswers();

        $this->application->update(['status' => 'in_progress']);

        Notification::make()
            ->title('Level ' . $this->currentLevel . ' submitted! Awaiting validation.')
            ->success()
            ->send();

        $this->redirect('/candidate/dashboard');
    }
}