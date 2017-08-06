<?php

namespace Oscarricardosan\PhpunitgLaravel;

use Illuminate\Support\ServiceProvider;

class OscarricardosanPhpunitgServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
