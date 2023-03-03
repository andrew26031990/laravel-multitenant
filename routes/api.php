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

/*Route::post('auth', function (){
    dd(User::whereId(1)->first()->createToken('token')->accessToken);
});

Route::get('/without-auth', function (){
    return 'here';
});

Route::get('/with-auth', function (){
    return 'here-with-auth';
})->middleware('auth:api');*/

/*Route::get('/fill', function (){
    /*$tenant1 = App\Models\Tenant::create(['id' => 'foo']);
    $tenant1->domains()->create(['domain' => 'foo.localhost']);

    $tenant2 = App\Models\Tenant::create(['id' => 'bar']);
    $tenant2->domains()->create(['domain' => 'bar.localhost']);

    //App\Models\Tenant::all()->runForEach(function () {
        //\App\Models\Tenant\User::factory()->create();
    //});
});*/

/*Route::get('/update', function (){
    \App\Models\Tenant\User::whereGlobalId('5fb9afcb-21d6-3f3d-a190-b30e73952930')->update([
        'name' => 'John Foo111', // synced
        'email' => 'john@foreignhost111', // synced
    ]);
});*/

