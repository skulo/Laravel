<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'win', 'history', 'user_id', 'place_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class)
            ->withPivot('hero_hp', 'enemy_hp')
            ->withTimestamps();
    }
}
