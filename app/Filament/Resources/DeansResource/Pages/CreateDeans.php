<?php

namespace App\Filament\Resources\DeansResource\Pages;

use App\Filament\Resources\DeansResource;
use App\Models\Deans;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateDeans extends CreateRecord
{
    protected static string $resource = DeansResource::class;
    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Generate a secure random password
        $password = Str::random(10);
        $data['administrator_id'] = Auth::id();
        $data['password'] = Hash::make($password);

        // Now, store the dean with the generated password
        // Assuming `Deans` is your model name, and it's properly set up with fillable attributes

        $this->record = static::getModel()::create($data);
        $user = Deans::where('id', $this->record->id)->first();
        $user->role();
        // Optionally, send an email to the dean with instructions on how to reset their password
        // You might use Laravel's built-in notification system for this
        return $this->record;
    }
}
