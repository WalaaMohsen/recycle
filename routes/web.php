<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgetPasswordController;
use Illuminate\Support\Facades\Route;

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
Route::get('/index',[Controller::class,'index'])->name('index');
Route::get('/getregister',[RegisterController::class,'create'])->name('getregister');
Route::post('/register',[RegisterController::class,'store'])->name('store');
Route::get('/getlogin',[LoginController::class,'getlogin'])->name('getlogin');
Route::post('/login',[LoginController::class,'login'])->name('login');
Route::get('/forget',[ForgetPasswordController::class,'forget'])->name('forget');
Route::post('/forget_password',[ForgetPasswordController::class,'forget_password'])->name('forget_password');
Route::get('/reset/{token}',[ForgetPasswordController::class,'reset'])->name('reset');
Route::post('/reset',[ForgetPasswordController::class,'post_reset'])->name('post_reset');







