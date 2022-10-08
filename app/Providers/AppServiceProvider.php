<?php

namespace App\Providers;

use App\Contracts\FilmRepositoryInterface;
use App\Contracts\GenreServiceInterface;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\Application\StoreFilmApplicationService;
use App\Services\Domain\Contracts\DomainServiceInterface;
use App\Services\Domain\StoreFilmDomainService;
use App\Repositories\FilmRepository;
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
          ->needs(FilmRepositoryInterface::class)
          ->give(FilmRepository::class);
          
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
