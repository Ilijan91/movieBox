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
    //Method to get watchlist from database
    public function get($user_id){
        return $this->watchlistRepository->getAll($user_id);
    }
    // Method to store movie id and user id in watchlist
    public function saveMovie($id){
        return $this->watchlistRepository->save($id);
    }
    // Method to remove movie id from watchlist
    public function deleteMovie($movieId){
        return $this->watchlistRepository->delete($movieId);
    }
    // Method to return movie that is in most wathclists
    public function getPopularMovie(){
        return $this->watchlistRepository->popularMovie();
    }
    
}