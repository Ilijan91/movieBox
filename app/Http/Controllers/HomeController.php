<?php

namespace App\Http\Controllers;

use App\Services\MovieService;

class HomeController extends Controller
{
    protected $movieService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MovieService $movieService){
        $this->movieService = $movieService;
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies=$this->movieService->getPopularMovies();
        $moviesgenres= $this->movieService->getMovieGenres();
       
        if(empty($movies->first()) && empty($moviesgenres->first())){
            $this->movieService->saveMovies();

            $movies=$this->movieService->getPopularMovies();
            $moviesgenres= $this->movieService->getMovieGenres();
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
        $genres=$this->movieService->getMovieGenres();

        return view('details',compact('movie','genres'));
    }
}
