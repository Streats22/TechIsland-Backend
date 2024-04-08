<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teachers extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'school',
        'student_number',
        'email',
        'dean_id',
        'email_verified_at',
        'password'
    ];
    public function dean(){
        $this->belongsTo(Deans::class, 'dean_id');
    }
}
