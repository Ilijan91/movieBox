<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function movies()
    {
        return $this->hasMany('App\Movie');
    }
   
}
