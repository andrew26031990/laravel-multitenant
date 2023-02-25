<?php

namespace App\Services;
use App\Repositories\TestRepositoryInterface;

/**
 * Class TestService.
 */
class TestService
{

    public TestRepositoryInterface $test;

    public function __construct(TestRepositoryInterface $test) {
        $this->test = $test;
    }

    public function getList($request = null, $with = []){
        return $this->test->getList($request, $with);
    }

    public function showById($id = null, $with = []){
        return $this->test->showById($id, $with);
    }

    public function store($attributes, $load = []){
        return $this->test->store($attributes, $load);
    }

    public function update($attributes, $id, $load = [], $associate = []){
        return $this->test->update($id, $attributes, $load, $associate);
    }

    public function destroy($id){
        return $this->test->destroy($id);
    }

}
