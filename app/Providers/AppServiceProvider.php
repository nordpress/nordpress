<?php

namespace App\Providers;

use Barryvdh\Debugbar\Facade as DebugbarFacade;
use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $providers = [
        DebugbarServiceProvider::class,
        IdeHelperServiceProvider::class
    ];

    protected array $aliases = [
        'Debugbar' => DebugbarFacade::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            foreach ($this->providers as $provider) {
                $this->app->register($provider);

                foreach ($this->aliases as $alias) {
                    $this->app->alias($provider, $alias);
                }
            }
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
