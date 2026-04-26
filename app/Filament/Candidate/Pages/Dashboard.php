<?php

namespace App\Filament\Candidate\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.candidate.pages.dashboard';
    protected static ?string $title = 'Mon Espace';
    protected static ?string $slug = 'dashboard';
    protected static ?int $navigationSort = 1;

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