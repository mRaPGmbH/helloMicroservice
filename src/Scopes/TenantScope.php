<?php


namespace HelloCash\HelloMicroservice\Scopes;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Tymon\JWTAuth\Facades\JWTAuth;

class TenantScope implements Scope
{

    /**
     * @var int|null
     */
    public static ?int $tenantId;

    public function apply(Builder $builder, Model $model): void
    {
        if (is_null(self::$tenantId) && !is_null(JWTAuth::getToken())) {
            self::$tenantId = JWTAuth::parseToken()->getPayload()['tid'] ?? null;
        }
        if (is_null(self::$tenantId)) {
            throw new \Exception('Tenant ID is missing!');
        }
        $builder->where($model->getTable() . '.tenant_id', '=', self::$tenantId);
    }

}
