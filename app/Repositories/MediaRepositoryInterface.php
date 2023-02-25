<?php

namespace App\Repositories;

interface MediaRepositoryInterface
{
    public function getList($request = null, $with = []);

    public function getPaginateList($request = null, $with = []);

    public function showById($id = null, $with = []);

    public function store($attributes, $load = []);

    public function update($attributes, $id, $load = [], $associate = []);

    public function destroy($id);
}
