<?php

namespace App\Repositories;


interface MoviesTvRepositoryInterface
{
    public function getGeneralResults();

    public function getGenresResults();

    public function save();

    public function getGeneral();
    
    public function getGenres();
    
    public function findById($id);
   
}