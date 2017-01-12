<?php

namespace App;

use Eloquent;

class Candidate extends Eloquent {

    protected $table = 'candidates';
    public $incrementing = false;


    public function jobs()
    {
        return $this->belongsToMany('App\Job')->withTimestamps();
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

}

?>