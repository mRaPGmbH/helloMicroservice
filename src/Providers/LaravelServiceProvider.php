<?php


namespace HelloCash\HelloMicroservice\Providers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{


    public function boot()
    {
        //$path = realpath(__DIR__.'/../../config/config.php');
        //$this->publishes([$path => config_path('jwt.php')], 'config');
        //$this->mergeConfigFrom($path, 'jwt');

        Auth::provider('jwtuser', function($app, array $config) {
            return new \HelloCash\HelloMicroservice\Providers\JwtUserProvider();
        });
    }





}
