<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    const ROLE_SUPER_ADMIN = 1;
    const ROLE_CLUB_ADMIN = 2;
}
