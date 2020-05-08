<?php

namespace App\Repositories;

use App\MovieGenre;


class GenreRepository implements GenreRepositoryInterface
{
    //Save genres of movies
    public function save($genres){
        foreach($genres as $genre){
            MovieGenre::create([
                'id'=>$genre['id'],
                'name'=>$genre['name'],
            ]);
        }
    }

    //Get all genre
    public function all(){
        return MovieGenre::all();
    }
    
}