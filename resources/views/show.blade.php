@extends('layouts.app')

@section('content')
    <div class="movie-info">
        <div class="container">
            <div class="flex-none">
                <img src="{{'https://image.tmdb.org/t/p/w200/'. $movie['poster_path']}}" alt="poster" class="w-64 lg:w-96">
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{$movie['title']}}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                   
                    <span class="ml-1">{{ $movie['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{\Carbon\Carbon::parse($movie['release_date'])->format('d M, Y')  }}</span>
                    <span class="mx-2">|</span>
                    <span>
                      
                        @foreach ($movie['genres'] as $genre)
                            {{$genre['name']}} |
                        @endforeach
                    </span>
                </div>

                <p>
                    {{ $movie['overview'] }}
                </p>
                @if (count($movie['videos']['results']) > 0)
                    <div><a href="https://www.youtube.com/watch?v={{$movie['videos']['results'][0]['key']}}" class="float-left btn btn-primary btn-xs">Play video</a></div><br><br>
                @endif   
            </div>
        </div>     
    </div> <!-- end movie-info -->

    
    <div class="movie-images">
        <div class="container">
            <h2>Images</h2>
            <div class="row">
            @foreach ($movie['images']['backdrops'] as $image)
                    <div class="col-4 mt-2">
                        <a href="#">
                            <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="image1" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach
            </div>
        </div> 
    </div> <!-- end movie-images -->
@endsection