<?php

namespace App\Services;

use stdClass;
use Illuminate\Support\Facades\Http;
use App\Repositories\MoviesRepositoryInterface;


class MovieService
{
    protected $moviesRepository;
    protected $watchlistService;
    protected $genreService;

    public function __construct(MoviesRepositoryInterface $moviesRepository,WatchlistService $watchlistService,GenreService $genreService){
        $this->moviesRepository = $moviesRepository;
        $this->watchlistService = $watchlistService;
        $this->genreService= $genreService;
    }
    // Method to get popular movies from database
    public function getPopularMovies(){
        return $this->moviesRepository->getPopular();
    }
    // Method to get top rated movies from database
    public function getTopRatedMovies(){
        return $this->moviesRepository->getTopRated();
    }
    // Method to get now playing movies from database
    public function getNowPlayingMovies(){
        return $this->moviesRepository->getNowPlaying();
    }
    // Method to get upcoming movies from database
    public function getUpcomingMovies(){
        return $this->moviesRepository->getUpcoming();
    }
    // Method to get movie by id from api
    public function findMovie($id){
        $movie=$this->fatchMovieById($id);
        $object = new stdClass();
            foreach ($movie as $key => $value)
            {
                $object->$key = $value;
            }
        return $object;
    }
    // Method to get movie trailer by id from api
    public function findVideo($id){
        return $this->fatchMovieVideo($id);
    }
    // Method to get movie by id from database
    public function getMovie($id){
        return $this->moviesRepository->find($id);
    }
    // Method to store movies from API to database
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
    // Method to get most popular movie from all wathclists created by users
    public function mostPopularMovie(){
        $movie_id=$this->watchlistService->getPopularMovie();
        return $this->moviesRepository->find($movie_id);
    }
    //Method to get genres for movies 
    public function getMoviesGenres($movies){
        $genres=collect($this->genreService->getGenres())->mapWithKeys(function ($genre){
            return [$genre['id']=> $genre['name']];
        });
        $genreArray=[];
        foreach($movies as $movie){
            $zanrovi=null;
            foreach(explode(',',$movie->genre_id) as $genre){
                $zanrovi .= $genres->get($genre).",";
                $genreArray[$movie->id]=explode(',',$zanrovi);
            }
            $removed = array_pop($genreArray[$movie->id]);
        }
        return $genreArray;
    }
    // Method to get movie genres if we search movie from database
    public function getMovieGenres($movie){
        $genres=collect($this->genreService->getGenres())->mapWithKeys(function ($genre){
            return [$genre['id']=> $genre['name']];
        });
        $genreArray=[];
        $zanrovi=null;
        foreach(explode(',',$movie->genre_id) as $genre){
            $zanrovi .= $genres->get($genre).",";
            $genreArray[$movie->id]=explode(',',$zanrovi);
        }
        $removed = array_pop($genreArray[$movie->id]);
        return $genreArray;
    }
    // Method to get movie genres if we search movie from api
    public function findMovieGenres($movie){
        $genres=collect($this->genreService->getGenres())->mapWithKeys(function ($genre){
            return [$genre['id']=> $genre['name']];
        });
        $genreArray=[];
        $zanrovi=null;
        foreach($movie->genres as $genre){
            $zanrovi .= $genres->get($genre['id']).",";
            $genreArray[$movie->id]=explode(',',$zanrovi);
        }
        $removed = array_pop($genreArray[$movie->id]);
        return $genreArray;
    }

    //Private Method to get top rated movies from API
    private function fatchTopRatedMovies(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/top_rated')
            ->json()['results'];
    }
    //Private Method to get popular movies from API
    private function fatchPopularMovies(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];
    }
    //Private Method to get upcoming movies from API
    private function fatchUpcomingMovies(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/upcoming')
            ->json()['results'];
    }
    //Private Method to get now playing movies from API
    private function fatchNowPlayingMovies(){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];
    }
    //Private Method to get movie by id from API
    private function fatchMovieById($id){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/'. $id)
            ->json();
    }
    //Private Method to get movie video from API
    private function fatchMovieVideo($id){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '/videos')
            ->json()['results'];
    }

   







}
