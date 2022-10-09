<?php

namespace App\Providers;

use App\Contracts\Repository\CommentRepositoryInterface;
use App\Contracts\Repository\FilmGenreRepositoryInterface;
use App\Contracts\Repository\FilmRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\FilmGenreRepository;
use App\Repositories\FilmRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FilmRepositoryInterface::class,FilmRepository::class);
        $this->app->bind(CommentRepositoryInterface::class,CommentRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(FilmGenreRepositoryInterface::class,FilmGenreRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
