<?php

namespace App\Services;

use App\Exceptions\EmployeeInactiveException;
use App\Exceptions\LogOutException;
use App\Repositories\Eloquent\EmployeeRepository;
use App\Repositories\EmployeeRepositoryInterface;

/**
 * Class EmployeeService.
 */
class EmployeeService
{
    public EmployeeRepositoryInterface $employeeRepository;
    public function __construct(EmployeeRepositoryInterface $employeeRepository) {
        $this->employeeRepository = $employeeRepository;
    }

    //business logic

    public function getList($request = null, $with = []){
        return $this->employeeRepository->getList($request, $with);
    }

    public function showById($id = null, $with = []){
        return $this->employeeRepository->showById($id, $with);
    }

    public function store($attributes, $load = []){
        return $this->employeeRepository->store($attributes, $load);
    }

    public function update($attributes, $id, $load = [], $associate = []){
        return $this->employeeRepository->update($attributes, $id, $load, $associate);
    }

    public function destroy($id){
        return $this->employeeRepository->destroy($id);
    }

    /**
     * @throws EmployeeInactiveException
     */
    public function sendOtp($request){
        $employee = $this->employeeRepository->store($request);
        if(!$employee->is_active){
            throw new EmployeeInactiveException('Account has been blocked');
        }
        $this->employeeRepository->sendOtp($employee);
        return $employee;
    }

    public function verifyOtp($request){
        return $this->employeeRepository->verifyOtp($request);
    }

    /**
     * @throws \Exception
     */
    public function logout(){
        $loggedOut = $this->employeeRepository->logout();
        if(!$loggedOut){
            throw new LogOutException(__('Unable to log out'));
        }
        return __('Logged out');
    }
}
