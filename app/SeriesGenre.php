<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeriesGenre extends Model
{
    protected $guarded=[];

    public function series()
    {
        return $this->belongsToMany('App\Series');
    }
}
