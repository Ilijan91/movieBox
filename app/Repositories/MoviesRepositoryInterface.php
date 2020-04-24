<?php

namespace App\Repositories;


interface MoviesRepositoryInterface
{
    public function getMoviesResults();

    public function getGenresResults();

    public function saveMoviesAndGenres();

    public function getMovies();
    
    public function getGenres();
    
    public function findMovieById($movieId);
   
}