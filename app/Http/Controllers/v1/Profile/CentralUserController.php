<?php

namespace App\Http\Controllers\v1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Company\updateUserRequest;
use App\Http\Resources\v1\Profile\UserResource;
use App\Services\CentralUserService;

class CentralUserController extends Controller
{
    public CentralUserService $employeeService;
    public function __construct(CentralUserService $employeeService)
    {
        $this->employeeService = $employeeService;
    }
}
