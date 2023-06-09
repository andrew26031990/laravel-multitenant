<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

/**
 * Class ProductService.
 */
class ProductService
{
    public ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    //business logic

    public function getList($request = null, $with = []){
        return $this->productRepository->getList($request, $with);
    }

    public function showById($id = null, $with = []){
        return $this->productRepository->showById($id, $with);
    }

    public function store($attributes, $load = []){
        $product = $this->productRepository->store($attributes, $load);
        $product->categories()->sync(((array)optional($attributes)['categories_id']));
        $product->load($load);
        return $product;
    }

    public function update($attributes, $id, $load = [], $associate = []){
        return $this->productRepository->update($attributes, $id, $load, $associate);
    }

    public function destroy($id){
        return $this->productRepository->destroy($id);
    }

    //business logic


}
