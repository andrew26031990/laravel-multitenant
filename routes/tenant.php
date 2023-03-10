<?php

declare(strict_types=1);

use App\Models\Tenant\User;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckTenantForMaintenanceMode;
use App\Http\Middleware\InitializeTenancyByDomain;
use App\Http\Middleware\ScopeSessions;
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
    //PreventAccessFromCentralDomains::class,
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
                });
        }
    );

});
