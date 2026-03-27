<?php

namespace App\Filament\Candidate\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use App\Models\ApplicationProgress;
use App\Models\Offre;

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
                ->icon('heroicon-o-plus-circle')
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
                    
                    $this->redirect('/candidate/application-choice');
                }),
        ];
    }

    public function getViewData(): array
    {
        $user = auth()->user();
        $applications = ApplicationProgress::where('candidate_id', $user->id)->get();
        $pendingApps = $applications->where('status', 'pending')->count();
        $completedApps = $applications->where('status', 'validated')->count();

        return [
            'userName' => $user->name,
            'totalApplications' => $applications->count(),
            'pendingApplications' => $pendingApps,
            'completedApplications' => $completedApps,
            'recentApplications' => $applications->latest()->take(5),
        ];
    }
}