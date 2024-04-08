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

    protected $guard = 'student';

    protected $fillable = [
        'name',
        'school',
        'student_number',
        'codename',
        'teacher_id',
        'email',
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
    public function teacher()
    {
        $this->belongsTo(Teachers::class, 'teacher_id');
    }
}
