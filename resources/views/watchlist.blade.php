@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
  <head>
    <title>MovieBox</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/ee1ec2542e.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="wrapper">
      
     
      
		
        <hr />
        <div class="movie-trailer-grid">
          @if($movies==null)
            <h4>Watchlist is empty</h4>
          @else
          @foreach ($movies as $movie)
          <div class="trailer1">
            <a href="{{ route('movies.showMovie', $movie[0]->id) }}">{{ $movie[0]->title }}</a>
              <img src="{{'https://image.tmdb.org/t/p/original'. $movie[0]->poster_path}}" alt="poster">
            </a>
            <div>
              <span class="ml-1">{{ $movie[0]->rating }}</span>
              <span class="mx-2">|</span>
              <span>{{\Carbon\Carbon::parse($movie[0]->release_date)->format('d M, Y')  }}</span>
          </div>
          @foreach (explode(',',$movie[0]->genre_id) as $genre )
            @foreach ($moviesgenres as $g)
              @if($g->id== $genre)
                {{$g->name}}|
              @endif
            @endforeach
          @endforeach
          @if(auth()->user())
            <form action="{{ route('watchlist.destroy', $movie[0]->id) }}" method="POST">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button class="btn btn-danger">Remove Movie</button>
            </form>
          @endif
          </div>
          
          @endforeach
          @endif
        </div>


      <div class="footer">
		<div class="footer-navmeni">
			<p class="nav-items">Contact</p>
			<p class="nav-items">Ratings</p>
			<p class="nav-items">Movies</p>
			<p class="nav-items">About</p>
		  </div>
    <h2 class="footer-logo-title">THEMOVIEBOX</h2>
		  <p class="copyright">Designed by Milan Houter, All rights reserved.</p>
      </div>
    </div>

  </body>
</html>

@endsection

