<?php

namespace App\Filament\Resources\ProjectCaseResource\Pages;

use App\Filament\Resources\ProjectCaseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProjectCase extends CreateRecord
{
    protected static string $resource = ProjectCaseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 