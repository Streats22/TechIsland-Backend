<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Students extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;
    protected $guarded = [];

    public const TABLE = 'students';

    protected $guard = 'student';

    protected $fillable = [
        'name',
        'student_number',
        'codename',
        'teacher_id',
        'email',
        'email_verified_at',
        'password',
        'result_1',
        'result_2',
        'result_3',
        'school_id',
        'visit_date',
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
    public function teacher()
    {
        $this->belongsTo(Teachers::class, 'teacher_id');
    }
    public function school()
    {
      return $this->belongsTo(Schools::class, 'school_id');
    }
    public function result_1()
    {
        $this->belongsTo(Workshops::class, 'result_1');
    }
    public function result_2()
    {
        $this->belongsTo(Workshops::class, 'result_2');
    }
    public function result_3()
    {
        $this->belongsTo(Workshops::class, 'result_3');
    }
}
