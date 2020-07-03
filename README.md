# HelloCash\HelloMicroservice

Shared tools for laravel/lighthouse/graphql 
based webservices, inlcuding RSA JWT auth 
and multitenancy through JWT claim and 
laravel scopes

## Installation

First do:

    composer require hellocash/hellomicroservice

then add the service provider to your `config/app.php`:

    'providers' => [
        ...
        HelloCash\HelloMicroservice\Providers\LaravelServiceProvider::class,

and change your `config/lighthouse.php` in two places:

    'namespaces' => [
        ...
        'mutations' => [ 
            'HelloCash\\HelloMicroservice\\GraphQL\\Mutations',
            'App\\GraphQL\\Mutations'
        ],

    ...

    'error_handlers' => [
        \Nuwave\Lighthouse\Execution\ExtensionErrorHandler::class,
        \Nuwave\Lighthouse\Execution\ReportingErrorHandler::class,
        \HelloCash\HelloMicroservice\GraphQL\ClientAwareErrorHandler::class,
    ],
Done!

## Custom mutations

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

## Multi-tenancy

If you have a model you want to be tenant aware,
add the `HelloCash\HelloMicroservice\Traits\TenantScopeTrait`
to your model:

    class MyClass extends Model
    {
        use HelloCash\HelloMicroservice\Traits\TenantScopeTrait;

The tenant_id has to be inside the jwt, as a 
claim with the name/key: `tid` 


## Using EnumTypes
To add enums to your graphql endpoint, you must 
register each needed EnumType (found in 
`HelloCash\HelloMicroservice\GraphQL\EnumTypes\`) with the registry
inside your `GraphQLServiceProvider`: 

    public function boot(TypeRegistry $typeRegistry): void
    {
        $typeRegistry->register(Countries::get());
    }
