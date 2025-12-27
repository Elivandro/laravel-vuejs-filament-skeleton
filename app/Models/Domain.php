<?php declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Stancl\Tenancy\Database\Models\Domain as BaseDomain;

final class Domain extends BaseDomain
{
    use BelongsToTenant;
    use HasFactory;
}
