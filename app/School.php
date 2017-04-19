<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function students() {
        return $this->hasMany('App\Student');
    }
}
