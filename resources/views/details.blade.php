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
          <a href="#"> <img src="{{'https://image.tmdb.org/t/p/w200/'. $movie->poster_path}}" alt="poster" class="movie-cover trailer-cover-image"></a>
                 {{-- video trailer ide umesto slike iznad --}}
           <div class="details">
            <div class="title-1">{{$movie->title}}</div>
           </div>
         </div> 
         <div class="description">
          @if(count($videos)>0)
            <button disabled="primary"><a href="https://www.youtube.com/watch?v={{$videos[0]['key']}}">Play Video</a></button>
          @endif
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
           <a href="#"> <img src="{{'https://image.tmdb.org/t/p/w500/'. $image['file_path']}}" alt="poster" class="movie-poster-1"></a>    
           @endforeach
          </div>
       </div> 
     </div> 
     </div>
   </body> 
</html>

@endsection 
