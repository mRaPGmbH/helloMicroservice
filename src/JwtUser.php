<?php


namespace HelloCash\HelloMicroservice;

use HelloCash\HelloMicroservice\Scopes\TenantScope;
use Illuminate\Contracts\Auth\Authenticatable;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtUser implements Authenticatable
{

    protected $payload = [];

    /**
     * JwtUser constructor.
     */
    public function __construct()
    {
        $this->payload = JWTAuth::parseToken()->getPayload();
        TenantScope::$tenantId = $this->getClaim('tid');
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getClaim($key)
    {
        if (isset($this->payload[$key])) {
            return $this->payload[$key];
        }
        return null;
    }


    public function getAuthIdentifierName()
    {
        return '';
    }

    public function getAuthIdentifier()
    {
        return 1;
    }

    public function getAuthPassword()
    {
        return '';
    }

    public function getRememberToken()
    {
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
    }

}
