<?php

namespace App\Models;

use Althinect\FilamentSpatieRolesPermissions\Concerns\HasSuperAdmin;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Workshops extends model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'type',
        'name',
        'company_school',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        ];
}
