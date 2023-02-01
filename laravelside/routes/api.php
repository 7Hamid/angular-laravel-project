<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get all products
Route::get('products',[ProductController::class,'getProduct']);
//get product by id
Route::get('product/{id}',[ProductController::class,'getProductById']);
//add product
Route::post('addProduct',[ProductController::class,'addProduct']);
//upddate product by id
Route::put('updateProduct/{id}',[ProductController::class,'updateProduct']);
//delete product by id
Route::delete('deleteProduct/{id}',[ProductController::class,'deleteProduct']);

//user routes
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);

//search Routes
Route::get('products',[ProductController::class,'products']);
Route::get('products/search_product',[ProductController::class,'searchProduct']);
Route::get('download/{id}',[ProductController::class,'download']);
