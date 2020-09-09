# HelloCash\HelloMicroservice

Shared tools for laravel/lighthouse/graphql 
based webservices, inlcuding RSA JWT auth 
and multitenancy through JWT claim and 
laravel scopes

## Installation (creation of a new project)

Always replace `helloTest` with the name of your service or app:

    composer create-project --prefer-dist laravel/laravel helloTest
    git clone git@github.com:mRaPGmbH/helloTest.git temp
    mv temp/.git helloTest/.git
    rm -rf temp
    cd helloTest
    composer require hellocash/hellomicroservice
    php artisan vendor:publish --all
    php artisan key:generate

## Configuration

### config/cors.php

Change:

    'paths' => ['api/*'],
to:

    'paths' => ['api/*', 'graphql/*', 'graphql'],

### config/app.php
Add:

    'providers': => [
        ...
        Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
        HelloCash\HelloMicroservice\Providers\LaravelServiceProvider::class,
        App\Providers\GraphQLServiceProvider::class,
        Yab\MySQLScout\Providers\MySQLScoutServiceProvider::class,        
    ],

### config/lighthouse.php

Change:

    'uri' => '/graphql',
to:

    'uri' => '/api/test/graphql',
(Replace `/test` with the url-path for your service or app.)    
    
Change:

    'guard' => null,
to:

    'guard' => 'api',
Change: 

    'namespaces' => [
        ...
        'mutations' => 'App\\GraphQL\\Mutations',
to:

    'namespaces' => [
        ...
        'mutations' => [
            'HelloCash\\HelloMicroservice\\GraphQL\\Mutations',
            'App\\GraphQL\\Mutations'
        ],
Add:

	'error_handlers' => [
		...
	    \HelloCash\HelloMicroservice\GraphQL\ClientAwareErrorHandler::class,
	],

### config/auth.php

Change:

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],
    ],
to:

    'providers' => [
        'users' => [
            'driver' => 'jwtuser'
        ],
    ],

### config/jwt.php

Change:

    'algo' => env('JWT_ALGO', 'HS256'),
    ...
    'required_claims' => [
        'iss',
        'iat',
        'exp',
        'nbf',
        'sub',
        'jti',
    ],
to:

    'algo' => env('JWT_ALGO', 'RS256'), // please note: R instead of H !
    ...
    'required_claims' => [
        'exp',
    ],

### config/scout.php

Add just below 'algolia' configuration:

    'mysql' => [
        'mode' => 'LIKE_EXPANDED',
        'model_directories' => [app_path()],
        'min_search_length' => 0,
        'min_fulltext_search_length' => 4,
        'min_fulltext_search_fallback' => 'LIKE',
        'query_expansion' => false
    ],

## Environment

### .env
Change:

    APP_URL=http://localhost
to:

    APP_URL=put-your-app-url-here

Change: 

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
to:

    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=helloTest # replace with name of your service
    DB_USERNAME=helloTest # replace with name of your service
    DB_PASSWORD=helloTest # replace with name of your service
Add at the bottom:

    SENTRY_LARAVEL_DSN=put-your-sentry-url-here
    JWT_PUBLIC_KEY=file:///var/www/html/jwtkey-public.pem
    LIGHTHOUSE_CACHE_ENABLE=true
    SCOUT_DRIVER=mysql
    
Copy the file `jwtkey-public.pem` (RSA public key) into the 
root dir of your application. If you don't have an RSA key pair
yet, you can create one with:

    openssl genrsa -des3 -out jwtkey-private.pem 2048
    openssl rsa -in jwtkey-private.pem -outform PEM -pubout -out jwtkey-public.pem

### .env.production
First:

    cp .env .env.production
Then change:

    APP_ENV=local
    ...
    APP_DEBUG=true
    ...
    LOG_CHANNEL=stack
    ...
    SESSION_DRIVER=file
to:

    APP_ENV=production
    ...
    APP_DEBUG=false
    ...
    LOG_CHANNEL=stderr
    ...
    SESSION_DRIVER=array
Delete all rows that start with:

    REDIS_*
    MAIL_*
    AWS_*
    PUSHER_*
    MIX_PUSHER_* 

### .env.example

Replace with your new .env file:

    cp .env .env.example

## Routes

### routes/web.php

Change:

	Route::get('/', function () {
	    return view('welcome');
	});
to:

    Route::namespace('\HelloCash\HelloMicroservice\Http\Controllers')->group(function () {"
        Route::get('/', 'HealthCheck');"
        Route::get('api/test/', 'HealthCheck');"
    });"
(Replace `/test` with the url-path for your service or app.)    

## Laravel stuff

### app/Providers/AppServiceProvider
Add:

    public function boot() {
        ...
        Builder::defaultStringLength(191); // required for compatibility with mysql 5.6 (and RDS Aurora 5.6-compatible)
(This will no longer be needed after upgrading to mysql 5.7!)

### routes/api.php

Delete:

	Route::middleware('auth:api')->get('/user', function (Request $request) {
	    return $request->user();
	}); 

### graphql/schema.graphql

Delete:

    type Query {
        ...
    }
    
    type User {
        ...
    }

Add:

    "A datetime and timezone string in ISO 8601 format `Y-m-dTH:i:sO`, e.g. `2020-04-20T13:53:12+02:00`."
    scalar DateTimeTz @scalar(class: "Nuwave\\Lighthouse\\Schema\\Types\\Scalars\\DateTimeTz")

    "file upload"
    scalar Upload @scalar(class: "Nuwave\\Lighthouse\\Schema\\Types\\Scalars\\Upload")
    
    input DateRange {
        from: Date!
        to: Date!
    }
    input DateTimeRange {
        from: DateTime!
        to: DateTime!
    }
    input DateTimeTzRange {
        from: DateTimeTz!
        to: DateTimeTz!
    }
    input IntRange {
        from: Int
        to: Int
    }
    input FloatRange {
        from: Float
        to: Float
    }

### app/User

Delete this file.

### database/seeds/UserSeeder

Delete this file.

## Bonus features

### Custom mutations for composite primary keys

When you have models that use a composite primary key
or should be loaded by a different key, other than id 

Implement the `HelloCash\HelloMicroservice\Interfaces\CUstomMutations` 
interface in your model:

    class MyClass extends Model implements CustomMutations
    {
    
        public static function queryForMutations(array $args): Builder
        {
            return self::where('my_field', $args['my_field']);
        }        

The method `queryForMutations` must return a query builder pre-filled 
with everything needed to successfully load the model.

`$args` is an array containing the arguments as found in 
the graphQL query. The corresponding graphQL query might look
something like this:

    {
        myClass(my_field: 'value') {
            id
        }
    }

### Multi-tenancy

If you have a model you want to be tenant aware,
add the `HelloCash\HelloMicroservice\Traits\TenantScopeTrait`
to your model:

    class MyClass extends Model
    {
        use HelloCash\HelloMicroservice\Traits\TenantScopeTrait;

The tenant_id has to be inside the jwt, as a 
claim with the name/key: `tid` 


### Using EnumTypes
To add enums to your graphql endpoint, you must 
register each needed EnumType (found in 
`HelloCash\HelloMicroservice\GraphQL\EnumTypes\`) with the registry
inside your `GraphQLServiceProvider`: 

    public function boot(TypeRegistry $typeRegistry): void
    {
        $typeRegistry->register(Countries::get());
        $typeRegistry->register(Languages::get());
    }
You can also add your own Enums. (See helloCrm: 
`app/GraphQL/EnumTypes/NewsletterStatuses.php` for an example.)
