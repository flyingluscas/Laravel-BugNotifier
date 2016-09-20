<?php

namespace FlyingLuscas\BugNotifier;

use Illuminate\Support\ServiceProvider;

class BugNotifierServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config.php', 'bugnotifier');

        $this->loadViewsFrom(__DIR__.'/views', 'bugnotifier');

        $this->publishes([
            __DIR__.'/config.php' => config_path('bugnotifier.php'),
        ], 'config');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
