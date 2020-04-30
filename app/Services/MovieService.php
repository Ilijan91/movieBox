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
        return $this->moviesRepository->getPopular();
    }
    public function getTopRatedMovies(){
        return $this->moviesRepository->getTopRated();
    }
    public function getNowPlayingMovies(){
        return $this->moviesRepository->getNowPlaying();
    }
    public function getUpcomingMovies(){
        return $this->moviesRepository->getUpcoming();
    }
    

    public function getMovie($id){
        return $this->moviesRepository->find($id);
    }

    public function saveMovies(){ 

        $popular =  $this->fatchPopularMovies();
        $popularFlag= 'is_popular';
        $topRated =  $this->fatchTopRatedMovies();
        $topRatedFlag= 'is_top_rated';
        $nowPlaying =  $this->fatchNowPlayingMovies();
        $nowPlayingFlag= 'is_now_playing';
        $upcoming =  $this->fatchUpcomingMovies();
        $upcomingFlag= 'is_upcoming';
        
        $this->moviesRepository->save($popular ,$popularFlag);
        $this->moviesRepository->save($topRated ,$topRatedFlag);
        $this->moviesRepository->save($nowPlaying ,$nowPlayingFlag);
        $this->moviesRepository->save($upcoming ,$upcomingFlag);
    }

    private function fatchTopRatedMovies(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/top_rated')
            ->json()['results'];
    }

    private function fatchPopularMovies(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];
    }

    private function fatchUpcomingMovies(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/upcoming')
            ->json()['results'];
    }

    private function fatchNowPlayingMovies(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];
    }
    
    

   







}
