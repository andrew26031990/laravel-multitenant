<?php

namespace App\Repositories\Eloquent;

use App\Models\CentralUser;
use App\Repositories\CentralUserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;

/**
 *
 * Class CentralUserRepository.
 *
 * @mixin \App\Models\CentralUser
 *
 */
class CentralUserRepository implements CentralUserRepositoryInterface
{

    protected CentralUser $model;

    public function __construct(CentralUser $model)
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
            ->firstOrCreate($attributes);
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

    public function sendOtp($employee)
    {
        return $employee
            ->verificationCodes()
            ->create();
    }

    public function verifyOtp($request)
    {
        $employee = $this->model->wherePhone($request['phone'])->first();
        $employee->access = $employee->createToken('token');
        return $employee;
    }

    public function invite($attributes, $tenant, $load = [])
    {
        return $this
            ->model
            ->firstOrCreate($attributes);
    }
}
