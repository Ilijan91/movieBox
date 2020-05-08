<?php

namespace App\Repositories;


interface MoviesRepositoryInterface
{
   public function getAllMovies();

    public function getPopular();

    public function getTopRated();

    public function getNowPlaying();

    public function getUpcoming();
     
    public function find($id);

    public function save($movies, $flag);
    

















}