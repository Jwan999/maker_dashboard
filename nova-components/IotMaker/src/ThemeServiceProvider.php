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

            if (str_contains(url(''), 'iotkids')) {
                Nova::theme(asset('/css/iotkids.css?v=1'));
            } elseif (str_contains(url(''), 'iotmaker')) {
                Nova::theme(asset('/css/iotmaker.css?v=1'));
            } elseif (str_contains(url(''), 'fallujahmakerspace')) {
                Nova::theme(asset('/css/fallujah.css?v=8'));
            } elseif (str_contains(url(''), 'maarifmakerspace')) {
                Nova::theme(asset('/css/maarif.css?v=6'));
            } elseif (str_contains(url(''), 'sulimakerspace')) {
                Nova::theme(asset('/css/suli.css?v=6'));
            } elseif (str_contains(url(''), '3dworld')) {
                Nova::theme(asset('/css/3dworld.css?v=1'));
            } elseif (str_contains(url(''), 'erbilmakerspace')) {
                Nova::theme(asset('/css/erbil.css?v=2'));
            } else {
                Nova::theme(asset('/css/iotmaker.css?v=1'));
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
