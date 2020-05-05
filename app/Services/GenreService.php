<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Repositories\GenreRepositoryInterface;

class GenreService {

    protected $genreRepository;

    public function __construct(GenreRepositoryInterface $genreRepository){
        $this->genreRepository = $genreRepository;
    }
    //Method to save movies genres to database
    public function saveGenres(){ 
        $genres =  $this->fatchMovieGenres();
        $this->genreRepository->save($genres);
    }
    //Method to get movies genres from database
    public function getGenres(){
        return $this->genreRepository->all();
    }
    //Private method to get movies genres from api
    private function fatchMovieGenres(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];
    }












    
}