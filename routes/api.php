<?php


use App\Models\Tenant\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;
//use OpenAI\Laravel\Facades\OpenAI;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


Route::group(
    [
        'prefix' => 'v1',
    ],
    function () {
        Route::group(
            [
                'prefix' => 'company',
                'middleware' => 'auth:api'
            ],
            function () {
                Route::apiResource('tenants', \App\Http\Controllers\v1\Company\TenantController::class);
            });
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
                        Route::post('logout', [\App\Http\Controllers\v1\Profile\AuthController::class, 'logout'])->middleware('auth:api');
                        Route::post('token/refresh', [\App\Http\Controllers\v1\Profile\AuthController::class, 'refreshToken'])->middleware('auth:api');
                });
                Route::group(
                    [
                        'middleware' => 'auth:api'
                ],function (){
                    Route::apiResource('users', \App\Http\Controllers\v1\Profile\CentralUserController::class);
                });
        });
    }
);

Route::get('openai', function (){
    $result = OpenAI::completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => 'What is the universe?',
        'max_tokens' => 10,
    ]);

    return response()->json([
        'data' => $result
    ]);
});










/*Route::get('test', [App\Http\Controllers\TestController::class, 'index']);
Route::get('token', [App\Http\Controllers\TestController::class, 'token']);
Route::get('user', [App\Http\Controllers\TestController::class, 'user'])->middleware('auth:api');


Route::namespace('admin')->group(function () {
});

Route::namespace('company')->group(function () {
});

Route::namespace('client')->group(function () {
});*/

