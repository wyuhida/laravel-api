<?php

use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * buyers
 */
Route::resource('buyers', BuyerController::class)->only('index','show');

/**
 * Categories
 */

 Route::resource('categories',CategoryController::class)->except('create','edit');

 /**
  * Products
  */
  Route::resource('products', ProductController::class)->only('index','show');

  /**
   * Sellers
   */
Route::resource('sellers',SellerController::class)->only('index','show');

/**
 * Transactions
 */
Route::resource('transactions',TransactionController::class)->only('index','show');
/**
 * Users
 */
Route::resource('users',UserController::class)->except('create','edit');
