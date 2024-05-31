<?php

namespace App\Filament\Resources\DeansResource\Pages;

use App\Filament\Resources\DeansResource;
use App\Models\Deans;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditDeans extends EditRecord
{
    protected static string $resource = DeansResource::class;
    protected static ?string $model = Deans::class;

    protected function getHeaderActions(): array
    {
        $user = Auth::guard('web')->user();
        $dean = Auth::guard('dean')->user();
        if ( $user)   {
            return  [  Actions\DeleteAction::make(),];
        }elseif(static::$model::where('id', $dean->id)){
            return [

            ];
        }

    }
}
