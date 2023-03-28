<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;

/**
 * Class CategoryService.
 */
class CategoryService
{
    public CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    //business logic

    public function getList($request = null, $with = []){
        return $this->categoryRepository->getList($request, $with);
    }

    public function showById($id = null, $with = []){
        return $this->categoryRepository->showById($id, $with);
    }

    public function store($attributes, $load = []){
        return $this->categoryRepository->store($attributes, $load);
    }

    public function update($attributes, $id, $load = [], $associate = []){
        return $this->categoryRepository->update($attributes, $id, $load, $associate);
    }

    public function destroy($id){
        return $this->categoryRepository->destroy($id);
    }
    //business logic


}
