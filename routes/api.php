<?php


use App\Models\CentralUser;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('test', [App\Http\Controllers\TestController::class, 'index']);
Route::get('token', [App\Http\Controllers\TestController::class, 'token']);
Route::get('user', [App\Http\Controllers\TestController::class, 'user'])->middleware('auth:api');


Route::namespace('admin')->group(function () {
});

Route::namespace('company')->group(function () {
});

Route::namespace('client')->group(function () {
});

Route::get('/fill', function (){
    $tenant1 = App\Models\Tenant::create(['id' => 'foo']);
    $tenant1->domains()->create(['domain' => 'foo.localhost']);

    $tenant2 = App\Models\Tenant::create(['id' => 'bar']);
    $tenant2->domains()->create(['domain' => 'bar.localhost']);

    App\Models\Tenant::all()->runForEach(function () {
        App\Models\User::factory()->create();
    });
});

Route::get('/update', function (){
    App\Models\User::whereGlobalId('5fb9afcb-21d6-3f3d-a190-b30e73952930')->update([
        'name' => 'John Foo111', // synced
        'email' => 'john@foreignhost111', // synced
    ]);
});

