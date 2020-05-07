@extends('layouts.app')

@section('content')
 
<!DOCTYPE html>
<html>
  <head>
    <title>MovieBox</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
 

    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body>
    <div class="wrapper">
      <div class="grey-background">
      <div class="bgslide">
        <img class="bgslide" src="../images/bg.jpg" alt="backgrouind">
          @if($popularMovie != null)
          <h1 class="header-line">{{$popularMovie[0]->title}}</h1>
          <div class="filter-navbar">
            @foreach ($popularMovieGenres[$popularMovie[0]->id] as $genre)
              <a href="#">{{$genre}}</a>
            @endforeach
          </div>
          <div class="button-navbar">
            @if(count($videos)>0)
              <button class="btn-watch-movie"><a href="https://www.youtube.com/watch?v={{$videos[0]['key']}}">WATCH MOVIE</a></button>
            @endif
            <button class="btn-view-info"><a href="{{ route('movies.showMovie', $popularMovie[0]->id) }}">VIEW INFO</a></button>
            <button class="btn-add-to-wishlist"><a href="{{'addmovie/'. $popularMovie[0]->id}}">+ ADD TO WISHLIST</a></button>
          </div>
          <div class="rating-card-wrapper">
            <div class="rating-card">
              <h3>
                Rating
                <span class="reviews-letter">based on 3.546 reviews</span>
              </h3>
              <div class="rating-stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star half-colored-star"></span>
                <span class="fa fa-star"></span>
              </div>
            </div>
          </div>
          @endif
      </div>
      <div class="movie-poster-wrapper">
        <div class="movie-categorisation">
        <button class="btn-movie-filter btn-rated"><a href="{{route('movies.index')}}" >Now Playing</a></button>
          <button class="btn-movie-filter btn-rated"><a href="{{route('movies.showTopRatedMovies')}}" >Top Rated</a></button>
            <button class="btn-movie-filter btn-rated"><a href="{{route('movies.showUpcomingMovies')}}" >Upcoming</a></button>
              <button class="btn-movie-filter btn-rated"><a href="{{route('movies.showPopularMovies')}}">Popular</a></button>
          
          <div class="grid-list-icons">
            <span class="icon-view icon-list-1"><i class="fas fa-stream" onclick="testFunction()"></i></span>
            <span class="icon-view icon-grid"><i class="fas fa-th-large" onclick="gridView()"></i></span>
          </div>
		</div>
        <hr />
        <div class="movie-trailer-grid" id="column1">
          @foreach ($movies as $movie)
          <div class="trailer-card">
            <div class="movie-date-wrapper">
              <span>{{\Carbon\Carbon::parse($movie->release_date)->format('d M, Y')  }}</span>
              <img src="{{'https://image.tmdb.org/t/p/original'. $movie->poster_path}}" alt="poster" class="poster-image">
            </div>
            @if(auth()->user())
            <button class="btn-wishlist" disabled="primary"><a href="{{'addmovie/'. $movie->id}}">Add to wishlist</a></button>
          @endif
            <div class="card-trailer-bottom">
            <a href="{{ route('movies.showMovie', $movie->id) }}"><p class="movie-title">{{ mb_strimwidth($movie->title, 0, 19, "...") }}</p></a>
            <div class="movie-rating-wrapper">
              <span class="ml-1"><span class="movie-rating">{{ $movie->rating }}</span> </span>
        </div>
        <div class="genre-wrapper">
          @foreach (array_slice($moviesgenres[$movie->id], 0,3) as $genre)
            {{$genre}}
          @endforeach
        </div>
        
        </div>
          </div>
          @endforeach
        </div>
      </div>
      </div>
      <div class="footer">
		<div class="footer-navmeni">
			<p class="nav-items">Contact</p>
			<p class="nav-items">Ratings</p>
			<p class="nav-items">Movies</p>
			<p class="nav-items">About</p>
		  </div>
    <h2 class="footer-logo-title">THEMOVIEBOX</h2>
      <p class="copyright">Powerd by <a href="https://www.themoviedb.org/documentation/api">TMDb API</a></p>
      
      </div>
    </div>
  </body>
</html>

@endsection

