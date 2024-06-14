<?php

use App\Http\Controllers\ArasController;
use App\Http\Controllers\DataKriteriaController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::resource('post', PostController::class)->except('index', 'edit', 'destroy', "show");
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
    Route::get('/delete/{id}', [PostController::class, 'destroy'])->name('delete');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('/datasiswa', DataSiswaController::class);
    Route::resource('/datakriteria', DataKriteriaController::class);
    Route::get('/aras', [ArasController::class, 'index'])->name('aras.index');
});
