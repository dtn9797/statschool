<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(urlGenerator $url)
    {
        if (env('REDIRECT_HTTPS')) {
            $url->formatScheme('https');
        } else {
            $url->formatScheme('http');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        } else {
            $this->app['request']->server->set('HTTP', true);
        }
    }
}
