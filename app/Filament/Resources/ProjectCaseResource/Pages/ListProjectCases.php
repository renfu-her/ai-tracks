<?php

namespace App\Filament\Resources\ProjectCaseResource\Pages;

use App\Filament\Resources\ProjectCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectCases extends ListRecords
{
    protected static string $resource = ProjectCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 