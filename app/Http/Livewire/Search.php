<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Search extends Component
{

    public $search = "";

    public function render()
    {
        $searchResult=[];
        if(strlen($this->search) >= 2){
            $searchResult=Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='. $this->search)
            ->json()['results'];
        }
        
        //dump($searchResult);
       
        return view('livewire.search', [
            'searchResult'=> collect($searchResult)->take(5)
        ]);
    }
}
