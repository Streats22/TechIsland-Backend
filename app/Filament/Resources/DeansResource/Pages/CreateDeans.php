<?php

namespace App\Filament\Resources\DeansResource\Pages;

use App\Filament\Resources\DeansResource;
use App\Models\Deans;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class CreateDeans extends CreateRecord
{
    protected static string $resource = DeansResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Generate a secure random password
        $password = Str::random(10);
        $admin = Auth::guard('web')->user();
        $data['password'] = Hash::make($password);

        // Store the dean with the generated password
        $this->record = static::getModel()::create($data);
        $this->record->update([
            'administrator_id' => $admin->id,
        ]);
        // Automatically send a password reset link
        $this->sendPasswordReset($this->record);
        return $this->record;
    }

    protected function sendPasswordReset(Deans $dean)
    {
        // Create a password reset token and send it via the notification system
        $token = Password::broker()->createToken($dean);
        $dean->sendPasswordResetNotification($token);
    }
}
