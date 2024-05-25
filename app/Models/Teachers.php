<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    public function isTeacher()
    {
        return $this->hasRole('teacher');
    }

    public function dean()
    {
        return $this->belongsTo(Deans::class, 'dean_id');
    }

    protected static function booted()
    {
        static::created(function ($teacher) {
            $teacher->assignRole('Teacher');
        });
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('teacher') && $this->email_verified_at !== null;
    }

    public function students()
    {
        return $this->hasMany(Students::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\PasswordResetNotification($token));
    }

    // Implement getFilamentAvatarUrl to return a default URL or null
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($this->first_name . ' ' . $this->last_name);
    }
}
