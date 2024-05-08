<?php

namespace App\Filament\Resources\WorkshopsResource\Pages;

use App\Filament\Resources\WorkshopsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkshops extends ListRecords
{
    protected static string $resource = WorkshopsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
