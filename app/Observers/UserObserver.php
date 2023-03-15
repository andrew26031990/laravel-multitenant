<?php

namespace App\Observers;

use App\Models\Tenant\User;

class UserObserver
{
    public function creating(User $user){
        $user->is_active = true;
    }
}
