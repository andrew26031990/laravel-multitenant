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

Route::get('openai', function (){
    /*$result = OpenAI::completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => 'What is the universe?',
        'max_tokens' => 10,
    ]);

    return response()->json([
        'data' => $result
    ]);*/
});

Route::get('openai2', function (){
    $open_ai_key = getenv('OPENAI_API_KEY');
    $open_ai = new \Orhanerday\OpenAi\OpenAi($open_ai_key);

    $complete = $open_ai->chat([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            /*[
                "role" => "system",
                "content" => "You are a helpful assistant."
            ],
            [
                "role" => "user",
                "content" => "Who won the world series in 2020?"
            ],
            [
                "role" => "assistant",
                "content" => "The Los Angeles Dodgers won the World Series in 2020."
            ],*/
            [
                "role" => "user",
                "content" => "How to generate laravel model"
            ],
        ],
        'temperature' => 1.0,
        'max_tokens' => 4000,
        'frequency_penalty' => 0,
        'presence_penalty' => 0,
    ]);

    return response()->json([
        'data' => json_decode($complete, true)
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

