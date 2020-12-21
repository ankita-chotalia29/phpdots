<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Level extends Authenticatable
{
    use Notifiable;

    protected $table = 'levels';
    
    protected $fillable = [
        'class_id','level'
    ];

    public function levels() {
        return $this->hasMany('App\ClassList','id');
    }

}
