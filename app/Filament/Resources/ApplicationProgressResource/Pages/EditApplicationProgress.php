<?php

namespace App\Filament\Resources\ApplicationProgressResource\Pages;

use App\Filament\Resources\ApplicationProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicationProgress extends EditRecord
{
    protected static string $resource = ApplicationProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
