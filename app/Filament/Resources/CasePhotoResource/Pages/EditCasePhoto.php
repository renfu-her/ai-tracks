<?php

namespace App\Filament\Resources\CasePhotoResource\Pages;

use App\Filament\Resources\CasePhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCasePhoto extends EditRecord
{
    protected static string $resource = CasePhotoResource::class;

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