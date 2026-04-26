<?php

namespace App\Filament\Candidate\Pages;

use App\Models\CandidateNotification;
use App\Models\Offre;
use Filament\Pages\Page;

class Notifications extends Page
{
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.candidate.pages.notifications';
    protected static ?string $title = 'Notifications';
    protected static ?string $slug = 'notifications';

    public $notifications;
    public $offresNouvelles;

    public function mount(): void
    {
        $this->notifications = CandidateNotification::where('user_id', auth()->id())
            ->latest()
            ->get();

        CandidateNotification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $this->offresNouvelles = Offre::where('is_published', true)
            ->latest()
            ->take(5)
            ->get();
    }
}