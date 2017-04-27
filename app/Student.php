<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Student extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function school() {
        return $this->belongsTo(School::class);
    }

    public function scopeSearch(Builder $query, $query_str) {
        return $query->where('name', 'like', '%'.$query_str.'%')
            ->orWhere('surname', 'like', '%'.$query_str.'%');
    }

    public function olympiads() {
        return $this->belongsToMany(Olympiad::class, 'participants')
            ->withPivot(['grade', 'room_id'])
            ->using(Participant::class);
    }
}
