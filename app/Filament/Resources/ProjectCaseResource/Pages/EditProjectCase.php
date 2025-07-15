<?php

namespace App\Filament\Resources\ProjectCaseResource\Pages;

use App\Filament\Resources\ProjectCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectCase extends EditRecord
{
    protected static string $resource = ProjectCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 