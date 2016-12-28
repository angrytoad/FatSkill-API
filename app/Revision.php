<?php

namespace App;

use Eloquent;

class Revision extends Eloquent {

    protected $table = 'revisions';
    public $incrementing = false;

    public function test()
    {
        return $this->hasOne('App\Revision');
    }

}

?>