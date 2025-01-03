<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArnelServiceController;

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