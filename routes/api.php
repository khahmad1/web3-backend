<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\supportController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\typeController;
use App\Http\Controllers\companyController;
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

//SUPPORT
Route::post('/support/create',[supportController::class,'create']);
Route::get('/support/read/{id?}',[supportController::class,'read']);
Route::post('/support/update/{id}',[supportController::class,'update']);
Route::delete('/support/delete/{id}',[supportController::class,'delete']);

//CATEGORY
Route::post('/category/create',[categoryController::class,'create']);
Route::get('/category/read/{id?}',[categoryController::class,'read']);
Route::post('/category/update/{id}',[categoryController::class,'update']);
Route::delete('/category/delete/{id}',[categoryController::class,'delete']);

//TYPE
Route::post('/type/create',[typeController::class,'create']);
Route::get('/type/read/{id?}',[typeController::class,'read']);
Route::post('/type/update/{id}',[typeController::class,'update']);
Route::delete('/type/delete/{id}',[typeController::class,'delete']);

//COMPANY
Route::post('/company/create',[companyController::class,'create']);
Route::get('/company/read/{id?}',[companyController::class,'read']);
Route::post('/company/update/{id}',[companyController::class,'update']);
Route::delete('/company/delete/{id}',[companyController::class,'delete']);

//ROLE
Route::post('/company/create',[companyController::class,'create']);
Route::get('/company/read/{id?}',[companyController::class,'read']);
Route::post('/company/update/{id}',[companyController::class,'update']);
Route::delete('/company/delete/{id}',[companyController::class,'delete']);