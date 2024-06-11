<?php

use App\Http\Controllers\Api\cleanup\companyController;
use App\Http\Controllers\Api\cleanup\reviewController;
use App\Http\Controllers\Api\cleanup\UserLocationController;
use App\Http\Controllers\Api\EmailverificationController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\recycle\sendRequestController;
use App\Http\Controllers\Api\recycle\showresult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;



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
   Route::post('/register'    ,[RegisterController::class , 'register']); 
   Route::post('/login'       ,[LoginController::class , 'login']); 
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

 







    


