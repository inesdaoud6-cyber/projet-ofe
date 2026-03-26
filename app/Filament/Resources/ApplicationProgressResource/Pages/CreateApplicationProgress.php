<?php

namespace App\Filament\Resources\ApplicationProgressResource\Pages;

use App\Filament\Resources\ApplicationProgressResource;
use Filament\Resources\Pages\CreateRecord;

class CreateApplicationProgress extends CreateRecord
{

    protected static string $resource = ApplicationProgressResource::class;
  protected function mutateFormDataBeforeCreate(array $data): array
{
    $canProceed = \App\Models\ApplicationProgress::canGoToNextLevel(
        $data['application_id'],
        $data['level'] - 1
    );

    if ($data['level'] > 1 && !$canProceed) {
        throw new \Exception("You cannot proceed to next level without approval.");
    }

    return $data;
}
}