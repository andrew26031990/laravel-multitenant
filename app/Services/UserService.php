<?php

namespace App\Services;
use App\Repositories\UserRepositoryInterface;

/**
 * Class UserService.
 */
class UserService
{

    public UserRepositoryInterface $user;

    public function __construct(UserRepositoryInterface $user) {
        $this->user = $user;
    }

    public function getList($request = null, $with = []){
        return $this->user->getList($request, $with);
    }

    public function showById($id = null, $with = []){
        return $this->user->showById($id, $with);
    }

    public function store($attributes, $load = []){
        return $this->user->store($attributes, $load);
    }

    public function update($attributes, $id, $load = [], $associate = []){
        return $this->user->update($attributes, $id, $load, $associate);
    }

    public function destroy($id){
        return $this->user->destroy($id);
    }
}
