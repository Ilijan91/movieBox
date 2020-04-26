<?php

namespace App\Repositories;

use App\Series;
use App\SeriesGenre;
use Illuminate\Support\Facades\Http;
use App\Repositories\MoviesTvRepositoryInterface;


class TvRepository implements MoviesTvRepositoryInterface
{
    public function getGeneralResults(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];
    }

    public function getGenresResults(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];
    }

    public function save(){

        $tvs=$this->getGeneralResults();
        
        foreach($tvs as $tv){
             Series::create([
                'title'=> $tv['original_name'],
                'poster'=> $tv['poster_path'],
                'rating'=> $tv['vote_average'],
                'overview'=> $tv['overview'],
                'release_date'=> $tv['first_air_date'],
                'genre_id'=> implode(',',$tv['genre_ids']),
            ]);
        } 
        $genres=$this->getGenresResults();
        foreach($genres as $genre){
            SeriesGenre::create([
                'id'=>$genre['id'],
                'name'=>$genre['name'],
            ]);
        } 
    }

    public function getGeneral(){
        return Series::select()->get();
    }

    
    public function getGenres(){
        return SeriesGenre::select()->get();
    }

    public function findById($id){
        return Series::find($id);
    }

    


    

      
    

        

}
