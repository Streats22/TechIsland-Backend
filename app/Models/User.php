<?php

namespace App\Models;

use Althinect\FilamentSpatieRolesPermissions\Concerns\HasSuperAdmin;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Password;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasSuperAdmin, HasRoles, CanResetPassword;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isTeacher()
    {
        return $this->hasRole('teacher');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->email;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\PasswordResetNotification($token));
    }
}
