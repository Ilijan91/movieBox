@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="popular-movies">
            <h2>Popular Movies</h2>
            <div class="row">
               @foreach ($popularMovies as $movie)
                <div class="col-4">
                    <a href="{{ route('movies.show', $movie['id']) }}">
                        <img src="{{'https://image.tmdb.org/t/p/w200/'. $movie['poster_path']}}" alt="poster">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('movies.show', $movie['id']) }}">{{ $movie['title'] }}</a>
                        <div>
                            <span class="ml-1">{{ $movie['vote_average'] }}</span>
                            <span class="mx-2">|</span>
                            <span>{{\Carbon\Carbon::parse($movie['release_date'])->format('d M, Y')  }}</span>
                        </div>
                        <div>
                            @foreach ($movie['genre_ids'] as $genre)
                                {{$genres->get($genre)}} |
                            @endforeach
                        </div>
                    </div>
                </div>
               @endforeach
            </div>
        </div> <!-- end popular-movies -->

        <div>
            <h2>Now Playing</h2>
            <div class="row">
                @foreach ($nowPlayingMovies as $nowPlay)
                <div class="col-4">
                    <a href="{{ route('movies.show', $nowPlay['id']) }}">
                        <img src="{{'https://image.tmdb.org/t/p/w200/'. $nowPlay['poster_path']}}" alt="poster">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('movies.show', $nowPlay['id']) }}">{{ $nowPlay['title'] }}</a>
                        <div>
                            <span class="ml-1">{{ $nowPlay['vote_average'] }}</span>
                            <span class="mx-2">|</span>
                            <span>{{\Carbon\Carbon::parse($nowPlay['release_date'])->format('d M, Y')  }}</span>
                        </div>
                        <div>
                            @foreach ($nowPlay['genre_ids'] as $genre)
                                {{$genres->get($genre)}}|
                            @endforeach
                        </div>
                    </div>
                </div>
               @endforeach
            </div>
        </div> <!-- end now-playing-movies -->
    </div>
@endsection