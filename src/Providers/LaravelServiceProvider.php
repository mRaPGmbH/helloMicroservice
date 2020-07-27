<?php


namespace HelloCash\HelloMicroservice\Providers;


use HelloCash\HelloMicroservice\Console\MakeGraphQlSchemaCommand;
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
            return new JwtUserProvider();
        });
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hello-microservice.make.graphqlschema', function () {
            return new MakeGraphQlSchemaCommand();
        });
        $this->commands('hello-microservice.make.graphqlschema');
    }


}
