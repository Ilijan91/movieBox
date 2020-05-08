<?php

namespace App\Repositories;

use stdClass;
use App\Movie;
use App\Watchlist;
use App\Repositories\WatchlistRepositoryInterface;

class WatchlistRepository implements WatchlistRepositoryInterface
{
    public function getAll($id){
        $movieIds=Watchlist::where('user_id',$id)->get();
        if($movieIds->count() !=0){
            foreach($movieIds as $movieId){
                $movies[]= Movie::where('id',$movieId->movie_id)->get();
                $moviesObj=new stdClass();
                foreach ($movies as $key => $value){
                    $moviesObj->$key = $value;
                }
            }
            return $moviesObj;
        }else{
            return $moviesObj= null;
        }
        
    }
   // Save movie to the watchlist of authorized user
    public function save($id)
    {
        $user_id= auth()->user()->id;
        $movieIds=Watchlist::where('user_id',$user_id)
                    ->where('movie_id',$id)
                    ->get();
       
        if($movieIds->count() == 0){
            
            $watchlist= new Watchlist();
            $watchlist->user_id= $user_id;
            $watchlist->movie_id= $id;
            $watchlist->save();
        }
    }
    // Remove movie from watchlist of authorized user
    public function delete($id){

        $user_id= auth()->user()->id;
        Watchlist::where('movie_id',$id)
                    ->where('user_id',$user_id)
                    ->delete();
    }
    // Get id of movie that is in the most watchlist of all users
    public function popularMovie(){
        return Watchlist::select('movie_id')
                    ->groupBy('movie_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->limit(1)
                    ->get();
    
    }

    
}


