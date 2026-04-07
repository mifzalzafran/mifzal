<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name', 'capacity', 'description', 'facilities', 'is_active'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
