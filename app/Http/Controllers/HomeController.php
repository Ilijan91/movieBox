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
        $moviesgenres=$this->genreService->getGenres();
        if($movies->count() == 0 && $moviesgenres->count() == 0){
            $this->movieService->saveMovies();
            $this->genreService->saveGenres();
            $movies=$this->movieService->getNowPlayingMovies();
            $moviesgenres=$this->genreService->getGenres(); 
        }
        $popularMovie=$this->movieService->mostPopularMovie();
        $videos=$this->movieService->findVideo($popularMovie[0]->id);
        return view('home',compact('movies','moviesgenres','popularMovie','videos'));
    }

   
    public function showMovie($id)
    {
        // Search first movie in database, if not found , search in TMDB API
        $movie=$this->movieService->getMovie($id);
        if($movie== null){
            $movie=$this->movieService->findMovie($id);
        }
        $moviesgenres=$this->genreService->getGenres();
        $videos=$this->movieService->findVideo($id);
        return view('details',compact('movie','moviesgenres','videos'));
    }

    public function showTopRatedMovies()
    {
        $movies=$this->movieService->getTopRatedMovies(); 
        $moviesgenres=$this->genreService->getGenres();
        $popularMovie=$this->movieService->mostPopularMovie();
        $videos=$this->movieService->findVideo($popularMovie[0]->id);
        return view('home',compact('movies','moviesgenres','popularMovie','videos'));
    }

    public function showUpcomingMovies()
    {
        $movies=$this->movieService->getUpcomingMovies(); 
        $moviesgenres=$this->genreService->getGenres();
        $popularMovie=$this->movieService->mostPopularMovie();
        $videos=$this->movieService->findVideo($popularMovie[0]->id);
        return view('home',compact('movies','moviesgenres','popularMovie','videos'));
    }
    public function showPopularMovies()
    {
        $movies=$this->movieService->getPopularMovies(); 
        $moviesgenres=$this->genreService->getGenres();
        $popularMovie=$this->movieService->mostPopularMovie();
        $videos=$this->movieService->findVideo($popularMovie[0]->id);
        return view('home',compact('movies','moviesgenres','popularMovie','videos'));
    }
    
    

   
}
