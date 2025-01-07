<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArnelServiceController;
use App\Http\Controllers\WooOrdersController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/arnel', [ArnelServiceController::class, 'readProductsView']);
Route::post('/arnel', [ArnelServiceController::class, 'updateProductView']);
Route::delete('/arnel/{id}', [ArnelServiceController::class, 'deleteProductView']);
Route::post('/arnel/store', [ArnelServiceController::class, 'createProductView']); 



Route::group(['prefix' => 'woo-orders'], function( ) {  
    Route::get('/', [WooOrdersController::class, 'wooOrdersViewIndex']);
    Route::post('/', [WooOrdersController::class, 'updateProductViewIndex']);
    // Route::get('/get-order-by-order-id/{order_id}', [WooOrdersController::class, 'getOrderByOrderID']);
    // Route::get('/search-order/{search?}', [WooOrdersController::class, 'searchOrderWeb']);
    Route::post('/create', [WooOrdersController::class, 'addOrderView']);
    // Route::put('/{order_id}', [WooOrdersController::class, 'updateOrder']);
    Route::delete('/{order_id}', [WooOrdersController::class, 'deleteOrderView']);
});