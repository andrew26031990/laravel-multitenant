<?php


use Illuminate\Support\Facades\Route;


Route::get('test', [App\Http\Controllers\TestController::class, 'index']);


Route::namespace('admin')->group(function () {
});

Route::namespace('company')->group(function () {
});

Route::namespace('client')->group(function () {
});
