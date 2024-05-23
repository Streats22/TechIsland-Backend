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

class Schools extends model
{
    use HasFactory;
    public const TABLE = 'schools';

    protected $fillable = [
        'school_name',
        'school_dean',
        'adres',
        'street',
        'number',
        'number_extra',
        'adress',
        'school_phone',
        'contact_person_name',
        'contact_person_email',
        'contact_person_phone',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
