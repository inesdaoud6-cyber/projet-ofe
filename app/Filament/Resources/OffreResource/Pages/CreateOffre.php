<?php
<<<<<<< HEAD
namespace App\Filament\Resources\OffreResource\Pages;
use App\Filament\Resources\OffreResource;
use Filament\Resources\Pages\CreateRecord;
class CreateOffre extends CreateRecord {
    protected static string $resource = OffreResource::class;
=======

namespace App\Filament\Resources\OffreResource\Pages;

use App\Filament\Resources\OffreResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOffre extends CreateRecord
{
    protected static string $resource = OffreResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
}