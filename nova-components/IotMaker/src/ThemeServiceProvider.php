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
            } elseif (str_contains(url(''), 'makersiq')) {
                Nova::theme(asset('/css/makersiq.css?v=3'));
            } elseif (str_contains(url(''), 'fallujahmakerspace')) {
                Nova::theme(asset('/css/fallujah.css?v=9'));
            } elseif (str_contains(url(''), 'maarifmakerspace')) {
                Nova::theme(asset('/css/maarif.css?v=6'));
            }elseif (str_contains(url(''), 'makerchi')) {
                Nova::theme(asset('/css/makerchi.css?v=3'));
            }
            elseif (str_contains(url(''), 'sulimakerspace')) {
                Nova::theme(asset('/css/suli.css?v=6'));
            } elseif (str_contains(url(''), '3dworld')) {
                Nova::theme(asset('/css/3dworld.css?v=1'));
            } elseif (str_contains(url(''), 'erbilmakerspace')) {
                Nova::theme(asset('/css/erbil.css?v=2'));
            } else {
                Nova::theme(asset('/css/makersiq.css?v=3'));
            }

        });

        $this->publishes([
            __DIR__ . '/../resources/css' => public_path('/makersiq'),
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
