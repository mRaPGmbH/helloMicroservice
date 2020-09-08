<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Schema\TypeRegistry;

class GraphQLServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @param TypeRegistry $typeRegistry
     * @return void
     */
    public function boot(TypeRegistry $typeRegistry): void
    {
        //$typeRegistry->register(Countries::get());
        //$typeRegistry->register(Languages::get());
    }
}
