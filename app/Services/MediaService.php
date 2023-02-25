<?php

namespace App\Services;
use App\Repositories\MediaRepositoryInterface;

/**
 * Class MediaService.
 */
class MediaService
{

    public MediaRepositoryInterface $media;

    public function __construct(MediaRepositoryInterface $media) {
        $this->media = $media;
    }

    public function getList($request = null, $with = []){
        return $this->media->getList($request, $with);
    }

    public function getPaginateList($request = null, $with = []){
        return $this->media->getPaginateList($request, $with);
    }

    public function showById($id = null, $with = []){
        return $this->media->showById($id, $with);
    }

    public function store($attributes, $load = []){
        return $this->media->store($attributes, $load);
    }

    public function update($attributes, $id, $load = [], $associate = []){
        return $this->media->update($id, $attributes, $load, $associate);
    }

    public function destroy($id){
        return $this->media->destroy($id);
    }

}
