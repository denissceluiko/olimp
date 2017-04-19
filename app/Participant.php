<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
