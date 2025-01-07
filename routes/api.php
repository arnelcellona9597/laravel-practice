<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimsController;
use App\Http\Controllers\ArnelCustomProductsController;
use App\Http\Controllers\StudentController;

// use App\Components\Services\Arnel\IArnelService;
// use App\Components\Services\Arnel\IProductService;

use App\Http\Controllers\OrderController;

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

Route::group(['middleware' => 'auth.very_basic'], function() {
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

    Route::prefix('arnel-custom-products')->group(function () {
        Route::post('/trigger-post-api', [ArnelCustomProductsController::class, 'triggerPOSTAPI']); // Create
        Route::post('/', [ArnelCustomProductsController::class, 'store']); // Create
        Route::get('/', [ArnelCustomProductsController::class, 'index']); // Read all
        Route::get('/{id}', [ArnelCustomProductsController::class, 'show']); // Read one
        Route::put('/{id}', [ArnelCustomProductsController::class, 'update']); // Update
        Route::delete('/{id}', [ArnelCustomProductsController::class, 'destroy']); // Delete
    });

    Route::group(['prefix' => 'students'], function() { 

        Route::post('/enroll-subject/{id}', [StudentController::class, 'enrollSubject']);
        Route::post('/create', [StudentController::class, 'createStudent']);
        Route::put('/edit/{id}', [StudentController::class, 'editStudent']);
        Route::get('/', [StudentController::class, 'getAllStudents']);
        Route::get('/{id}', [StudentController::class, 'getStudentById']);
        Route::delete('/delete/{id}', [StudentController::class, 'deleteStudent']);
    });

    Route::group(['prefix' => 'subjects'], function( ) {  
        Route::post('/create', [StudentController::class, 'addSubjects']);
        Route::post('/create-student-subject/{id}', [StudentController::class, 'addSubjectToStudent']);
    });

    Route::group(['prefix' => 'arnel-service'], function( ) {  
        Route::get('/', [\App\Http\Controllers\ArnelServiceController::class, 'getData']);
        Route::get('/products', [\App\Http\Controllers\ArnelServiceController::class, 'getProducts']);
        Route::post('/products', [\App\Http\Controllers\ArnelServiceController::class, 'createProduct']);
        Route::get('/products/{id}', [\App\Http\Controllers\ArnelServiceController::class, 'getProduct']);
        Route::put('/products/{id}', [\App\Http\Controllers\ArnelServiceController::class, 'updateProduct']);
        Route::delete('/products/{id}', [\App\Http\Controllers\ArnelServiceController::class, 'deleteProduct']);
    });    

    Route::post('/orders', [OrderController::class, 'store']);

    Route::group(['prefix' => 'woo-orders'], function( ) {  
        Route::get('/', [\App\Http\Controllers\WooOrdersController::class, 'getOrders']);
        Route::get('/get-order-by-order-id/{order_id}', [\App\Http\Controllers\WooOrdersController::class, 'getOrderByOrderID']);
        Route::get('/search-order/{search}', [\App\Http\Controllers\WooOrdersController::class, 'searchOrder']);
        Route::post('/', [\App\Http\Controllers\WooOrdersController::class, 'addOrder']);
        Route::put('/{order_id}', [\App\Http\Controllers\WooOrdersController::class, 'updateOrder']);
        Route::delete('/{order_id}', [\App\Http\Controllers\WooOrdersController::class, 'deleteOrder']);
    });  
    
});






