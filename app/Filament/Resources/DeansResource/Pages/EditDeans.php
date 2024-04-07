<?php

namespace App\Filament\Resources\DeansResource\Pages;

use App\Filament\Resources\DeansResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeans extends EditRecord
{
    protected static string $resource = DeansResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
