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
            ->latest()->first();

        if (!$this->application) {
            $this->redirect('/candidate/dashboard');
            return;
        }

        $this->currentLevel = $this->application->current_level;

        // Pré-remplir les réponses déjà sauvegardées pour ce niveau
        $response = Response::where('application_id', $this->application->id)
            ->where('level', $this->currentLevel)
            ->first();

        if ($response) {
            $existing = QuestionResponse::where('response_id', $response->id)->get();
            foreach ($existing as $qr) {
                $this->answers[$qr->question_id] = $qr->text_answer ?? $qr->obtained_score;
            }
        }
    }

    public function getQuestions()
    {
        return Question::where('level', $this->currentLevel)->get();
    }

    public function saveAnswers(): void
    {
        
        $response = Response::firstOrCreate(
            [
                'application_id' => $this->application->id,
                'level'          => $this->currentLevel,   
            ]
        );

        $mainScore      = 0;
        $secondaryScore = 0;

        foreach ($this->answers as $questionId => $answer) {
            $question  = Question::find($questionId);
            $autoScore = 0;

            if ($question && $question->scorable) {
                if (in_array($question->component, ['radio', 'list'])) {
                    $correctAnswer = Answer::where('question_id', $questionId)
                        ->where('is_correct', true)
                        ->first();

                    if ($correctAnswer && $correctAnswer->value === $answer) {
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
                    
                    'answer_id'    => in_array($question?->component, ['radio', 'list'])
                        ? Answer::where('question_id', $questionId)->where('value', $answer)->value('id')
                        : null,
                    'auto_score'    => $autoScore,
                    'manual_score'  => 0,
                    'obtained_score'=> $autoScore,
                    'text_answer'   => is_string($answer) ? $answer : null,
                ]
            );
        }

      
        $allResponses = Response::where('application_id', $this->application->id)
            ->where('level', $this->currentLevel)
            ->with('questionResponses.question')
            ->get();

        $totalMain      = 0;
        $totalSecondary = 0;

        foreach ($allResponses as $r) {
            foreach ($r->questionResponses as $qr) {
                if ($qr->question?->classification === 'primary') {
                    $totalMain += $qr->obtained_score;
                } else {
                    $totalSecondary += $qr->obtained_score;
                }
            }
        }

        $this->application->update([
            'main_score'      => $totalMain,
            'secondary_score' => $totalSecondary,
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
