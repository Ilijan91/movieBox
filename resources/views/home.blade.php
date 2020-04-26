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
      <div class="bgslide">
    

        <div class="">
          <h1 class="header-line">WRATH OF THE TITANS</h1>
          <div class="filter-navbar">
            <a href="#">Fantasy</a>
            <a href="#">Animation</a>
            <a href="#">Family</a>
            <a href="#">Duration</a>
          </div>
          <div class="button-navbar">
            <button class="btn-watch-movie">WATCH MOVIE</button>
            <button class="btn-view-info">VIEW INFO</button>
            <button class="btn-add-to-wishlist">+ ADD TO WISHLIST</button>
          </div>
          <div class="column">
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
      
      <div class="movieposter">
        <div class="movie-categorisation">
          <button class="btn-movie-filter btn-trending">Trending</button>
          <button class="btn-movie-filter btn-rated">Top Rated</button>
          <button class="btn-movie-filter btn-arrivals">New Arrivals</button>
		  <button class="btn-movie-filter btn-genre">Genre</button>
		  <span class="icon-view icon-grid"><i class="fas fa-th-large"></i></span>
		  <span class="icon-view icon-list"><i class="fas fa-stream"></i></span>
          <div class="grid-and-list-view">
		
		  </div>
		</div>
		
        <hr />
        <div class="movie-trailer-grid">
          @foreach ($movies as $movie)
          <div class="trailer1">
            <a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a>
              <img src="{{'https://image.tmdb.org/t/p/original'. $movie->poster}}" alt="poster">
            </a>
            <div>
              <span class="ml-1">{{ $movie->rating }}</span>
              <span class="mx-2">|</span>
              <span>{{\Carbon\Carbon::parse($movie->release_date)->format('d M, Y')  }}</span>
          </div>
          @foreach (explode(',',$movie->genre_id) as $genre )
            @foreach ($moviesgenres as $g)
              @if($g->id== $genre)
                {{$g->name}}|
              @endif
            @endforeach
          @endforeach
          </div>
          @endforeach
        </div>

        <div class="movie-trailer-grid">
          @foreach ($tvshows as $tvshow)
          <div class="trailer1">
            <a href="{{ route('series.show', $tvshow->id) }}">{{ $tvshow->title }}</a>
              <img src="{{'https://image.tmdb.org/t/p/original'. $tvshow->poster}}" alt="poster">
            </a>
            <div>
              <span class="ml-1">{{ $tvshow->rating }}</span>
              <span class="mx-2">|</span>
              <span>{{\Carbon\Carbon::parse($tvshow->release_date)->format('d M, Y')  }}</span>
          </div>
          @foreach (explode(',',$tvshow->genre_id) as $genre )
            @foreach ($tvgenres as $g)
              @if($g->id== $genre)
                {{$g->name}}|
              @endif
            @endforeach
          @endforeach
          </div>
          @endforeach
        </div>
        <a href="#" class="viewall">View All</a>
      </div>

      <div class="movieposter">
        <h3>Must Watch</h3>
        <hr />
        <div class="movie-trailer-grid">
          <div class="trailer1">
            <a href="#">
                <img src="images/bg.jpg" />
            </a>
          </div>
          <div class="trailer1">
            <a href="#">
                <img src="images/bg.jpg" />

            </a>
          </div>
          <div class="trailer1">
            <a href="#">
                <img src="images/bg.jpg" />
            </a>
          </div>
          <div class="trailer1 trailer-last">
            <a href="#">
                <img src="images/bg.jpg" />
            </a>
          </div>
        </div>
        <a href="#" class="viewall">View All</a>
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

