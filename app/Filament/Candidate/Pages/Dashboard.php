<?php

namespace App\Filament\Candidate\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;
use App\Models\ApplicationProgress;
use App\Models\CandidateNotification;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.candidate.pages.dashboard';
    protected static ?string $title = 'Mon Espace';
    protected static ?string $slug = 'dashboard';
    protected static ?int $navigationSort = 1;

    protected function getViewData(): array
    {
        $user = Auth::user();
        $candidate = $user->candidate;
        $isAdminViewing = $user->hasRole('admin');

        $applications = $candidate
            ? ApplicationProgress::where('candidate_id', $candidate->id)->with(['offre', 'test'])->latest()->get()
            : collect();

        $unreadCount = $candidate
            ? CandidateNotification::where('candidate_id', $candidate->id)->where('is_read', false)->count()
            : 0;

        return [
            'isAdminViewing'        => $isAdminViewing,
            'userName'              => $user->name,
            'pendingApplications'   => $applications->where('status', 'pending')->count(),
            'completedApplications' => $applications->where('status', 'validated')->count(),
            'recentApplications'    => $applications->take(5),
            'unreadCount'           => $unreadCount,
        ];
    }

    protected function getHeaderActions(): array
    {
        if (! auth()->user()->can('view-all-applications')) {
            return [];
        }

        return [
            Action::make('backToAdmin')
                ->label('Retour au panel admin')
                ->icon('heroicon-o-arrow-left')
                ->color('warning')
                ->url('/admin'),
        ];
    }
}
