<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class College extends Authenticatable
{
    use Notifiable;

    protected $table = 'colleges';
   

}
