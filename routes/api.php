<?php

use App\Http\Controllers\Api\businessesController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
https: //api.yelp.com/v3/businesses/search?location=us&sort_by=best_match&limit=20
Route::post('/business', [businessesController::class, 'store']);
Route::put('/business', [businessesController::class, 'update']);
Route::delete('/business', [businessesController::class, 'delete']);
Route::get('/business', [businessesController::class, 'fetchAllData']);
Route::get('/business/search={field}={keyword}&sort_by={sortBy}&limit={limit}', [businessesController::class, 'fetchDataByParams']);
