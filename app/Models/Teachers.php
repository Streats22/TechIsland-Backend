<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Traits\HasRoles;

class Teachers extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles, CanResetPassword;

    protected $fillable = [
        'first_name',
        'last_name',
        'school',
        'student_number',
        'email',
        'dean_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'password',
        'remember_token',
    ];

    public function isTeacher()
    {
        return $this->hasRole('teacher');
    }
    public function dean()
    {
        return $this->belongsTo(Deans::class, 'dean_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->email;
    }
    public function students()
    {
        return $this->belongsTo(Students::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\PasswordResetNotification($token));
    }
}
