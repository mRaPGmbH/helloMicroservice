<?php


namespace HelloCash\HelloMicroservice;

use HelloCash\HelloMicroservice\Interfaces\JwtUserInterface;
use HelloCash\HelloMicroservice\Scopes\TenantScope;
use Illuminate\Contracts\Auth\Authenticatable;
use Sentry\State\Scope;
use Tymon\JWTAuth\Facades\JWTAuth;

use function Sentry\configureScope;

class JwtUser implements Authenticatable, JwtUserInterface
{
    public const GUEST = 0;
    public const USER_READONLY = 1;
    public const USER = 2;
    public const ADMIN = 3;
    public const SUPER_ADMIN = 4;


    protected $payload = [];

    /**
     * JwtUser constructor.
     */
    public function __construct()
    {
        $this->payload = JWTAuth::parseToken()->getPayload();
        $tenantId = $this->getClaim('tid');
        $userId = $this->getClaim('sub');

        TenantScope::$tenantId = $tenantId;

        /* configure sentry */
        configureScope(function(Scope $scope) use($tenantId, $userId): void {
            $scope->setTag('tenant_id', $tenantId);
            $scope->setTag('user_id', $userId);
        });
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getClaim(string $key)
    {
        return $this->payload[$key] ?? null;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->payload['lvl'] ?? 0;
    }

    /**
     * @return string
     */
    public function getAuthIdentifierName(): string
    {
        return 'user_id';
    }

    /**
     * @return int
     */
    public function getAuthIdentifier(): int
    {
        $this->getClaim('sub');
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
