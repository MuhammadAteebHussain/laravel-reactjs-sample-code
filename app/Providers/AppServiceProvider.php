<?php

namespace App\Providers;

use App\Contracts\CommentInterface;
use App\Contracts\CommentsInterface;
use App\Contracts\FilmInterface;
use App\Contracts\GenreServiceInterface;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Services\Application\StoreFilmApplicationService;
use App\Services\Domain\Contracts\DomainServiceInterface;
use App\Services\Domain\StoreFilmDomainService;
use App\Services\General\CommentService;
use App\Services\General\CommentsService;
use App\Services\General\FilmService;
use App\Services\General\GenreService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(StoreFilmApplicationService::class)
          ->needs(DomainServiceInterface::class)
          ->give(StoreFilmDomainService::class);


          $this->app->when(FilmController::class)
          ->needs(FilmInterface::class)
          ->give(FilmService::class);

          $this->app->when(CommentController::class)
          ->needs(CommentInterface::class)
          ->give(CommentService::class);
          
          
          
          $this->app->when(GenreController::class)
          ->needs(GenreServiceInterface::class)
          ->give(GenreService::class);
          
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
