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
    protected static ?string $title = 'My Candidate Space';
    protected static ?string $slug = 'dashboard';

    protected function getActions(): array
    {
        return [
            Action::make('postuler_libre')
                ->label('Free Application')
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
                ->label('Apply to an Offer')
                ->color('success')
                ->form([
                    Select::make('offre_id')
                        ->label('Choose an offer')
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