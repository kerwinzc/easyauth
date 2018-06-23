<?php

namespace Kerwinzc\EasyAuth;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $config_file = __DIR__ . '/../config/easyauth.php';
        $this->publishes([ $config_file => config_path('easyauth.php') ], 'easyauth');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $config_file = __DIR__ . '/../config/easyauth.php';

        $this->mergeConfigFrom($config_file, 'easyauth');

        $this->app->bind('easyauth', function ($app) {
            return new TokenService($app);
        });

        $this->app->bind('easyauth.sign', function ($app) {
            return new SignService($app);
        });
    }

}