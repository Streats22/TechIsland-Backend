<?php

namespace App\Filament\Resources\WorkshopsResource\Pages;

use App\Filament\Resources\WorkshopsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkshops extends EditRecord
{
    protected static string $resource = WorkshopsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
