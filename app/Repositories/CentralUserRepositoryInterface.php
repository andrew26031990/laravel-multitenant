<?php

namespace App\Repositories;

interface CentralUserRepositoryInterface
{
    public function getList($request = null, $with = []);

    public function showById($id = null, $with = []);

    public function store($attributes, $load = []);

    public function update($attributes, $id, $load = []);

    public function destroy($id);

    public function sendOtp($employee);

    public function verifyOtp($request);

    public function logout();

    public function invite($attributes, $tenant, $load = []);
}
