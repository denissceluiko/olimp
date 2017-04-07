<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function olympiad() {
        return $this->belongsTo('App\Olympiad');
    }
}
