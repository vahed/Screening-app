<?php

namespace App\Providers;

use App\Interfaces\ScreeningRepositoryInterface;
use App\Repositories\ScreeningRepository;
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
        $this->app->bind(ScreeningRepositoryInterface::class, ScreeningRepository::class);
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
