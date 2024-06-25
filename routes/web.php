<?php

use App\Http\Controllers\ArasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataKriteriaController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::middleware(['auth', 'checkuserstatus'])->group(function () {
    // Route::get('/', [PostController::class, 'index'])->name('index');
    // Route::resource('post', PostController::class)->except('index', 'edit', 'destroy', "show");
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
    Route::get('/delete/{id}', [PostController::class, 'destroy'])->name('delete');
    Route::resource('/datasiswa', DataSiswaController::class);
    Route::resource('/datakriteria', DataKriteriaController::class);

    Route::get('/penilaian', [ArasController::class, 'penilaian'])->name('penilaian.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/aras', [ArasController::class, 'index'])->name('aras.index');
});
