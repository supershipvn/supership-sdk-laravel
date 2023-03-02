<?php

namespace SuperShipVN\SuperShip;

use Illuminate\Support\ServiceProvider;
use SuperShip\SuperShipClient;

class SuperShipServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/../config/supership.php';

        $this->mergeConfigFrom($configPath, 'supership');

        $this->app->singleton('supership', function ($app) {
            $config = $app->make('config')->get('supership');

            return new SuperShipClient($config['api_token']);
        });

        $this->app->alias('supership', 'SuperShip\SuperShipClient');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/supership.php' => config_path('supership.php')
            ], 'supership-config');
        }
    }
}
