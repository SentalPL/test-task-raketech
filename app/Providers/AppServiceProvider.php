<?php

namespace App\Providers;

use App\Interfaces\CountriesApiInterface;
use App\Interfaces\CountriesRepositoryInterface;
use App\Repositories\CountriesRepository;
use App\Services\Api\RestCountriesApi;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        CountriesApiInterface::class => RestCountriesApi::class,
        CountriesRepositoryInterface::class => CountriesRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
