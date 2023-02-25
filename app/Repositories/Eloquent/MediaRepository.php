<?php

namespace App\Repositories\Eloquent;

use App\Models\Media;
use App\Repositories\MediaRepositoryInterface;

/**
 *
 * Class MediaRepository.
 *
 * @mixin \App\Models\Media
 *
 */
class MediaRepository implements MediaRepositoryInterface
{

    protected Media $model;

    public function __construct(Media $model)
    {
        $this->model = $model;
    }

    public function getList($request = null, $with = []){
        return $this
            ->model
            //->when(true, function($query){
            //    $query;
            //})
            //->with($with)
            ->orderByDesc('id')
            ->get();
    }

    public function getPaginateList($request = null, $with = []){

        return $this
            ->model
            //->when(true, function($query){
            //    $query;
            //})
            //->with($with)
            ->orderByDesc('id')
            ->paginate( (int) (($per_page = optional($request)['per_page']) ? $per_page : 15) );

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

    public function update($attributes, $id, $load = [], $associate = []){
        
        $data = $this
            ->model
            ->findOrFail($id);

        $data->fill($attributes);

        foreach($associate as $objectName => $object){
            $data->$objectName()->associate($object);
        }

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
