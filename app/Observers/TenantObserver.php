<?php

namespace App\Observers;

use App\Models\Tenant;

class TenantObserver
{
    public function creating(Tenant $tenant){
        $tenant->id = \Str::uuid();
        $tenant->slug = \Str::kebab($tenant->name);
    }

    public function updating(Tenant $tenant){
        $tenant->slug = \Str::kebab($tenant->name);
    }
}
