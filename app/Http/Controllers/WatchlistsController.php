<?php

namespace App\Http\Controllers;


use App\User;

use App\Services\GenreService;
use App\Services\MovieService;
use App\Services\WatchlistService;

class WatchlistsController extends Controller
{
    protected $watchlistService;
    protected $genreService;
    protected $movieService;

    public function __construct(WatchlistService $watchlistService,GenreService $genreService,MovieService $movieService){
        $this->middleware('auth');
        $this->watchlistService = $watchlistService;
        $this->genreService = $genreService;
        $this->movieService = $movieService;
    }
   
    public function index($user_id)
    {
        // User can see wathclist only if he is authorized
        $user=User::findOrFail($user_id);
        

        if($user->watchlist != null || $user->id != auth()->user()->id){
            $this->authorize('view',$user->watchlist);
        }
        $movies=$this->watchlistService->get($user_id); 
        $moviesgenres=$this->genreService->getGenres();
        $popularMovie=$this->movieService->mostPopularMovie();
    
        if($popularMovie->count()!= 0){
            
            $videos=$this->movieService->findVideo($popularMovie[0]->id);
            $popularMovieGenres=$this->movieService->getMovieGenres($popularMovie[0]);
            
        }else{
            $popularMovie= null;
            $videos= null;
            $popularMovieGenres=null;
        }
        return view('watchlist',compact('movies','moviesgenres','popularMovie','popularMovieGenres','videos'));
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
