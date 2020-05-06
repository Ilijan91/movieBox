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
          @foreach ($movies as $movie)
          <div class="trailer-card">
            <div class="movie-date-wrapper">
              <span>{{\Carbon\Carbon::parse($movie->release_date)->format('Y')}}</span>
              <img src="{{'https://image.tmdb.org/t/p/original'. $movie->poster_path}}" alt="poster" class="poster-image">
            </div>
            <div class="card-trailer-bottom">
              <a href="{{ route('movies.showMovie', $movie->id) }}"><p class="movie-title">{{ $movie->title }} </p></a>

            <div class="movie-rating-wrapper">
              <span class="ml-1"><span class="movie-rating">{{ $movie->rating }}</span> </span>
          </div>
          <div class="genre-wrapper">
            @foreach (explode(',',$movie->genre_id) as $genre)
              @foreach ($moviesgenres as $g)
                @if($g->id== $genre)
                  <span class="movie-genre">{{$g->name}}</span>
                @endif
              @endforeach
            @endforeach
          </div>
          @if(auth()->user())
            <form action="{{ route('watchlist.destroy', $movie[0]->id) }}" method="POST">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button class="btn btn-danger">Remove Movie</button>
            </form>
          @endif
          </div>
          </div>
          @endforeach
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

