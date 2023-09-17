<?php

use App\Http\Controllers\Admin\ChecklistController as AdminChecklistController;
use App\Http\Controllers\Admin\ScanController as AdminScanController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UnityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Employee\ChecklistController as EmployeeChecklistController;
use App\Http\Controllers\Employee\ScanController as EmployeeScanController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::group(['middleware' => 'auth'], function() {
    Route::group([
        'middleware' => 'is_admin',
        'prefix' => 'admin',
        'as' => 'admin.'
    ], function() {
        Route::get('/', fn() => View::make('admin.index'))->name('home');
        Route::resource('/unities', UnityController::class);
        Route::resource('/users', UserController::class);
        Route::resource('/places', PlaceController::class);
        Route::resource('/tasks', TaskController::class);
        Route::resource('/checklists', AdminChecklistController::class);
        Route::resource('/scans', AdminScanController::class);
    });

    Route::group([
        'middleware' => 'is_employee',
        'prefix' => 'employee',
        'as' => 'employee.'
    ], function() {
        Route::get('/checklists/continue', [EmployeeChecklistController::class, 'continueChecklist'])->name('checklists.continue');
        Route::resource('/checklists', EmployeeChecklistController::class);
        Route::resource('/scans', EmployeeScanController::class);
    });
});

