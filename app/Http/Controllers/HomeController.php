<?php

namespace App\Http\Controllers;

use App\Services\GenreService;
use App\Services\MovieService;


class HomeController extends Controller
{
    protected $movieService;
    protected $genreService;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MovieService $movieService, GenreService $genreService){
        $this->middleware('auth', ['except' => ['index', 'showMovie','showTopRatedMovies','showUpcomingMovies','showPopularMovies']]);
        $this->movieService = $movieService;
        $this->genreService = $genreService;
  
    }

    public function index()
    {
        $movies=$this->movieService->getNowPlayingMovies();       
        $moviesgenres=$this->movieService->getMoviesGenres($movies);
        
        if($movies->count() == 0 && empty($moviesgenres)){
            $this->movieService->saveMovies();
            $this->genreService->saveGenres();
            $movies=$this->movieService->getNowPlayingMovies();
            $moviesgenres=$this->movieService->getMoviesGenres($movies);
        }
        $popularMovie=$this->movieService->mostPopularMovie();
    
        if($popularMovie->count()!= 0){
            
            $videos=$this->movieService->findVideo($popularMovie[0]->id);
            $popularMovieGenres=$this->movieService->getMovieGenres($popularMovie[0]);
            
        }else{
            $popularMovie= null;
            $videos= null;
            $popularMovieGenres=null;
        }
        
        return view('home',compact('movies','moviesgenres','popularMovieGenres','popularMovie','videos'));
    }

   
    public function showMovie($id)
    {
        // Search first movie in database, if not found , search in TMDB API
        $movie=$this->movieService->getMovie($id);
        if($movie== null){
            $movie=$this->movieService->findMovie($id);
        }
        $moviesgenres=$this->movieService->getMovieGenres($movie);
        $videos=$this->movieService->findVideo($id);
        return view('details',compact('movie','moviesgenres','videos'));
    }

    public function showTopRatedMovies()
    {
        $movies=$this->movieService->getTopRatedMovies(); 
        $moviesgenres=$this->movieService->getMoviesGenres($movies);
        $popularMovie=$this->movieService->mostPopularMovie();
        if($popularMovie->count()!= 0){
            $videos=$this->movieService->findVideo($popularMovie[0]->id);
        }else{
            $popularMovie= null;
            $videos= null;
        }
        
        return view('home',compact('movies','moviesgenres','popularMovie','videos'));
    }

    public function showUpcomingMovies()
    {
        $movies=$this->movieService->getUpcomingMovies(); 
        $moviesgenres=$this->movieService->getMoviesGenres($movies);
        $popularMovie=$this->movieService->mostPopularMovie();
        if($popularMovie->count()!= 0){
            $videos=$this->movieService->findVideo($popularMovie[0]->id);
        }else{
            $popularMovie= null;
            $videos= null;
        }
        
        return view('home',compact('movies','moviesgenres','popularMovie','videos'));
    }
    public function showPopularMovies()
    {
        $movies=$this->movieService->getPopularMovies(); 
        $moviesgenres=$this->movieService->getMoviesGenres($movies);
        $popularMovie=$this->movieService->mostPopularMovie();
        if($popularMovie->count()!= 0){
            $videos=$this->movieService->findVideo($popularMovie[0]->id);
        }else{
            $popularMovie= null;
            $videos= null;
        }
        
        return view('home',compact('movies','moviesgenres','popularMovie','videos'));
    }
    
    

   
}
