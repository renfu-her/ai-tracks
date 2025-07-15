<?php

namespace App\Filament\Resources\CasePhotoResource\Pages;

use App\Filament\Resources\CasePhotoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCasePhoto extends CreateRecord
{
    protected static string $resource = CasePhotoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 