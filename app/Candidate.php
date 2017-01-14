<?php

namespace App;

use Eloquent;

class Candidate extends Eloquent {

    protected $table = 'candidates';
    public $incrementing = false;


    public function jobs()
    {
        return $this->belongsToMany('App\Job');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
    
    public function ownedBy($user_id)
    {
        return $this->user_id === $user_id;
    }

}

?>