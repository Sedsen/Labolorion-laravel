<?php

namespace App\Providers;

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
        /*
     * Sets third party service providers that are only needed on local/testing environments
     */
        if ($this->app->environment() != 'production') {
            /**
             * Loader for registering facades.
             */
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();

            /*
         * Load third party local providers
         */
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);

            /*
         * Load third party local aliases
         */
            $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        }
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
