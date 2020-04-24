<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MoviesRepositoryInterface;

class MoviesController extends Controller
{
    private $moviesRepository;

    public function __construct(MoviesRepositoryInterface $moviesRepository){
        $this->moviesRepository=$moviesRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies= $this->moviesRepository->getMovies();
      
        if(empty($popularMovies[0])){
            $popularMovies= $this->moviesRepository->saveMoviesAndGenres();
            $popularMovies= $this->moviesRepository->getMovies();
        }
        $genres=$this->moviesRepository->getGenres();
       
        return view('index',compact('popularMovies','genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($movieId)
    {
        $movie = $this->moviesRepository->findMovieById($movieId);
        $genres=$this->moviesRepository->getGenres();
        return view('show',compact('movie','genres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
