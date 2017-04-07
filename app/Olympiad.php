<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Olympiad extends Model
{
    public function rooms() {
        return $this->hasMany('App\Room');
    }
    
    public function participants() {
        return $this->hasMany('App\Participant');
    }
}
