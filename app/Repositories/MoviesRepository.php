<?php

namespace App\Repositories;

use App\Movie;
use App\MovieGenre;

// use Illuminate\Database\Eloquent\Model;
use App\Repositories\MoviesRepositoryInterface;


class MoviesRepository implements MoviesRepositoryInterface
{
    // protected $movie;
    
    
    // public function __construct(Model $movie)
    // {
    //     $this->movie = $movie;
    // }
    
    public function getMovies(){
        return Movie::select()->get();
    }
     
    public function getGenres(){
        return MovieGenre::select()->get();
    }

    public function findMovie($id){
        return Movie::find($id);
    }

    public function save($movies ,$genres){

        foreach($movies as $movie){
            Movie::create([
                'title'=> $movie['title'],
                'poster'=> $movie['poster_path'],
                'rating'=> $movie['vote_average'],
                'overview'=> $movie['overview'],
                'release_date'=> $movie['release_date'],
                'genre_id'=> implode(',',$movie['genre_ids']),
            ]);
        } 
       
        foreach($genres as $genre){
            MovieGenre::create([
                'id'=>$genre['id'],
                'name'=>$genre['name'],
            ]);
        } 
    }

    

   


    


    

      
    

        

}
