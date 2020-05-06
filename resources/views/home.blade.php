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
    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body>
    <div class="wrapper">
      <div class="bgslide">
    

        <div class="">
          <h1 class="header-line">{{$popularMovie[0]->title}}</h1>
          <div class="filter-navbar">
            @foreach (explode(',',$popularMovie[0]->genre_id) as $genre )
            @foreach ($moviesgenres as $g)
              @if($g->id== $genre)
              <a href="#">{{$g->name}}</a>
              @endif
            @endforeach
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
        </div>
        


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
        <div class="movie-trailer-grid" id="column1">
          
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
            <button class="btn-wishlist" disabled="primary"><a href="{{'addmovie/'. $movie->id}}">Add to wishlist</a></button>
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

