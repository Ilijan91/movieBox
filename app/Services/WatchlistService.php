<?php

namespace App\Services;

use App\Repositories\WatchlistRepositoryInterface;

class WatchlistService
{
    protected $watchlistRepository;

    public function __construct(WatchlistRepositoryInterface $watchlistRepository)
    {
        $this->watchlistRepository = $watchlistRepository;
    }

    public function get($user_id){
        return $this->watchlistRepository->getAll($user_id);
    }

    public function saveMovie($id){
        return $this->watchlistRepository->save($id);
    }
    public function deleteMovie($movieId){
        return $this->watchlistRepository->delete($movieId);
    }
    public function getPopularMovie(){
        return $this->watchlistRepository->popularMovie();
    }
    
}