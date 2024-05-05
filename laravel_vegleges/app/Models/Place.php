<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    public function contests()
    {
        return $this->hasMany(Contest::class);
    }
}
