<?php

namespace App;

use Eloquent;

class Job extends Eloquent {

    protected $table = 'jobs';
    public $incrementing = false;
    
    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function candidates()
    {
        return $this->belongsToMany('App\Candidate')->withPivot('created_at');
    }

    public function test()
    {
        return $this->hasOne('App\Test');
    }

}

?>