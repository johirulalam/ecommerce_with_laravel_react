<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\SubCategoryController;
use App\Http\Controllers\Admin\Product\VariationController;
use App\Http\Controllers\Admin\Product\VariationOptionController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\HomeController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/', [HomeController::class, 'homepage']);
Route::get('/products', [HomeController::class, 'products']);
Route::get('/products/{slug}', [HomeController::class, 'singleProduct']);
Route::get('/category/{slug}', [HomeController::class, 'categoryProduct']);
Route::post('admin/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum', 'namespace' => '','prefix' => '/admin', 'as' => 'admin.'], function () {
    Route::resource('products', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('variations', VariationController::class);
    Route::resource('variation_options', VariationOptionController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});
