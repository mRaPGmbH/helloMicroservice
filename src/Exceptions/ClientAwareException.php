<?php

namespace HelloCash\HelloMicroservice\Exceptions;

use Exception;
use GraphQL\Error\ClientAware;
use Throwable;

class ClientAwareException extends Exception implements ClientAware
{
    /** @var string */
    protected $category = 'unknown';

    public function __construct($message = "", $code = 0, Throwable $previous = null, $category = null)
    {
        parent::__construct($message, $code, $previous);
        $this->category = $category;
    }

    /**
     * @return bool
     */
    public function isClientSafe()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

}
