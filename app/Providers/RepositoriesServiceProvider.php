<?php

namespace App\Providers;

use App\Repositories\GenreRepository;

use App\Repositories\MoviesRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\GenreRepositoryInterface;
use App\Repositories\MoviesRepositoryInterface;
use App\Repositories\WatchlistRepository;
use App\Repositories\WatchlistRepositoryInterface;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MoviesRepositoryInterface::class, MoviesRepository::class);
        $this->app->bind(GenreRepositoryInterface::class, GenreRepository::class);
        $this->app->bind(WatchlistRepositoryInterface::class, WatchlistRepository::class);
       
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       
    }
}
