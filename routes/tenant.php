<?php

declare(strict_types=1);

use App\Http\Middleware\InitializeTenancyByDomain;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'auth:api', 'employee',
    InitializeTenancyByDomain::class,
    //PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::group(
        [
            'prefix' => 'v1',
        ],
        function () {
            Route::group(
                [
                    'prefix' => 'tenant',
                ],
                function () {
                    Route::apiResource('products', \App\Http\Controllers\v1\Company\ProductController::class);
                    Route::apiResource('users', \App\Http\Controllers\v1\Company\UserController::class);
                    Route::get('/employees', function (){
                        return \App\Models\Tenant\User::all();
                    });
                });
            Route::group(
                [
                    'prefix' => 'employee',
                ],
                function () {
                    Route::post('invite', [\App\Http\Controllers\v1\Profile\CentralUserController::class, 'invite']);
                });
        }
    );
});
