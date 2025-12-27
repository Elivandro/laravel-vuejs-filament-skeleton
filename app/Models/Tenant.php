<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\TenantScopeTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

final class Tenant extends BaseTenant
{
    use HasDomains;
    use HasFactory;
    use HasUuids;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'user_id',
            'name',
            'description',
            'logo',
            'data',
            'is_active'
        ];
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
