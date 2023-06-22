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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('profile')->as('profile.')->middleware('auth')->group(function () {
    Route::get('edit', [App\Http\Controllers\Backend\ProfileController::class, 'edit'])->name('edit');
    Route::put('update', [App\Http\Controllers\Backend\ProfileController::class, 'update'])->name('update');
});


