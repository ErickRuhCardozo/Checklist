<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UnityController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\ChecklistController as AdminChecklistController;
use App\Http\Controllers\Admin\ScanController as AdminScanController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Employee\ChecklistController as EmployeeChecklistController;
use App\Http\Controllers\Employee\ScanController as EmployeeScanController;
use App\Http\Controllers\Employee\SettingsController as EmployeeSettingsController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::group(['middleware' => 'auth'], function() {
    Route::group([
        'middleware' => 'is_admin',
        'prefix' => 'admin',
        'as' => 'admin.'
    ], function() {
        Route::resource('/unities', UnityController::class);
        Route::resource('/users', UserController::class);

        Route::get('/places/batch/create', [PlaceController::class, 'batchCreate'])->name('places.batch-create');
        Route::post('/places/batch/store', [PlaceController::class, 'batchStore'])->name('places.batch-store');
        Route::resource('/places', PlaceController::class);

        Route::get('/tasks/batch/create', [TaskController::class, 'batchCreate'])->name('tasks.batch-create');
        Route::post('/tasks/batch/store', [TaskController::class, 'batchStore'])->name('tasks.batch-store');
        Route::resource('/tasks', TaskController::class);

        Route::resource('/checklists', AdminChecklistController::class);
        Route::resource('/scans', AdminScanController::class);
        Route::resource('/settings', AdminSettingsController::class);
    });

    Route::group([
        'middleware' => 'is_employee',
        'prefix' => 'employee',
        'as' => 'employee.'
    ], function() {
        Route::get('/checklists/continue', [EmployeeChecklistController::class, 'continueChecklist'])->name('checklists.continue');
        Route::resource('/checklists', EmployeeChecklistController::class);
        Route::resource('/scans', EmployeeScanController::class);
        Route::resource('/settings', EmployeeSettingsController::class);
    });
});

