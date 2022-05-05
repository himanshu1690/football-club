<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PlayerGroup extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['name', 'team_id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function players(){
        return $this->hasMany(Player::class);
    }
}
