<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\admin\category;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\AntikaController;
use App\Http\Controllers\Api\GetUserController;
use App\Http\Controllers\Api\recycle\showresult;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\NewPasswordController;
use App\Http\Controllers\Api\cleanup\reviewController;
use App\Http\Controllers\Api\cleanup\companyController;
use App\Http\Controllers\Api\EmailverificationController;
use App\Http\Controllers\Api\recycle\sendRequestController;
use App\Http\Controllers\Api\cleanup\UserLocationController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
 });

Route::prefix('users')->group(function(){
   Route::get('get_user',[GetUserController::class,'get_user']);
   Route::post('edit_profile',[GetUserController::class,'edit_user_info']);
   Route::post('/register'    ,[RegisterController::class , 'register']); 
   Route::post('/login'       ,[LoginController::class , 'login']); 
   Route::post('forget_password' ,[NewPasswordController::class,'forget_password']);
   Route::post('reset_password' ,[NewPasswordController::class,'reset_password'])->name('reset_password');
   Route::get('/logout'       ,[LoginController::class , 'logout_all_devices']); 
   Route::post('/sendcode'    ,[EmailverificationController::class , 'sendcode']); 
   Route::post('/checkcode'   ,[EmailverificationController::class , 'checkcode']); 
   Route::prefix('/recycle')->group(function(){
      Route::get('/showtotalresult'   ,[showresult::class , 'showtotalresult']); 
      Route::get('/showresultforuser'   ,[showresult::class , 'showresultforuser']); 
      Route::post('/sendrequest' ,[sendRequestController::class , 'sendrequest']); 
   });
   Route::prefix('/cleanup')->group(function(){
      Route::post('/sendreview/{id}' ,[reviewController::class , 'sendreview']); 
      Route::get('/showreview/{id}' ,[reviewController::class , 'showreview']); 
      Route::post('/Userlocation' ,[UserLocationController::class , 'Userlocation']); 
      Route::post('/createcompany' ,[companyController::class , 'createcompany']); 
      Route::get('/getcompany' ,[companyController::class , 'getcompany']); 
      Route::get('/getcompanylocation/{id}' ,[companyController::class , 'getcompanylocation']); 
   });

});
   
   Route::post('add_category',[category::class,'add_category']);
   Route::post('add_subcategory',[category::class,'add_subcategory']);
   Route::get('get_category',[category::class,'get_category']);
   Route::get('get_subcategory',[category::class,'get_subcategory']);
   Route::post('/add_antika', [AntikaController::class, 'new_antika']);
   Route::get('/show_antika', [AntikaController::class, 'show_all_products']);
   Route::get('/show_vaza', [AntikaController::class, 'show_vaza']);
   Route::get('/show_camera', [AntikaController::class, 'show_camera']); 
   Route::get('/show_coin', [AntikaController::class, 'show_coin']);
   Route::get('/show_jewelry', [AntikaController::class, 'show_jewelry']);
   Route::get('/show_typewriter', [AntikaController::class, 'show_typewriter']);
   Route::post('/updateDesc/{id}', [AntikaController::class, 'updateDesc']);



 


   Route::prefix('/dashbord')->group(function(){
      Route::prefix('/antika')->group(function(){
         Route::get('/create' ,[AntikaController::class , 'create_antika']); 
         Route::post('/store' ,[AntikaController::class , 'store_antika']); 
         Route::get('/edit/{id}' ,[AntikaController::class , 'edit_antika']); 
         Route::post('/update/{id}' ,[AntikaController::class , 'update_antika']); 
         Route::delete('/delete/{id}' ,[AntikaController::class , 'delete_antika']); 
         
      });
      Route::prefix('/company')->group(function(){
         Route::get('/create' ,[companyController::class , 'create_company']); 
         Route::post('/store' ,[companyController::class , 'store_company']); 
         Route::get('/edit/{id}' ,[companyController::class , 'edit_company']); 
         Route::post('/update/{id}' ,[companyController::class , 'update_company']); 
         Route::delete('/delete/{id}' ,[companyController::class , 'delete_company']); 
         
      });
      Route::prefix('/users')->group(function(){
         Route::get('/edit/{id}' ,[GetUserController::class , 'edit_user']); 
         Route::post('/update/{id}' ,[GetUserController::class , 'update_user']); 
         Route::delete('/delete/{id}' ,[GetUserController::class , 'delete_user']); 
         
      });
   });




    


