<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ClassList extends Authenticatable
{
    use Notifiable;

    protected $table = 'class';
    
    protected $fillable = [
        'college_id','title','contact_no','email','price','description','syllabus'
    ];

    public function levels() {
        return $this->hasMany('App\Level','class_id');
    }

}
