<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Students extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $guarded = [];

    public const TABLE = 'students';

    protected $table = self::TABLE;

    protected $guard = 'student';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
