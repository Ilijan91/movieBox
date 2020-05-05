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
          @endif
          
       


      </div>
     
      <div class="movieposter">
        <div class="movie-categorisation">
          <a href="{{route('movies.index')}}" class="btn-movie-filter btn-rated">Now Playing</a>
          <a href="{{route('movies.showTopRatedMovies')}}" class="btn-movie-filter btn-rated">Top Rated</a>
          <a href="{{route('movies.showUpcomingMovies')}}" class="btn-movie-filter btn-rated">Upcoming</a>
          <a href="{{route('movies.showPopularMovies')}}" class="btn-movie-filter btn-rated">Popular</a>
          
          <span class="icon-view icon-grid"><i class="fas fa-th-large"></i></span>
          <span class="icon-view icon-list"><i class="fas fa-stream"></i></span>
          <div class="grid-and-list-view">
		
		  </div>
		</div>
		
        <hr />
        <div class="movie-trailer-grid">
          @foreach ($movies as $movie)
          <div class="trailer1">
            <a href="{{ route('movies.showMovie', $movie->id) }}">{{ $movie->title }}</a>
              <img src="{{'https://image.tmdb.org/t/p/original'. $movie->poster_path}}" alt="poster">
            </a>
            <div>
              <span class="ml-1">{{ $movie->rating }}</span>
              <span class="mx-2">|</span>
              <span>{{\Carbon\Carbon::parse($movie->release_date)->format('d M, Y')  }}</span>
          </div>
         
          @foreach (array_slice($moviesgenres[$movie->id], 0,3) as $genre)
              {{$genre}}
          @endforeach
           
        
          
          @if(auth()->user())
            <button disabled="primary"><a href="{{'addmovie/'. $movie->id}}">Add to watchlist</a></button>
          @endif
          </div>
          
          @endforeach
          
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

