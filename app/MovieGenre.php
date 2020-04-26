<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieGenre extends Model
{
    protected $guarded=[];

    public function movies()
    {
        return $this->belongsToMany('App\Movie');
    }
}
