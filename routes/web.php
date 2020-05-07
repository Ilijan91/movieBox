<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/','HomeController@index')->name('movies.index');
Route::get('/home','HomeController@index')->name('movies.index');
Route::get('/movies/{id}','HomeController@showMovie')->name('movies.showMovie');

Route::get('/nowplaying','HomeController@showNowPlayingMovies')->name('movies.showNowPlayingMovies');
Route::get('/toprated','HomeController@showTopRatedMovies')->name('movies.showTopRatedMovies');
Route::get('/upcoming','HomeController@showUpcomingMovies')->name('movies.showUpcomingMovies');
Route::get('/popular','HomeController@showPopularMovies')->name('movies.showPopularMovies');

Route::get('/watchlist/{user_id}','WatchlistsController@index')->name('watchlist.index');
Route::delete('/watchlist/destroy/{movie_id}', 'WatchlistsController@destroy')->name('watchlist.destroy');;
Route::get('/addmovie/{movie_id}','WatchlistsController@store')->name('watchlist.store');

