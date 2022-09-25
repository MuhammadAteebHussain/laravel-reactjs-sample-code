<?php

namespace App\Providers;

use App\Contracts\FilmRepositoryInterface;
use App\Http\Controllers\FilmController;
use App\Http\Services\Application\Contracts\ApplicationServiceInterface;
use App\Http\Services\Application\StoreFilmsApplicationService;
use App\Http\Services\Domain\Contracts\DomainServiceInterface;
use App\Http\Services\Domain\StoreFilmDomainService;
use App\Repositories\FilmRepository;
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
        $this->app->when(StoreFilmsApplicationService::class)
          ->needs(DomainServiceInterface::class)
          ->give(StoreFilmDomainService::class);

          $this->app->when(FilmController::class)
          ->needs(FilmRepositoryInterface::class)
          ->give(FilmRepository::class);

          
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
