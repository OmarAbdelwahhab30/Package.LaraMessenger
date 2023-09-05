<?php

namespace Omarabdulwahhab\Laramessenger\ServiceProviders;


class LaraServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../migrations/' => database_path('/migrations'),
            __DIR__ . '/../Models/' => app_path("/Models/"),
            __DIR__ . '/../Events/' => app_path("/Events/"),
        ], "migrations");

    }

    public function register()
    {

    }
}
