<?php

namespace App\Repositories;


interface MoviesRepositoryInterface
{
    public function getMovies();

    public function getGenres();

    public function findMovie($id);

    public function save($movies ,$genres);
    

















}