<?php

namespace App\Observers;

use App\Models\CentralUser;

class EmployeeObserver
{
    public function creating(CentralUser $employee){
        //$employee->is_active = true;
    }
}
