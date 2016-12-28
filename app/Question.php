<?php

namespace App;

use Eloquent;

class Question extends Eloquent {

    protected $table = 'questions';
    public $incrementing = false;

    public function revision()
    {
        return $this->hasOne('App\Revision');
    }

    public function question_type()
    {
        return $this->hasOne('App\Question_Type');
    }
}

?>