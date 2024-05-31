<?php

namespace App\Filament\Resources\TeachersResource\Pages;

use App\Filament\Resources\TeachersResource;
use App\Models\Teachers;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditTeachers extends EditRecord
{
    protected static string $resource = TeachersResource::class;
    protected static ?string $model = Teachers::class;

    protected function getHeaderActions(): array
    {

        $user = Auth::guard('web')->user();
        $dean = Auth::guard('dean')->user();
        $teacher = Auth::guard('teacher')->user();


        if ($user) {
            return [Actions\DeleteAction::make(),];
        }elseif($dean) {
            return [Actions\DeleteAction::make(),];
        }
        elseif (static::$model::where('id', $teacher->id)) {
            return [];
        }
    }
}
