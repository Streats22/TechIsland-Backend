<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Deans extends Model
{
    use HasFactory, Notifiable;
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
        $this->belongsTo(User::class, 'administrator_id', 'id');
    }
}
