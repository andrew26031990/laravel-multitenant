<?php

namespace App\Services;
use App\Repositories\TestLogRepositoryInterface;

/**
 * Class TestLogService.
 */
class TestLogService
{

    public TestLogRepositoryInterface $testlog;

    public function __construct(TestLogRepositoryInterface $testlog) {
        $this->testlog = $testlog;
    }

    public function getList($request = null, $with = []){
        return $this->testlog->getList($request, $with);
    }

    public function showById($id = null, $with = []){
        return $this->testlog->showById($id, $with);
    }

    public function store($attributes, $load = []){
        return $this->testlog->store($attributes, $load);
    }

    public function update($attributes, $id, $load = [], $associate = []){
        return $this->testlog->update($id, $attributes, $load, $associate);
    }

    public function destroy($id){
        return $this->testlog->destroy($id);
    }

}
