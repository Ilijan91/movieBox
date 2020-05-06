@extends('layouts.app')
@section('content')
<html>
 <head>
   <title>MovieBox Details</title>
   <link rel="stylesheet" type="text/css" href="css/style2.css" />
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
     <div class="body-wrapper">
   <div class="movie-card">
       <div class="main-wrapper">
        <a href="#"> <img src="{{'https://image.tmdb.org/t/p/w200/'. $movie->poster_path}}" alt="poster" class="cover"></a>
         <div class="movie-cover">
          <div id="headerPopup" class="video-overlay">
        <a href="#"> <img src="{{'https://image.tmdb.org/t/p/w200/'. $movie->poster_path}}" alt="poster" class="cover"></a>

        <div id="container">
            <div class="title-1">{{$movie->title}}</div>
      
           <p>Open the Movie Trailer with below button</p>
           @if(count($videos)>0)
            <button class="btn-watch-trailer" onclick="revealVideo('video','youtube')"><a href="https://www.youtube.com/embed/{{$videos[0]['key']}}" target="targetVideo">Watch Trailer</a></button>
            @endif
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
          </div>
         </div> 
         <div class="description">
            <div class="column-1">
              @foreach ($moviesgenres[$movie->id] as $genre)
              <span class="tag"> {{$genre}}</span>
            @endforeach
          </div> 
          
          <div class="column-2">
            <p>{{$movie->overview}}</p>
          </div> 
        </div>
        
          
        <div class="more-images-movie">
          @foreach ($images['backdrops'] as $image)
          @if($loop->index < 9)
            <a href="#"> <img src="{{'https://image.tmdb.org/t/p/w500/'. $image['file_path']}}" alt="poster" class="movie-poster-1"></a> 
          @endif   
          @endforeach
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



