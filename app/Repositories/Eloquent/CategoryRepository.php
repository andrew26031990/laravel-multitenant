<?php

namespace App\Repositories\Eloquent;

use App\Models\Tenant\Category;
use App\Repositories\CategoryRepositoryInterface;

/**
 *
 * Class CategoryRepository.
 *
 * @mixin \App\Models\Tenant\Category
 *
 */
class CategoryRepository implements CategoryRepositoryInterface
{

    protected Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getList($request = null, $with = []){

        return $this
            ->model
            //->when(true, function($query){
            //    $query;
            //})
            ->with($with)
            ->orderByDesc('id')
            ->get();
    }


    public function showById($id = null, $with = []){

        return $this
            ->model
            ->with($with)
            ->findOrFail($id);
    }


    public function store($attributes, $load = []){

        return $this
            ->model
            ->create($attributes);
    }

    public function update($attributes, $id, $load = []){

        $data = $this
            ->model
            ->findOrFail($id);
        $data->fill($attributes);
        $data->save();

        return $data;
    }

    public function destroy($id){

        return $this
            ->model
            ->findOrFail($id)
            ->delete();
    }

}
