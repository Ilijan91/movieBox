<?php

namespace App\Http\Controllers;


use App\User;

use App\Services\GenreService;
use App\Services\WatchlistService;

class WatchlistsController extends Controller
{
    protected $watchlistService;
    protected $genreService;

    public function __construct(WatchlistService $watchlistService,GenreService $genreService){
        $this->middleware('auth');
        $this->watchlistService = $watchlistService;
        $this->genreService = $genreService;
    }
   
    public function index($user_id)
    {
        // User can see wathclist only if he is authorized
        $user=User::findOrFail($user_id);
        if($user->watchlist != null){
            $this->authorize('view',$user->watchlist);
        }
        $movies=$this->watchlistService->get($user_id); 
        $moviesgenres=$this->genreService->getGenres();
        
        return view('watchlist',compact('movies','moviesgenres'));
    }

    
    public function store($movieId)
    {
        $this->watchlistService->saveMovie($movieId); 
        return redirect()->back();
    }

   
    public function destroy($movieId)
    {
        $this->watchlistService->deleteMovie($movieId); 
        return redirect()->back();

    }


    
}
