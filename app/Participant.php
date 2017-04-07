<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public function student() {
        return $this->belongsTo('App\Student');
    }

    public function olympiad() {
        return $this->belongsTo('App\Olympiad');
    }

    public function room() {
        return $this->belongsTo('App\Room');
    }
}
