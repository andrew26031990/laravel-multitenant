<?php

declare(strict_types=1);

use App\Models\Tenant\User;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
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

/*Route::post('auth', function (){
    dd(User::whereGlobalId('5fb9afcb-21d6-3f3d-a190-b30e73952930')->first()->createToken('token')->accessToken);
});

Route::get('/without-auth', function (){
    return 'here';
});

Route::get('/with-auth', function (){
    return 'here-with-auth';
})->middleware('auth:api');*/

Route::middleware([
    'check', 'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    })->middleware('auth:api');

    /*Route::get('/update', function (){
        $user = App\Models\Employee::whereGlobalId('5fb9afcb-21d6-3f3d-a190-b30e73952930')->update([
            'name' => 'John Foo222333', // synced
            'email' => 'john@foreignhost222333', // synced
        ]);
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });*/
});
