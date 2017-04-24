<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Olympiad extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at', 'date'];

    public function rooms() {
        return $this->hasMany(Room::class);
    }
    
    public function participants() {
        return $this->belongsToMany(Student::class, 'participants');
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
