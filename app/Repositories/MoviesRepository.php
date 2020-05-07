<?php

namespace App\Repositories;

use App\Movie;

use App\Repositories\MoviesRepositoryInterface;


class MoviesRepository implements MoviesRepositoryInterface
{
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

    public function getAllMovies(){
        return Movie::paginate(8);
    }
    public function getPopular(){
        return Movie::select()->where('flag','LIKE','%is_popular%');
    }

    public function getTopRated(){
        return Movie::select()->where('flag','LIKE','%is_top_rated%');
    }

    public function getNowPlaying(){
        return Movie::select()->where('flag','LIKE','%is_now_playing%');
    }

    public function getUpcoming(){
        return Movie::select()->where('flag','LIKE','%is_upcoming%');
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
