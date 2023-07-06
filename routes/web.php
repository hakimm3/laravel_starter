<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('edit', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('edit');
        Route::put('update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('update');
        Route::put('update-password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('update-password');
        Route::post('update-photo', [App\Http\Controllers\Admin\ProfileController::class, 'updatePhoto'])->name('update-photo');
    });

    Route::prefix('user-management')->as('user-management.')->group(function () {
        Route::resource('department', App\Http\Controllers\Admin\UserManagement\DepartmentController::class)->except('show', 'update', 'create');

        Route::resource('users',  App\Http\Controllers\Admin\UserManagement\UserController::class)->except('show', 'update', 'create');
        Route::get('users-restore/{id}', [App\Http\Controllers\Admin\UserManagement\UserController::class, 'restore'])->name('users.restore');
        Route::post('users-import', [App\Http\Controllers\Admin\UserManagement\UserController::class, 'import'])->name('users.import');
    });

    Route::prefix('authorization')->as('authorization.')->group(function () {
        Route::resource('role', App\Http\Controllers\Admin\Authorization\RoleController::class)->except('update', 'create');
        Route::post('role-permission/{id}', App\Http\Controllers\Admin\Authorization\RolePermissionController::class)->name('role-permission');
        Route::get('role-restore/{id}', [App\Http\Controllers\Admin\Authorization\RoleController::class, 'restore'])->name('role.restore');

        Route::resource('permission', App\Http\Controllers\Admin\Authorization\PermissionController::class)->except('show', 'update', 'create');
        Route::get('permission-restore/{id}', [App\Http\Controllers\Admin\Authorization\PermissionController::class, 'restore'])->name('permission.restore');
    });

    Route::prefix('cms')->as('cms.')->group(function () {
        Route::resource('site', App\Http\Controllers\Admin\CMS\SiteController::class)->only('index', 'store');
        Route::resource('theme', App\Http\Controllers\Admin\CMS\ThemeController::class)->only('index', 'store');

        Route::resource('slider', App\Http\Controllers\Admin\CMS\SliderController::class)->except('show', 'create');
        Route::get('slider-restore/{id}', [App\Http\Controllers\Admin\CMS\SliderController::class, 'restore'])->name('slider.restore');
    });
});
