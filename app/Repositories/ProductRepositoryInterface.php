<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function getList($request = null, $with = []);

    public function showById($id = null, $with = []);

    public function store($attributes, $load = []);

    public function update($attributes, $id, $load = []);

    public function destroy($id);
}
