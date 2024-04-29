<?php

use App\Http\Controllers\Api\admin\category;
use App\Http\Controllers\Api\GetUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\NewPasswordController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('get_user',[GetUserController::class,'get_user']);
Route::post('register',[RegisterController::class,'register']);
Route::post('login',[LoginController::class,'login']);
Route::post('forget_password' ,[NewPasswordController::class,'forget_password']);
Route::post('reset_password' ,[NewPasswordController::class,'reset_password'])->name('reset_password');
Route::post('add_category',[category::class,'add_category']);
Route::post('add_subcategory',[category::class,'add_subcategory']);
Route::get('get_category',[category::class,'get_category']);
Route::get('get_subcategory',[category::class,'get_subcategory']);







    


