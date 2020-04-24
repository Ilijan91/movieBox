<?php

namespace App\Repositories;

use App\Genre;
use App\Movie;
use Illuminate\Support\Facades\Http;


class MoviesRepository implements MoviesRepositoryInterface
{
    public function getMoviesResults(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];
    }

    public function getGenresResults(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];
    }

    public function saveMoviesAndGenres(){

        $movies=$this->getMoviesResults();
      
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
            Genre::create([
                'id'=>$genre['id'],
                'name'=>$genre['name'],
            ]);
        } 
    }

    public function getMovies(){
        return Movie::select()->get();
    }

    
    public function getGenres(){
        return Genre::select()->get();
    }

    public function findMovieById($movieId){
        return Movie::find($movieId);
    }

    


    

      
    

        

}
