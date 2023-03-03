<?php

namespace App\Repositories;

interface EmployeeRepositoryInterface
{
    public function getList($request = null, $with = []);

    public function showById($id = null, $with = []);

    public function store($attributes, $load = []);

    public function update($attributes, $id, $load = []);

    public function destroy($id);

    public function sendOtp($employee);

    public function verifyOtp($request);
}
