<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Olympiad extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function rooms() {
        return $this->hasMany(Room::class);
    }
    
    public function participants() {
        return $this->hasMany(Participant::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
