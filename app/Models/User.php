<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, InteractsWithMedia, Notifiable, Impersonate, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'club_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole($role){
        switch ($role){
            case 'super-admin': return $this->role_id == Role::ROLE_SUPER_ADMIN;
            case 'club-admin': return $this->role_id == Role::ROLE_CLUB_ADMIN;
        }
        return false;
    }

    public function isSuperAdmin(){
        return $this->role_id == Role::ROLE_SUPER_ADMIN;
    }

    public function isClubAdmin(){
        return $this->role_id == Role::ROLE_CLUB_ADMIN;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function club(){
        return $this->belongsTo(Club::class);
    }

    public function canImpersonate()
    {
        return $this->isSuperAdmin();
    }
}
