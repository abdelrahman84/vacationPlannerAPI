<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    

    public function manager()
    {
        return $this->belongsTo('App\Manager');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
