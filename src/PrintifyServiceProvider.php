<?php

namespace Ahsan\PrintifyLaravel;

use Illuminate\Support\ServiceProvider;

class PrintifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/printify.php', 'printify'
        );

        $this->app->singleton(PrintifyService::class, function ($app) {
            return new PrintifyService(config('printify.token'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/printify.php' => config_path('printify.php'),
        ], 'config');
    }
}