<?php

namespace App\Traits;

use App\Models\Scopes\ScopeForTenant;

trait TenantScopeTrait
{
    public static function booted(): void
    {
        static::addGlobalScope(new ScopeForTenant());

        static::creating(fn($model) => self::defineScope($model));
    }

    private static function defineScope($model): void
    {
        $user = auth()->user();

        if ($user && filled($user->tenant_id)) {
            $model->tenant_id = $user->tenant_id;
        }
    }
}
