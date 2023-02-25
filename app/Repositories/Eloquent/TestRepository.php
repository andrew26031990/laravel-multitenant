<?php

namespace App\Repositories\Eloquent;

use App\Models\Test;
use App\Repositories\TestRepositoryInterface;

/**
 *
 * Class TestRepository.
 *
 * @mixin \App\Models\Test
 *
 */
class TestRepository implements TestRepositoryInterface
{

    protected Test $model;

    public function __construct(Test $model)
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
