<?php

namespace App\Providers;

use App\Repositories\MoviesRepository;
use App\Repositories\MoviesTvRepositoryInterface;
use App\Repositories\TvRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MoviesTvRepositoryInterface::class, MoviesRepository::class);
        $this->app->bind(MoviesTvRepositoryInterface::class, TvRepository::class);
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
