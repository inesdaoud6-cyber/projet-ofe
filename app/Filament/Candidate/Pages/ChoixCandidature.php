<?php

namespace App\Filament\Candidate\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use App\Models\ApplicationProgress;
use App\Models\Offre;
use Filament\Forms\Components\Select;

class ChoixCandidature extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.candidate.pages.choix-candidature';
    protected static ?string $title = 'Choose My Application';
    protected static ?string $slug = 'choix-candidature';

    public function candidatLibre(): void
    {
        ApplicationProgress::firstOrCreate([
            'candidate_id' => auth()->id(),
            'offre_id' => null,
        ], [
            'status' => 'pending',
            'current_level' => 1,
            'main_score' => 0,
            'secondary_score' => 0,
        ]);

        $this->redirect(route('filament.candidate.pages.upload-cv'));
    }

    public function candidateOffre(int $offreId): void
    {
        ApplicationProgress::firstOrCreate([
            'candidate_id' => auth()->id(),
            'offre_id' => $offreId,
        ], [
            'status' => 'pending',
            'current_level' => 1,
            'main_score' => 0,
            'secondary_score' => 0,
        ]);

        $this->redirect(route('filament.candidate.pages.upload-cv'));
    }
}