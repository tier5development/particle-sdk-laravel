<?php

namespace Particle\Console;

use Illuminate\Support\ServiceProvider;

class ParticlesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/Http/routes.php';
        $this->app->make('Particle\Console\Http\Controllers\ParticleController');
    }
}
