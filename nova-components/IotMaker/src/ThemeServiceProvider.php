<?php

namespace Maker\Iotmaker;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::booted(function () {

            if (str_contains(url(''), 'http://127.0.0.1:8000')) {
                Nova::theme(asset('/css/iotkids.css'));
            } elseif (str_contains(url(''), 'iotmaker')) {
                Nova::theme(asset('/css/app.css'));
            } else {
                Nova::theme(asset('/css/app.css'));
            }

        });

        $this->publishes([
            __DIR__ . '/../resources/css' => public_path('/IotMaker'),
        ], 'public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
