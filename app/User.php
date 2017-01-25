<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function jobs()
    {
        return $this->belongsToMany('App\Job')->withTimestamps();
    }

    public function tests()
    {
        return $this->hasMany('App\Test');
    }
    
    public function candidates()
    {
        return $this->hasMany('App\Candidate');
    }

    public function hasCandidate($candidate_email)
    {
        return ($this->candidates()->where('id',$candidate_email)->first() !== null ? true : false);
    }
}
