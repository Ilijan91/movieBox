<?php

namespace App\Repositories;

use App\Movie;
use App\MovieGenre;
use Illuminate\Support\Facades\Http;
use App\Repositories\MoviesTvRepositoryInterface;


class MoviesRepository implements MoviesTvRepositoryInterface
{
    public function getGeneralResults(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];
    }

    public function getGenresResults(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];
    }

    public function save(){

        $movies=$this->getGeneralResults();
      
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
        $genres=$this->getGenresResults();
        foreach($genres as $genre){
            MovieGenre::create([
                'id'=>$genre['id'],
                'name'=>$genre['name'],
            ]);
        } 
    }

    public function getGeneral(){
        return Movie::select()->get();
    }

    
    public function getGenres(){
        return MovieGenre::select()->get();
    }

    public function findById($id){
        return Movie::find($id);
    }

    


    

      
    

        

}
