<?php

namespace App\Filament\Widgets;

use App\Models\ApplicationProgress;
use App\Models\Candidate;
use App\Models\Offre;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Candidats', User::where('is_admin', false)->count())
                ->description('Comptes candidats enregistrés')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary')
                ->chart([3, 5, 8, 12, 15, 20, User::where('is_admin', false)->count()]),

            Stat::make('Candidatures', ApplicationProgress::count())
                ->description(ApplicationProgress::where('status', 'pending')->count() . ' en attente')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning')
                ->chart([1, 3, 5, 7, 10, 12, ApplicationProgress::count()]),

            Stat::make('Offres Publiées', Offre::where('is_published', true)->count())
                ->description('sur ' . Offre::count() . ' offres totales')
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('success'),

            Stat::make('Validés', ApplicationProgress::where('status', 'validated')->count())
                ->description('candidatures validées')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}