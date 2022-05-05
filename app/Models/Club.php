<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Club extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function clubAdmins(){
        return $this->hasMany(User::class, 'club_id', 'id');
    }

    public function teams(){
        return $this->hasMany(Team::class);
    }
}
