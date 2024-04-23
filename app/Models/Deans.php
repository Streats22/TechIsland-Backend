<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Password;

class Deans extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles, CanResetPassword;

    protected $fillable = [
        'first_name',
        'last_name',
        'school',
        'email',
        'administrator_id',
        'email_verified_at',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function administrator()
    {
        return $this->belongsTo(User::class, 'administrator_id', 'id');
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
