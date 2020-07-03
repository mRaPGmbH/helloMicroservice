<?php

namespace HelloCash\HelloMicroservice\Traits;


use HelloCash\HelloMicroservice\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Model;

trait TenantScopeTrait
{
    public static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());

        static::creating(function(Model $model): Model {
            $model->tenant_id = TenantScope::$tenantId;
            return $model;
        });
    }
}
