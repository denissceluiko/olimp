<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function olympiad() {
        return $this->belongsTo(Olympiad::class);
    }

    public function occupants() {
        return $this->hasManyThrough(Student::class, Participant::class);
    }

    public static function getRoom($grade) {
        $res = DB::table('rooms')
            ->select(['rooms.id', 'rooms.seats', 'participants.grade', DB::raw('count(`participants`.`grade`) as grade_count')])
            ->leftJoin('participants', 'rooms.id', '=', 'participants.room_id')
            ->groupBy(['rooms.id', 'grade'])
            ->orderBy('grade_count', 'asc')
            ->get();

        foreach ($res as $seat) {
            if ($seat->grade == null) return $seat->id;
            else if ($seat->grade == $grade && $seat->grade_count / $seat->seats < 0.5) return $seat->id;
        }
        return null;
    }
}
