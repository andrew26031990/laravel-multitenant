<?php

namespace App\Services;

use App\Repositories\BrandRepositoryInterface;

/**
 * Class BrandService.
 */
class BrandService
{
    public BrandRepositoryInterface $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository) {
        $this->brandRepository = $brandRepository;
    }

    //business logic

    public function getList($request = null, $with = []){
        return $this->brandRepository->getList($request, $with);
    }

    public function showById($id = null, $with = []){
        return $this->brandRepository->showById($id, $with);
    }

    public function store($attributes, $load = []){
        return $this->brandRepository->store($attributes, $load);
    }

    public function update($attributes, $id, $load = [], $associate = []){
        return $this->brandRepository->update($attributes, $id, $load, $associate);
    }

    public function destroy($id){
        return $this->brandRepository->destroy($id);
    }

    //business logic


}
