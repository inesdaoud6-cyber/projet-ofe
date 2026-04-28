<?php

namespace App\Filament\Resources\CandidateResource\Pages;

use App\Filament\Resources\CandidateResource;
<<<<<<< HEAD
use Filament\Actions;
=======
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
use Filament\Resources\Pages\ListRecords;

class ListCandidates extends ListRecords
{
    protected static string $resource = CandidateResource::class;

    protected function getHeaderActions(): array
    {
<<<<<<< HEAD
        return [Actions\CreateAction::make()];
=======
        return [];
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    }
}