<?php

namespace App\Repositories;

use App\MovieGenre;


class GenreRepository implements GenreRepositoryInterface
{

    public function save($genres){
        foreach($genres as $genre){
            MovieGenre::create([
                'id'=>$genre['id'],
                'name'=>$genre['name'],
            ]);
        }
    }


    public function all(){
        return MovieGenre::all();
    }
}