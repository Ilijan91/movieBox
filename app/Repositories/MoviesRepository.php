<?php

namespace App\Repositories;

use App\Movie;


// use Illuminate\Database\Eloquent\Model;
use App\Repositories\MoviesRepositoryInterface;


class MoviesRepository implements MoviesRepositoryInterface
{
    // protected $movie;
    
    
    // public function __construct(Model $movie)
    // {
    //     $this->movie = $movie;
    // }
    
    public function getPopular(){
        return Movie::select()->where('flag','LIKE','%is_popular%')->get();
    }

    public function getTopRated(){
        return Movie::select()->where('flag','LIKE','%is_top_rated%')->get();
    }

    public function getNowPlaying(){
        return Movie::select()->where('flag','LIKE','%is_now_playing%')->get();
    }

    public function getUpcoming(){
        return Movie::select()->where('flag','LIKE','%is_upcoming%')->get();
    }

    public function find($id){
        return Movie::find($id);
    }

    public function save($movies, $flag){
        foreach($movies as $movie){
            $moviesTitle= Movie::select()->where('title',$movie['title'])->get();
            if($moviesTitle->count() != 0){ 
                $flagArray= [$flag,$moviesTitle[0]->flag];
                Movie::where('title', $movie['title'])->update(array('flag' => implode(',',$flagArray)));
            }else{
                Movie::create([
                    'id'=>$movie['id'],
                    'title'=> $movie['title'],
                    'poster'=> $movie['poster_path'],
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
