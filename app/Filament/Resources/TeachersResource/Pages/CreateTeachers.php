<?php

namespace App\Filament\Resources\TeachersResource\Pages;

use App\Filament\Resources\TeachersResource;
use App\Mail\PasswordResetTeacher;
use App\Models\Deans;
use App\Models\Teachers;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class CreateTeachers extends CreateRecord
{
    protected static string $resource = TeachersResource::class;
    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Generate a secure random password
        $password = Str::random(10);
        $data['dean_id'] = Auth::id();
        $data['password'] = Hash::make($password);

        // Now, store the dean with the generated password
        // Assuming `Deans` is your model name, and it's properly set up with fillable attributes
        $this->record = static::getModel()::create($data);

        $user = Teachers::where('id', $this->record->id)->first();
        $this->sendPasswordReset($this->record);
        $user->assignRole('teacher');

        // Optionally, send an email to the dean with instructions on how to reset their password
        // You might use Laravel's built-in notification system for this
      ;
        return $this->record;
    }
    protected function sendPasswordReset(Deans $dean)
    {
        // Create a password reset token and send it via the notification system
        $token = Password::broker()->createToken($dean);
        $dean->sendPasswordResetNotification($token);
    }

}
