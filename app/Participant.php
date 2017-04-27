<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Pivot
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function olympiad() {
        return $this->belongsTo(Olympiad::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }
}
