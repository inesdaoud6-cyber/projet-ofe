<?php

namespace App\Filament\Candidate\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use App\Models\ApplicationProgress;
use App\Models\Offre;
use Filament\Forms\Components\Select;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.candidate.pages.dashboard';
    protected static ?string $title = 'Mon Espace Candidat';
    protected static ?string $slug = 'dashboard';

    protected function getActions(): array
    {
        return [
            Action::make('postuler_libre')
                ->label('Candidat Libre')
                ->color('warning')
                ->action(function () {
                    ApplicationProgress::firstOrCreate([
                        'candidate_id' => auth()->id(),
                        'offre_id' => null,
                    ], [
                        'status' => 'pending',
                        'current_level' => 1,
                        'main_score' => 0,
                        'secondary_score' => 0,
                    ]);
                }),

            Action::make('postuler_offre')
                ->label('Postuler a une Offre')
                ->color('success')
                ->form([
                    Select::make('offre_id')
                        ->label('Choisir une offre')
                        ->options(Offre::where('is_published', true)->pluck('title', 'id'))
                        ->required(),
                ])
                ->action(function (array $data) {
                    ApplicationProgress::firstOrCreate([
                        'candidate_id' => auth()->id(),
                        'offre_id' => $data['offre_id'],
                    ], [
                        'status' => 'pending',
                        'current_level' => 1,
                        'main_score' => 0,
                        'secondary_score' => 0,
                    ]);
                }),
        ];
    }
}