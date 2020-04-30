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
        $this->movieService = $movieService;
        $this->genreService = $genreService;
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        
        return view('home',compact('movies','moviesgenres'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMovie($id)
    {

        $movie=$this->movieService->getMovie($id);
        $moviesgenres=$this->genreService->getGenres(); 
        return view('details',compact('movie','moviesgenres'));
    }

    public function showTopRatedMovies()
    {
        $movies=$this->movieService->getTopRatedMovies(); 
        $moviesgenres=$this->genreService->getGenres();
        return view('home',compact('movies','moviesgenres'));
    }

    public function showUpcomingMovies()
    {
        $movies=$this->movieService->getUpcomingMovies(); 
        $moviesgenres=$this->genreService->getGenres();
        return view('home',compact('movies','moviesgenres'));
    }
    public function showPopularMovies()
    {
        $movies=$this->movieService->getPopularMovies(); 
        $moviesgenres=$this->genreService->getGenres();
        return view('home',compact('movies','moviesgenres'));
    }
}
