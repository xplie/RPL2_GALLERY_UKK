<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthContrroller;
use App\Http\Controllers\GaleryController;
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

Route::get('/', function () {
    return view('login');
});

Route::middleware(['auth'])->group(function() {
    Route::resource('/galery', GaleryController::class);
    Route::resource('/admin', AdminController::class);
});

Route::get('/blank', [AuthContrroller::class,'blank'])->name('blank');
Route::get('/profile', [AuthContrroller::class,'profile'])->name('profile');
Route::get('/logout', [AuthContrroller::class,'logout'])->name('logout');
Route::get('/login', [AuthContrroller::class,'index'])->name('login');
Route::post('/postlogin', [AuthContrroller::class,'postlogin'])->name('postlogin');
Route::get('/register', [AuthContrroller::class,'register'])->name('register');
Route::post('/postregister', [AuthContrroller::class,'postregister'])->name('postregister');
