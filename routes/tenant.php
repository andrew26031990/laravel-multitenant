<?php

declare(strict_types=1);

use App\Models\Tenant\User;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\CheckTenantForMaintenanceMode;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\ScopeSessions;

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

/*Route::post('auth', function (){
    dd(User::whereGlobalId('5fb9afcb-21d6-3f3d-a190-b30e73952930')->first()->createToken('token')->accessToken);
});

Route::get('/without-auth', function (){
    return 'here';
});
*/

Route::middleware(
    [
        'auth:api',
        'check',
    ]
)->group(function (){
    Route::get('/with-auth', function (){
        return 'here-with-auth';
    });
});

/*Route::middleware([
    'web','check',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
});*/
