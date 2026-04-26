<?php

namespace App\Filament\Candidate\Pages;

use Filament\Pages\Page;

class TakeTest extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static string $view = 'filament.candidate.pages.take-test';
    protected static ?string $title = 'Passer le Test';
    protected static ?string $slug = 'take-test';
    protected static bool $shouldRegisterNavigation = false;
}