<?php

namespace App\Http\Controllers;


use App\Repositories\TvRepository;
use Illuminate\Support\Facades\Route;
use App\Repositories\MoviesRepository;


class HomeController extends Controller
{

    private $moviesRepository;
    private $tvRepository;
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MoviesRepository $moviesRepository,TvRepository $tvRepository){
        
        $this->moviesRepository=$moviesRepository;
        $this->tvRepository=$tvRepository;
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies= $this->moviesRepository->getGeneral();
        $tvshows= $this->tvRepository->getGeneral();
       
        if(empty($movies[0]) && empty($tvshows[0])){
            $movies= $this->moviesRepository->save();
            $tvshows= $this->tvRepository->save();
            $movies= $this->moviesRepository->getGeneral();
            $tvshows= $this->tvRepository->getGeneral();
        }

        $tvgenres=$this->tvRepository->getGenres();
        $moviesgenres=$this->moviesRepository->getGenres();
      
        return view('home',compact('movies','tvshows','tvgenres','moviesgenres'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Route::current()->getName()== "series.show"){
            $program = $this->tvRepository->findById($id);
            $genres=$this->tvRepository->getGenres();
        }else{
            $program = $this->moviesRepository->findById($id);
            $genres=$this->moviesRepository->getGenres();
        }
        return view('details',compact('program','genres'));
    }
}
