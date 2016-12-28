<?php

namespace App;

use Eloquent;

class Question_Type extends Eloquent {

    protected $table = 'question_types';
    public $incrementing = false;

    public function question()
    {
        return $this->hasOne('App\Question');
    }
}

?>