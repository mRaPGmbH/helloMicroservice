<?php


namespace HelloCash\HelloMicroservice\GraphQL;


use HelloCash\HelloMicroservice\Exceptions\ClientAwareException;
use Closure;
use GraphQL\Error\Error;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Nuwave\Lighthouse\Execution\ErrorHandler;

class ClientAwareErrorHandler implements ErrorHandler
{

    public static function handle(Error $error, Closure $next): array
    {
        $exception = $error->getPrevious();

        $newException = null;
        if ($exception instanceof ModelNotFoundException) {
            $newException = new ClientAwareException('Model not found.', 0, $exception);
        } elseif ($exception instanceof QueryException && preg_match('/foreign key constraint fail/i', $exception->getMessage())) {
            $newException = new ClientAwareException('Unknown foreign id.', 0, $exception);
        } elseif (!$error->isClientSafe() && env('APP_ENV') === 'production' && app()->bound('sentry')) {
            app('sentry')->captureException($exception);
        }

        if ($newException) {
            $extensions = $error->getExtensions();
            if (env('APP_ENV') !== 'production') {
                $extensions['originalMessage'] = $exception->getMessage();
            }
            $error = new Error($newException->getMessage(), $error->getNodes(), $error->getSource(), $error->getPositions(), $error->getPath(), $newException, $extensions);
        }

        return $next($error);
    }
}
