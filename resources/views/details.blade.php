@extends('layouts.app')

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
          
          <a href="#"> <img src="{{'https://image.tmdb.org/t/p/w200/'. $movie->poster}}" alt="poster"></a>
          <div class="cover-img"></div>
              
          <div class="hero">
                  
            <div class="details">
            
              <div class="title1">{{$movie->title}} <span>PG-13</span></div>
      
              <div class="title2"></div>    
              
              <fieldset class="rating">
                <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                <input type="radio" id="star4" name="rating" value="4" checked /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
              </fieldset>
              
              <span class="likes">109 likes</span>
              
            </div>
            
          </div> 
          
          <div class="description">
            
            <div class="column1">
              @foreach (explode(',',$movie->genre_id) as $genre )
                @foreach ($moviesgenres as $g)
                  @if($g->id== $genre)
                   <span class="tag"> {{$g->name}}</span>
                  @endif
                @endforeach
             @endforeach
            </div> 
            
            <div class="column2">
              
              <p>{{$movie->overview}}</p>
              
            </div> 
          </div> 
       
        </div> 
      </div> 
      </div>
    </body>