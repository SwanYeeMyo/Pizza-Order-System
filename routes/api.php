<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//get the data
Route::get('products/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']);
//create data
Route::post('create/category', [RouteController::class, 'categoryCreate']);
//create content
Route::post('create/contact', [RouteController::class, 'createContact']);
//delete
Route::post('category/delete', [RouteController::class, 'deleteCategory']);
