<?php


namespace HelloCash\HelloMicroservice\GraphQL;


use HelloCash\HelloMicroservice\Exceptions\ClientAwareException;
use Closure;
use GraphQL\Error\Error;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Nuwave\Lighthouse\Execution\ErrorHandler;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class ClientAwareErrorHandler implements ErrorHandler
{

    public static function handle(Error $error, Closure $next): array
    {
        $exception = $error->getPrevious();

        $newException = null;
        $matches = [];
        if ($exception instanceof ModelNotFoundException) {
            $newException = new ClientAwareException('Model not found.', 0, $exception);
        } elseif ($exception instanceof QueryException && preg_match('/foreign key constraint fail/i', $exception->getMessage())) {
            $newException = new ClientAwareException('Unknown foreign id.', 0, $exception);
        } elseif ($exception instanceof QueryException && preg_match('/Unknown column \'([^\']+)\' in \'order clause\'/i', $exception->getMessage(), $matches)) {
            $newException = new ClientAwareException('Unknown column \''.$matches[1].'\' in \'order clause\'.', 0, $exception);
        } elseif ($exception instanceof TokenExpiredException) {
            $newException = new ClientAwareException('Token is expired.', 0, $exception);
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
