<?php

namespace App\Services;
use App\Repositories\TenantRepositoryInterface;

/**
 * Class TenantService.
 */
class TenantService
{

    public TenantRepositoryInterface $tenant;

    public function __construct(TenantRepositoryInterface $tenant) {
        $this->tenant = $tenant;
    }

    public function getList($request = null, $with = []){
        return $this->tenant->getList($request, $with);
    }

    public function showById($id = null, $with = []){
        return $this->tenant->showById($id, $with);
    }

    public function store($attributes, $load = []){
        return $this->tenant->store($attributes, $load);
    }

    public function update($attributes, $id, $load = [], $associate = []){
        return $this->tenant->update($id, $attributes, $load, $associate);
    }

    public function destroy($id){
        return $this->tenant->destroy($id);
    }

}
