<?php

namespace Webkul\Customer\Providers;

use Illuminate\Support\ServiceProvider;
use Webkul\Customer\Facades\Captcha;

class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap application services.
     *
     * @param  \Illuminate\Routing\Router  $router
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'customer');

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'customer');

        $this->app['validator']->extend('captcha', function ($attribute, $value, $parameters) {
            return Captcha::getFacadeRoot()->validateResponse($value);
        });
    }
}
