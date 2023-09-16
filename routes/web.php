<?php

use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UnityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function() {
    Route::group([
        'middleware' => 'is_admin',
        'prefix' => 'admin',
        'as' => 'admin.'
    ], function() {
        Route::resource('/unities', UnityController::class);
        Route::resource('/users', UserController::class);
        Route::resource('/places', PlaceController::class);
        Route::resource('/tasks', TaskController::class);
    });
});

