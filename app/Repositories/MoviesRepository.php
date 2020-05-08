<?php

namespace App\Repositories;

use App\Movie;

use App\Repositories\MoviesRepositoryInterface;


class MoviesRepository implements MoviesRepositoryInterface
{
    //Method to search for movies based on selected options with pagination
    public function filterMovies(){
        $movies = Movie::select();
        if(request()->has('rating')){
            $movies= $movies->where('rating','LIKE','%'.request('rating').'%')
                            ->orderBy('rating','asc');
        }
        if(request()->has('release_date')){
            $movies= $movies->where('release_date','LIKE','%'.request('release_date').'%')
                            ->orderBy('release_date','asc');          
        }
                
        if(request()->has('genre')){
            $movies= $movies->where('genre_id','LIKE','%'.request('genre').'%')
                            ->orderBy('genre_id','asc');
        }
                
        return $movies->paginate(8)->appends([
                'rating'=>request('rating'),
                'release_date'=>request('release_date'),
                'genre'=>request('genre'),
        ]);
        
    }
    // Get all movies from database with pagination
    public function getAllMovies(){
        return Movie::paginate(8);
    }
    // Get all popular movies from database
    public function getPopular(){
        return Movie::select()->where('flag','LIKE','%is_popular%');
    }
    // Get all popular movies from database
    public function getTopRated(){
        return Movie::select()->where('flag','LIKE','%is_top_rated%');
    }
    // Get all popular movies from database
    public function getNowPlaying(){
        return Movie::select()->where('flag','LIKE','%is_now_playing%');
    }
    // Get all popular movies from database
    public function getUpcoming(){
        return Movie::select()->where('flag','LIKE','%is_upcoming%');
    }
    // Get all popular movies from database    
    public function find($id){
        return Movie::find($id);
    }
    //Save movies to database incomming from api with passed flag if it is popular,top rated, upcoming, now playing
    public function save($movies, $flag){
        foreach($movies as $movie){
            //First search if movies allready exist in database and if exist then update only column flag so we know is that movie is popular, now playing or top rated, else save
            $moviesTitle= Movie::select()->where('title',$movie['title'])->get();
            if($moviesTitle->count() != 0){ 
                $flagArray= [$flag,$moviesTitle[0]->flag];
                Movie::where('title', $movie['title'])->update(array('flag' => implode(',',$flagArray)));
            }else{
                Movie::create([
                    'id'=>$movie['id'],
                    'title'=> $movie['title'],
                    'poster_path'=> $movie['poster_path'],
                    'rating'=> $movie['vote_average'],
                    'overview'=> $movie['overview'],
                    'release_date'=> $movie['release_date'],
                    'genre_id'=> implode(',',$movie['genre_ids']),
                    'flag'=>$flag,
                ]);
            }
        }     
    }
    
    
   

     

            

    

      
    

        

}
