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
          @if($popularMovie != null)
          <img class="bgimage" src="{{'https://image.tmdb.org/t/p/original'.$popularMovie[0]->poster_path}}" alt="backgrouind">
          <h1 class="header-line">{{$popularMovie[0]->title}}</h1>
          <div class="filter-navbar">
            @foreach ($popularMovieGenres[$popularMovie[0]->id] as $genre)
              <a href="#">{{$genre}}</a>
            @endforeach
          </div>
          <div class="button-navbar">
            @if(count($videos)>0)
            <button class="btn-watch-trailer" onclick="revealVideo('video','youtube')"><a href="https://www.youtube.com/embed/{{$videos[0]['key']}}" target="targetVideo">Watch Trailer</a></button>
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

    <div id="video" class="lightbox" onclick="hideVideo('video','youtube')">
      <div class="lightbox-container">  
        <div class="lightbox-content">
          
          <button onclick="hideVideo('video','youtube')" class="lightbox-close">
            Close | ✕
          </button>
          <div class="video-container">
            <iframe id="youtube" width="960" name="targetVideo" height="540" frameborder="0" allowfullscreen></iframe>
          </div>      
          
        </div>
      </div>
    </div>
    <script>
      function revealVideo(div,video_id) {
        var video = document.getElementById(video_id).src;
        document.getElementById(video_id).src = video+'&autoplay=1'; 
        document.getElementById(div).style.display = 'block';
      }
      
      function hideVideo(div,video_id) {
        var video = document.getElementById(video_id).src;
        var cleaned = video.replace('&autoplay=1',''); 
        document.getElementById(video_id).src = cleaned;
        document.getElementById(div).style.display = 'none';
      }
          </script>

  </body>
</html>

@endsection
