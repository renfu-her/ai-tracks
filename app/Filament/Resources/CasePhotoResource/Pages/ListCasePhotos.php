<?php

namespace App\Filament\Resources\CasePhotoResource\Pages;

use App\Filament\Resources\CasePhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCasePhotos extends ListRecords
{
    protected static string $resource = CasePhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 