<?php


use App\Models\Tenant\User;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => 'v1',
    ],
    function () {
        Route::group(
            [
                'prefix' => 'profile'
            ],
            function () {
                Route::group(
                    [
                        'prefix' => 'auth'
                    ],
                    function (){
                        Route::post('code', [\App\Http\Controllers\v1\Profile\AuthController::class, 'getCode']);
                        Route::post('verify', [\App\Http\Controllers\v1\Profile\AuthController::class, 'verifyCode']);
                });
                Route::group(
                    [
                        'middleware' => 'auth:api'
                ],function (){
                    Route::apiResource('employees', \App\Http\Controllers\v1\Profile\EmployeeController::class);
                    Route::group(
                        [
                            'prefix' => 'employee'
                        ],
                        function (){
                            Route::post('logout', [\App\Http\Controllers\v1\Profile\EmployeeController::class, 'logout']);
                        });
                });
        });
        Route::group(
            [
                'prefix' => 'company',
                'middleware' => 'auth:api'
            ],
            function () {
                Route::apiResource('tenants', \App\Http\Controllers\v1\Company\TenantController::class);
            });
    }
);










/*Route::get('test', [App\Http\Controllers\TestController::class, 'index']);
Route::get('token', [App\Http\Controllers\TestController::class, 'token']);
Route::get('user', [App\Http\Controllers\TestController::class, 'user'])->middleware('auth:api');


Route::namespace('admin')->group(function () {
});

Route::namespace('company')->group(function () {
});

Route::namespace('client')->group(function () {
});*/

