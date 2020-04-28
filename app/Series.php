<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $guarded=[];


    public function watchlist()
    {
        return $this->belongsTo('App\Watchlist');
    }

    public function seriesgenres()
    {
        return $this->belongsToMany('App\SeriesGenre');
    }
}
