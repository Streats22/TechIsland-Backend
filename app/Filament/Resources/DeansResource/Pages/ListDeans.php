<?php

namespace App\Filament\Resources\DeansResource\Pages;

use App\Filament\Resources\DeansResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeans extends ListRecords
{
    protected static string $resource = DeansResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
