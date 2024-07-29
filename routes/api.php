<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\supportController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\typeController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\addressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\medicineController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\userController;
use App\Http\Controllers\orderLineController;
use App\Http\Controllers\orderController;
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
Route::get('/support',[supportController::class,'getAllMessage']);

//CATEGORY
Route::post('/category/create',[categoryController::class,'create']);
Route::get('/category/read/{id?}',[categoryController::class,'read']);
Route::post('/category/update/{id}',[categoryController::class,'update']);
Route::delete('/category/delete/{id}',[categoryController::class,'delete']);
Route::get('/category',[categoryController::class,'getAllCategory']);

//TYPE
Route::post('/type/create',[typeController::class,'create']);
Route::get('/type/read/{id?}',[typeController::class,'read']);
Route::post('/type/update/{id}',[typeController::class,'update']);
Route::delete('/type/delete/{id}',[typeController::class,'delete']);
Route::get('/type',[typeController::class,'getAllType']);

//COMPANY
Route::post('/company/create',[companyController::class,'create']);
Route::get('/company/read/{id?}',[companyController::class,'read']);
Route::post('/company/update/{id}',[companyController::class,'update']);
Route::delete('/company/delete/{id}',[companyController::class,'delete']);
Route::get('/company',[companyController::class,'getAllCompany']);



Route::post('/user/login',[AuthController::class,'login']);
Route::post('/user/register',[AuthController::class,'register']);
Route::post('/user/refresh',[AuthController::class,'refresh']);
Route::post('/user/logout',[AuthController::class,'logout']);
Route::get('/user/admins',[AuthController::class,'getAdmins']);
Route::get('/user/customers',[AuthController::class,'getCustomers']);
Route::post('/user/updateRole/{id}',[AuthController::class,'AdminRole']);
Route::delete('/user/delete/{id}',[AuthController::class,'deleteUser']);



// medicine
Route::post('/medicine/create',[medicineController::class,'addMedicine']);
Route::post('/medicine/update/{id}',[medicineController::class,'editMedicine']);
Route::get('/medicine',[medicineController::class,'getAllMedicine']);
Route::get('/medicine/{name}',[medicineController::class,'getMedicineByName']);
Route::get('/medicine/category/{category_id}',[medicineController::class,'getMedicineByCategory']);
Route::delete('/medicine/delete/{id}',[medicineController::class,'deleteMedicine']);

//ORDER
Route::post('/order/create',[orderController::class,'create']);
Route::get('/order/read/{id?}',[orderController::class,'read']);
Route::get('/orders',[orderController::class,'getAllOrder']);
Route::post('/order/status/{id}',[orderController::class,'updateStatus']);
Route::get('/order/user/{id?}',[orderController::class,'getOrderByUser']);
Route::post('/order/update/{id}',[orderController::class,'update']);
Route::delete('/order/delete/{id}',[orderController::class,'delete']);


//ORDER LINE
Route::post('/orderline/create',[orderLineController::class,'create']);
Route::get('/orderline/read/{id?}',[orderLineController::class,'read']);
Route::get('/orderline/order/{id?}',[orderLineController::class,'getLineByOrder']);
Route::post('/orderline/update/{id}',[orderLineController::class,'update']);
Route::delete('/orderline/delete/{id}',[orderLineController::class,'delete']);
