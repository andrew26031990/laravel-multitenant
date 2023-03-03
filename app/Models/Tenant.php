<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Domain;
use Stancl\Tenancy\Database\Models\TenantPivot;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasFactory, ColumnFillable;

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function users()
    {
        return $this->belongsToMany(Employee::class, 'tenant_users', 'tenant_id', 'user_id', 'id')
            ->using(TenantPivot::class);
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
        ];
    }
}
