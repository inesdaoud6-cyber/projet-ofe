<?php
<<<<<<< HEAD
namespace App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource;
use Filament\Resources\Pages\CreateRecord;
class CreateTest extends CreateRecord {
    protected static string $resource = TestResource::class;
=======

namespace App\Filament\Resources\TestResource\Pages;

use App\Filament\Resources\TestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTest extends CreateRecord
{
    protected static string $resource = TestResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record]);
    }
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
}