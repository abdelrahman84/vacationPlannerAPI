<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
   

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
