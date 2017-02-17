<?php

namespace App;

use Eloquent;

class Test extends Eloquent {

    protected $table = 'tests';
    public $incrementing = false;
    
    
    public function revisions()
    {
        return $this->hasMany('App\Revision');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }

}

?>