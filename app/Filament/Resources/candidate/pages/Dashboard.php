<?php

namespace App\Filament\Candidate\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.candidate.pages.dashboard';
    protected static ?string $title = 'Mon Espace Candidat';
    protected static ?string $slug = 'dashboard';

    public static function getNavigationLabel(): string
    {
        return 'Dashboard';
    }
}