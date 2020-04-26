<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded=[];


    public function watchlist()
    {
        return $this->belongsTo('App\Watchlist');
    }

    public function moviegenres()
    {
        return $this->belongsToMany('App\MovieGenre');
    }


}
