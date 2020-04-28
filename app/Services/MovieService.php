<?php

namespace App\Services;

use App\Repositories\MoviesRepositoryInterface;
use Illuminate\Support\Facades\Http;

class MovieService
{
    protected $moviesRepository;


    public function __construct(MoviesRepositoryInterface $moviesRepository)
    {
        $this->moviesRepository = $moviesRepository;
    
    }

    public function getPopularMovies(){
        return $this->moviesRepository->getMovies();
    }

    public function getMovieGenres(){
        return $this->moviesRepository->getGenres();
    }
    public function getMovie($id){
        return $this->moviesRepository->findMovie($id);
    }

    public function saveMovies(){
        $movies =  $this->fatchPopularMovies();
        $genres =$this->fatchMovieGenres();
        
        return $this->moviesRepository->save($movies, $genres);
    }


    private function fatchPopularMovies(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];
    }

    private function fatchMovieGenres(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];
    }









}
