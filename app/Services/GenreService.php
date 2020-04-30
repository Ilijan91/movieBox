<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Repositories\GenreRepositoryInterface;

class GenreService {

    protected $genreRepository;

    public function __construct(GenreRepositoryInterface $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function saveGenres(){ 
        $genres =  $this->fatchMovieGenres();
        $this->genreRepository->save($genres);
    }

    public function getGenres(){
        return $this->genreRepository->all();
    }

    private function fatchMovieGenres(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];
    }












    
}