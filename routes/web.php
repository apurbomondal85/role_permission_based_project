<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'userAdmin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Role
    Route::group(['prefix' => 'roles', 'as' => 'role.', 'controller' => RoleController::class], function () {
        Route::get('/', 'index')->name('index')->middleware('permission:role_index');
        Route::get('/create', 'create')->name('create')->middleware('permission:role_create');
        Route::post('/store', 'store')->name('store')->middleware('permission:role_create');
        Route::get('/{role}/edit', 'edit')->name('edit')->middleware('permission:role_update');
        Route::post('/{role}/update', 'update')->name('update')->middleware('permission:role_update');
        Route::get('/{role}/delete', 'delete')->name('delete')->middleware('permission:role_delete');

        // Permissions
        Route::group(['prefix' => '{role}/permissions', 'as' => 'permission.', 'controller' => PermissionController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:permission_index');
            Route::post('/update', 'update')->name('update')->middleware('permission:permission_update');
        });
    });


    Route::get('/users', [DashboardController::class, 'dashboard'])->name('users');
});
