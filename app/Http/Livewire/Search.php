<?php

namespace App\Http\Livewire;

use App\Movie;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Search extends Component
{

    public $search = "";
    public $movies;

    public function render()
    {
        $searchResult=[];
        $search='%' . $this->search . '%';
        $searchResult=$this->movies= Movie::select()->where('title', 'LIKE' , $search)->get();
        if($searchResult->count()==0){
            if(strlen($this->search) >= 2){
                $searchResult=Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/movie?query='. $this->search)
                ->json()['results'];
            }
        }
      
        return view('livewire.search', [
            'searchResult'=> collect($searchResult)->take(5)
        ]);
    }




}
