<?php

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

Route::get('/offers', [App\Http\Controllers\API\OffersController::class, 'list']);
Route::get('/offers/{id}', [App\Http\Controllers\API\OffersController::class, 'get']);

Route::get('/categories', [App\Http\Controllers\API\CategoriesController::class, 'list']);
Route::get('/categories/{id}', [App\Http\Controllers\API\CategoriesController::class, 'get']);

Route::post('/client', [App\Http\Controllers\API\ClientsController::class, 'create']);
Route::get('/client/{tid}', [App\Http\Controllers\API\ClientsController::class, 'get']);
Route::post('/client/{tid}/offer/{offer_id}', [App\Http\Controllers\API\ClientsController::class, 'takeOffer']);
Route::post('/client/{tid}/offer/{offer_id}/set/state', [App\Http\Controllers\API\ClientsController::class, 'setOfferState']);
Route::post('/client/{tid}/offer/{offer_id}/set/photo', [App\Http\Controllers\API\ClientsController::class, 'setOfferPhoto']);
Route::post('/client/{tid}/offer/{offer_id}/set/report', [App\Http\Controllers\API\ClientsController::class, 'setOfferReport']);