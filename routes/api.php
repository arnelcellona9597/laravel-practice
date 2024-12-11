<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimsController;
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

// Route::group(['middleware' => 'auth.very_basic'], function() {
    // Route::post('/import-products',  [MiddlelayerController::class, 'importProducts']); 
    // Route::post('/import-replications',  [MiddlelayerController::class, 'importReplication']); 
    // Route::post('/import-image',  [MiddlelayerController::class, 'importImage']); 
    // Route::get('/image/{filename}',  [MiddlelayerController::class, 'getImage']); 
    // Route::post('/delete',  [MiddlelayerController::class, 'deleteProducts']); 
    
    // Route::group(['prefix' => 'webhook'], function() {
    //     // Route::post('/order',  [OrderController::class, 'salesOrder']);
    //     Route::post('/process-order',  [OrderController::class, 'processOrder']);   
    // });
    
    Route::group(['prefix' => 'sims'], function() {
        Route::get('/stock-codes',  [SimsController::class, 'GetStockCodes']); 
        Route::get('/stock-detail',  [SimsController::class, 'GetStockDetail']); 
        Route::get('/stock-detail-by-style',  [SimsController::class, 'GetStockDetailByStyle']); 
        Route::get('/stock-detail-by-replication-id',  [SimsController::class, 'GetStockDetailByReplicationId']);
        Route::get('/stock-images',  [SimsController::class, 'GetStockImages']); 
        Route::get('/stock-location-info',  [SimsController::class, 'GetStockLocationInfo']); 
        Route::post('/import-sales-order',  [SimsController::class, 'ImportSalesOrder']); 
        Route::post('/import-transactions',  [SimsController::class, 'ImportTransactions']); 
        Route::get('/stock-categories',  [SimsController::class, 'GetStockCategories']); 
        Route::get('/stock-detail-by-barcode',  [SimsController::class, 'GetStockDetailByBarcode']); 
        Route::get('/latest-replication-id',  [SimsController::class, 'GetLatestReplicId']); 
    });

// });