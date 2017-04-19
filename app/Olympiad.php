<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Olympiad extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function rooms() {
        return $this->hasMany('App\Room');
    }
    
    public function participants() {
        return $this->hasMany('App\Participant');
    }
}
