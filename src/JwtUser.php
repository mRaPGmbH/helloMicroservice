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
        return $this->payload[$key] ?? null;
    }

    /**
     * @return string
     */
    public function getAuthIdentifierName(): string
    {
        return '';
    }

    /**
     * @return int
     */
    public function getAuthIdentifier(): int
    {
        return 1;
    }

    /**
     * @return string
     */
    public function getAuthPassword(): string
    {
        return '';
    }

    /**
     *
     */
    public function getRememberToken(): void
    {
    }

    /**
     * @param string $value
     */
    public function setRememberToken($value): void
    {
    }

    /**
     *
     */
    public function getRememberTokenName(): void
    {
    }

}
