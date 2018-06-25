<?php
namespace RGiordano\DomParser;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @throws \Exception
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/../config/domparser.php';
        $this->mergeConfigFrom($configPath, 'domparser');

        $this->app->bind('domparser', function() {
            return new SimpleHtmlDom();
        });
        $this->app->alias('domparser', SimpleHtmlDom::class);

        $this->app->bind('domparser.wrapper', function () {
            return new DomParser();
        });

    }

    /**
     * Check if package is running under Lumen app
     *
     * @return bool
     */
    protected function isLumen()
    {
        return str_contains($this->app->version(), 'Lumen') === true;
    }

    public function boot()
    {
        if (! $this->isLumen()) {
            $configPath = __DIR__.'/../config/domparser.php';
            $this->publishes([$configPath => config_path('domparser.php')], 'config');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('domparser', 'domparser.wrapper');
    }

}
