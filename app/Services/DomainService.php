<?php

namespace App\Services;
use App\Repositories\DomainRepositoryInterface;

/**
 * Class DomainService.
 */
class DomainService
{

    public DomainRepositoryInterface $domain;

    public function __construct(DomainRepositoryInterface $domain) {
        $this->domain = $domain;
    }

    public function getList($request = null, $with = []){
        return $this->domain->getList($request, $with);
    }

    public function showById($id = null, $with = []){
        return $this->domain->showById($id, $with);
    }

    public function store($attributes, $load = []){
        return $this->domain->store($attributes, $load);
    }

    public function update($attributes, $id, $load = [], $associate = []){
        return $this->domain->update($id, $attributes, $load, $associate);
    }

    public function destroy($id){
        return $this->domain->destroy($id);
    }

}
