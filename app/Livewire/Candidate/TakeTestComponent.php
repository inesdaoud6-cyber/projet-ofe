<?php

namespace App\Livewire\Candidate;

use App\Models\Answer;
use App\Models\ApplicationProgress;
use App\Models\Candidate;
use App\Models\CandidateNotification;
use App\Models\Question;
use App\Models\QuestionResponse;
use App\Models\Response;
use Livewire\Component;

class TakeTestComponent extends Component
{
    public array $answers = [];
    public int $currentLevel = 1;
    public ?int $applicationId = null;
    public string $candidateName = '';
    public bool $hasTest = false;
    public bool $alreadySubmitted = false;
    public string $pageStatus = 'no_application';
    public int $totalQuestions = 0;
    public int $answeredCount = 0;
    public bool $autoSaving = false;
    public string $flashMessage = '';
    public string $flashType = '';

    public function mount(): void
    {
        $candidate = Candidate::where('user_id', auth()->id())->first();

        if (! $candidate) {
            $this->pageStatus = 'no_application';
            return;
        }

        $this->candidateName = $candidate->full_name ?? auth()->user()->name;
        $this->loadApplication($candidate);
    }

    private function loadApplication(Candidate $candidate): void
    {
        $application = ApplicationProgress::where('candidate_id', $candidate->id)
            ->whereNotIn('status', ['rejected'])
            ->whereNotNull('test_id')
            ->latest()
            ->first();

        if (! $application) {
            $this->hasTest    = false;
            $this->pageStatus = 'no_application';
            return;
        }

        $this->applicationId = $application->id;
        $this->currentLevel  = $application->current_level;
        $this->hasTest       = true;

        if ($application->status === 'pending') {
            $this->pageStatus = 'waiting_admin';
            return;
        }

        if ($application->status === 'validated') {
            $this->pageStatus = 'all_validated';
            return;
        }

        $existingResponse = Response::where('application_id', $application->id)
            ->where('level', $this->currentLevel)
            ->first();

        if ($existingResponse) {
            $this->alreadySubmitted = true;
            $this->pageStatus       = 'waiting_level_validation';
            $existing = QuestionResponse::where('response_id', $existingResponse->id)->get();
            foreach ($existing as $qr) {
                $this->answers[$qr->question_id] = $qr->text_answer ?? $qr->obtained_score;
            }
        } else {
            $this->pageStatus     = 'test';
            $this->totalQuestions = $this->getQuestions()->count();
        }
    }

    public function getApplication(): ?ApplicationProgress
    {
        if (! $this->applicationId) return null;
        return ApplicationProgress::find($this->applicationId);
    }

    public function getQuestions()
    {
        $application = $this->getApplication();
        if (! $application || ! $application->test_id) {
            return collect();
        }

        return Question::whereHas('tests', function ($q) use ($application) {
            $q->where('tests.id', $application->test_id);
        })
            ->where('level', $this->currentLevel)
            ->with('answers')
            ->get();
    }

    public function updatedAnswers(): void
    {
        $this->answeredCount = count(array_filter(
            $this->answers,
            fn ($a) => $a !== '' && $a !== null
        ));
    }

    public function autoSave(): void
    {
        $this->autoSaving = true;
        $this->saveAnswers();
        $this->autoSaving = false;
        $this->setFlash('✅ Sauvegarde automatique effectuée', 'success');
    }

    public function saveAnswers(): void
    {
        $application = $this->getApplication();
        if (! $application || $this->alreadySubmitted) return;

        $response = Response::firstOrCreate([
            'application_id' => $application->id,
            'level'          => $this->currentLevel,
        ]);

        $mainScore = $secondaryScore = 0;

        foreach ($this->answers as $questionId => $answer) {
            $question  = Question::find($questionId);
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
                $question->classification === 'primary'
                    ? $mainScore      += $autoScore
                    : $secondaryScore += $autoScore;
            }

            QuestionResponse::updateOrCreate(
                ['response_id' => $response->id, 'question_id' => $questionId],
                [
                    'answer_id'      => in_array($question?->component, ['radio', 'list'])
                        ? Answer::where('question_id', $questionId)->where('text', $answer)->value('id')
                        : null,
                    'auto_score'     => $autoScore,
                    'manual_score'   => 0,
                    'obtained_score' => $autoScore,
                    'text_answer'    => is_string($answer) ? $answer : null,
                ]
            );
        }

        $application->update([
            'main_score'      => $mainScore,
            'secondary_score' => $secondaryScore,
        ]);

        if (! $this->autoSaving) {
            $this->setFlash('💾 Réponses sauvegardées !', 'success');
        }
    }

    public function submitLevel(): void
    {
        if (empty($this->answers)) {
            $this->setFlash('⚠️ Veuillez répondre à au moins une question.', 'warning');
            return;
        }

        $this->saveAnswers();

        $application = $this->getApplication();
        if (! $application) return;

        $application->update(['status' => 'in_progress']);
        $this->alreadySubmitted = true;
        $this->pageStatus       = 'waiting_level_validation';

        CandidateNotification::create([
            'user_id'  => auth()->id(),
            'type'     => 'info',
            'title'    => '📋 Niveau ' . $this->currentLevel . ' soumis',
            'message'  => 'Vos réponses du niveau ' . $this->currentLevel . ' ont été soumises. En attente de validation.',
            'offre_id' => $application->offre_id,
        ]);

        $this->setFlash('✅ Niveau ' . $this->currentLevel . ' soumis avec succès !', 'success');
    }

    private function setFlash(string $message, string $type = 'success'): void
    {
        $this->flashMessage = $message;
        $this->flashType    = $type;
        $this->dispatch('flash-message');
    }

    public function clearFlash(): void
    {
        $this->flashMessage = '';
        $this->flashType    = '';
    }

    public function render()
    {
        return view('livewire.candidate.take-test-component', [
            'questions' => $this->pageStatus === 'test' ? $this->getQuestions() : collect(),
        ]);
    }
}