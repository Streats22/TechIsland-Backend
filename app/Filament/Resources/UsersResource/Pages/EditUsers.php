<?php

namespace App\Filament\Resources\UsersResource\Pages;

use App\Filament\Resources\UsersResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditUsers extends EditRecord
{
    protected static string $resource = UsersResource::class;
    protected static ?string $model = User::class;

    protected function getHeaderActions(): array
    {
        $user = Auth::guard('web')->user();
        if (static::$model::where('id', $user->id)) {
            return [];
        } else {
            return [
                Actions\DeleteAction::make(),
            ];
        }
    }
}
