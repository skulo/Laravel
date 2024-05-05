<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Character extends Model
{


    protected $table = 'characters';


    use HasFactory;

    protected $fillable = [
        'name', 'enemy', 'defence', 'strength', 'accuracy', 'magic', 'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contests()
    {
        return $this->belongsToMany(Contest::class)->withPivot('hero_hp', 'enemy_hp');
    }
}
