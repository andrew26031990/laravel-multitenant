<?php

namespace App\Observers;

use App\Models\CentralUser;

class CentralUserObserver
{
    public function creating(CentralUser $user){
        $user->is_active = true;
    }
}
