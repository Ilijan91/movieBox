<?php

namespace App\Repositories;


interface WatchlistRepositoryInterface
{

    public function getAll($id);

    public function save($id);

    public function delete($id);

    public function popularMovie();

}