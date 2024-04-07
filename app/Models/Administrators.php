<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Althinect\FilamentSpatieRolesPermissions\Concerns\HasSuperAdmin;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrators extends Authenticatable
{
    use HasFactory;
    use HasSuperAdmin;
}
