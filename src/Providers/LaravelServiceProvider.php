<?php


namespace HelloCash\HelloMicroservice\Providers;


use HelloCash\HelloMicroservice\Console\MakeGraphQlSchemaCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{


    public function boot()
    {
        $path = dirname(__DIR__, 2);
        $this->publishes([$path . '/exports/GraphQLServiceProvider.php' => app_path('Providers/GraphQLServiceProvider.php')]);
        $this->publishes([$path . '/exports/Dockerfile' => base_path('Dockerfile')]);
        $this->publishes([$path . '/exports/Dockerfile.build' => base_path('Dockerfile.build')]);
        $this->publishes([$path . '/exports/docker-entrypoint.sh' => base_path('docker-entrypoint.sh')]);
        $this->publishes([$path . '/exports/default.conf' => base_path('docker/nginx/conf.d/default.conf')]);
        $this->publishes([$path . '/exports/default-production.conf' => base_path('docker/nginx/conf.d/default-production.conf')]);
        $this->publishes([$path . '/exports/php.ini' => base_path('docker/php/php.ini')]);
        $this->publishes([$path . '/exports/php-production.ini' => base_path('docker/php/php-production.ini')]);

        //$this->publishes([$path => config_path('jwt.php')], 'config');
        //$this->mergeConfigFrom($path, 'jwt');

        $this->loadRoutesFrom($path . '/routes/routes.php');

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
