<?php

namespace App\Services;

use App\Models\CentralUser;
use App\Models\Tenant;
use App\Models\Tenant\User;
use App\Models\TenantUser;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\TenantRepositoryInterface;

/**
 * Class TenantService.
 */
class TenantService
{

    public TenantRepositoryInterface $tenantRepository;
    public UserRepository $userRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, UserRepository $userRepository) {
       $this->tenantRepository = $tenantRepository;
       $this->userRepository = $userRepository;
    }

    //business logic

    public function getList($request = null, $with = []){
        $tenants = auth()->user()->tenants()->get();
        return $tenants->load('domains');
    }

    public function showById($id = null, $with = []){
        return $this->tenantRepository->showById($id, $with);
    }

    public function store($attributes){
        $tenant = auth()->user()->tenants()->create($attributes);
        $tenant->domains()->create(['domain' => $tenant->slug.'.'.config('tenancy.central_domains')[2]]);
        return $tenant->load('domains');
    }

    public function update($attributes, $id, $load = [], $associate = []){
        return $this->tenantRepository->update($id, $attributes, $load, $associate);
    }

    public function destroy($id){
        return $this->tenantRepository->destroy($id);
    }
}
