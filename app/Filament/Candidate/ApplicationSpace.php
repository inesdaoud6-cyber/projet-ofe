<?php

namespace App\Filament\Candidate\Pages;

use Filament\Pages\Page;
use App\Models\ApplicationProgress;

class ApplicationSpace extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static string $view = 'filament.candidate.pages.application-space';
    protected static ?string $title = 'My Applications & Profile';
    protected static ?string $slug = 'applications';

    public function getViewData(): array
    {
        $user = auth()->user();
        $applications = ApplicationProgress::where('candidate_id', $user->id)
            ->latest()
            ->get();

        $totalApplications = $applications->count();
        
        $averageScore = $applications->avg('main_score');
        if ($averageScore === null) {
            $averageScore = 0;
        }

        $candidateName = $user->candidate ? 
            trim($user->candidate->first_name . ' ' . $user->candidate->last_name) : 
            $user->name;

        return [
            'candidateName' => $candidateName,
            'totalApplications' => $totalApplications,
            'averageScore' => round($averageScore, 2),
            'applications' => $applications,
        ];
    }
}