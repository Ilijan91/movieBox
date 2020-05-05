<?php

namespace App\Services;

use stdClass;
use Illuminate\Support\Facades\Http;
use App\Repositories\MoviesRepositoryInterface;
use Illuminate\Support\Arr;

class MovieService
{
    protected $moviesRepository;
    protected $watchlistService;
    protected $genreService;

    public function __construct(MoviesRepositoryInterface $moviesRepository,WatchlistService $watchlistService,GenreService $genreService)
    {
        $this->moviesRepository = $moviesRepository;
        $this->watchlistService = $watchlistService;
        $this->genreService= $genreService;
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

    public function findMovie($id){
        $movie=$this->fatchMovieById($id);
        
        $object = new stdClass();
            foreach ($movie as $key => $value)
            {
                $object->$key = $value;
            }
        return $object;
    }
    public function findVideo($id){
        return $this->fatchMovieVideo($id);
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

    public function mostPopularMovie(){
        $movie_id=$this->watchlistService->getPopularMovie();
        return $this->moviesRepository->find($movie_id);
    }

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

    private function fatchMovieById($id){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/'. $id)
            ->json();
    }
    
    private function fatchMovieVideo($id){
        return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '/videos')
            ->json()['results'];
    }

   







}
