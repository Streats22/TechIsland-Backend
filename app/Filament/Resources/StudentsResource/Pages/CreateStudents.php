<?php

namespace App\Filament\Resources\StudentsResource\Pages;

use App\Filament\Resources\StudentsResource;
use App\Models\Students;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateStudents extends CreateRecord
{
    protected static string $resource = StudentsResource::class;
    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Generate a secure random password
        $password = Str::random(10);
        $data['password'] = Hash::make($password);

        $teacher = Auth::guard('teacher')->user();
        // Now, store the dean with the generated password
        // Assuming `Deans` is your model name, and it's properly set up with fillable attributes
        $this->record = static::getModel()::create($data);
        $this->record->update([
            'teacher_id' => $teacher->id,
        ]);
        $user = Students::where('id', $this->record->id)->first();
//        $user->assignRole('student');

        // Optionally, send an email to the dean with instructions on how to reset their password
        // You might use Laravel's built-in notification system for this
        return $this->record;
    }
}
