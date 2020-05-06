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
    <div class="wrapper-all">
      <div class="grey-background">
       <div class="bgslide">
        <h1 class="header-line">My Wishlist Movies</h1>
       </div>
      <div class="movie-poster-wrapper">
        <div class="movie-categorisation">
          <a href="{{route('movies.index')}}" class="btn-movie-filter btn-rated">Now Playing</a>
          <a href="{{route('movies.showTopRatedMovies')}}" class="btn-movie-filter btn-rated">Top Rated</a>
          <a href="{{route('movies.showUpcomingMovies')}}" class="btn-movie-filter btn-rated">Upcoming</a>
          <a href="{{route('movies.showPopularMovies')}}" class="btn-movie-filter btn-rated">Popular</a>
          
          <div class="grid-list-icons">
            <span class="icon-view icon-list-1"><i class="fas fa-stream" onclick="testFunction()"></i></span>
            <span class="icon-view icon-grid"><i class="fas fa-th-large" onclick="gridView()"></i></span>
          </div>
		</div>
        <hr />
        <div class="movie-trailer-grid">
          @if($movies==null)
            <h4>Watchlist is empty</h4>
          @else
          @foreach ($movies as $movie)
          <div class="trailer-card">
            <div class="movie-date-wrapper">
              <img src="{{'https://image.tmdb.org/t/p/original'. $movie[0]->poster_path}}"alt="poster" class="poster-image">
            </div>
            <div class="card-trailer-bottom">
              <a href="{{ route('movies.showMovie', $movie[0]->id) }}"><p class="movie-title">{{ $movie[0]->title }}</p></a>
            <div class="movie-rating-wrapper">
              <span class="ml-1"><span class="movie-rating">{{ $movie[0]->rating }}</span> </span>
        </div>
        <div class="genre-wrapper">
          @foreach (explode(',',$movie[0]->genre_id) as $genre )
            @foreach ($moviesgenres as $g)
              @if($g->id== $genre)
                <span class="movie-genre">{{$g->name}}</span>
              @endif
            @endforeach
          @endforeach
        </div>
            </div>
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
      </div>
      <div class="footer-2">
		<div class="footer-navmeni-2">
			<p class="nav-items-2">Contact</p>
			<p class="nav-items-2">Ratings</p>
			<p class="nav-items-2">Movies</p>
			<p class="nav-items-2">About</p>
		  </div>
    <h2 class="footer-logo-title-2">THEMOVIEBOX</h2>
		  <p class="copyright">Designed by Milan Houter, All rights reserved.</p>
      </div>
    </div>

  </body>
</html>

@endsection
