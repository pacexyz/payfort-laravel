<?php

namespace PayfortLaravel\Providers;

use Illuminate\Support\ServiceProvider;
use PayfortLaravel\Services\PayfortAPI;
use PayfortLaravel\Services\PayfortRedirection;

class PayfortServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    private $configPath = __DIR__ . '/../../config/payfort.php';
    private $translationsPath = __DIR__ . '/../../resources/lang';
    private $viewsPath = __DIR__ . '/../../resources/views';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        # Add config file to service provider publish command
        $this->publishes([
            $this->configPath => config_path('payfort.php'),
        ], 'config');

        # Load package translation files
        $this->loadTranslationsFrom($this->translationsPath, 'payfort-laravel');

        # Load package views files
        $this->loadViewsFrom($this->viewsPath, 'payfort-laravel');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \Log::debug('Registered');
        # Merge application and packages configurations
        $this->mergeConfigFrom(
            $this->configPath,
            'payfort'
        );

        $this->app->bind(PayfortAPI::class, function () {
            return new PayfortAPI(config('payfort'));
        });

        $this->app->bind(PayfortRedirection::class, function () {
            return new PayfortRedirection(config('payfort'));
        });
    }

//    /**
//     * Get the services provided by the provider.
//     *
//     * @return array
//     */
//    public function provides()
//    {
//        \Log::debug('provides');
//        return ['PayfortLaravel\Facades\Payfort'];
//    }
}
