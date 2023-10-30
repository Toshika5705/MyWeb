<?php

namespace App\Providers;

use App\Providers\Interfaces\ISqlProviders;
use App\Providers\Servces\SqlProviders;
use Illuminate\Support\ServiceProvider;

class SqlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ISqlProviders::class, SqlProviders::class);
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
