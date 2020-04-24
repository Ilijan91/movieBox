@extends('layouts.app')

@section('content')
    <div class="container">
        <livewire:search>
        <div class="popular-movies">
            <h2>Popular Movies</h2>
            <div class="row">
               @foreach ($popularMovies as $movie)
                <div class="col-4">
                    <a href="{{ route('movies.show', $movie->id) }}">
                        <img src="{{'https://image.tmdb.org/t/p/w200/'. $movie->poster}}" alt="poster">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a>
                        <div>
                            <span class="ml-1">{{ $movie->rating }}</span>
                            <span class="mx-2">|</span>
                            <span>{{\Carbon\Carbon::parse($movie->release_date)->format('d M, Y')  }}</span>
                        </div>
                        <div>
                            @foreach (explode(',',$movie->genre_id) as $genre )
                                @foreach ($genres as $g)
                                    @if($g->id== $genre)
                                        {{$g->name}}|
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
               @endforeach
            </div>
        </div> <!-- end popular-movies -->
    </div>
@endsection