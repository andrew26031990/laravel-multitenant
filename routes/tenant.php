<?php

declare(strict_types=1);

use App\Http\Middleware\InitializeTenancyByDomain;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

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
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::group(
        [
            'prefix' => 'v1',
        ],
        function () {
            Route::group(
                [
                    'prefix' => 'company',
                ],
                function () {
                    Route::apiResource('products', \App\Http\Controllers\v1\Company\ProductController::class);
                    Route::apiResource('users', \App\Http\Controllers\v1\Company\UserController::class);
                    Route::apiResource('categories', \App\Http\Controllers\v1\Company\CategoryController::class);
                    Route::controller(\App\Http\Controllers\v1\Company\CategoryController::class)->group(function () {
                        Route::get('category/{id}/products', 'products');
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
