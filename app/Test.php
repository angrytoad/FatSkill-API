<?php

namespace App;

use Eloquent;

class Test extends Eloquent {

    protected $table = 'tests';
    public $incrementing = false;
    
    
    public function revisions()
    {
        return $this->belongsToMany('App\Revision');
    }

}

?>