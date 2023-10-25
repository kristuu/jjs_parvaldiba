<?php

use App\Http\Controllers\Api\RegionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('regions', [RegionController::class, 'index']);
Route::post('regions', [RegionController::class, 'store']);
Route::get('region/{id}', [RegionController::class, 'findByID']);
Route::get('region/{id}/edit', [RegionController::class, 'edit']);
Route::put('region/{id}/edit', [RegionController::class, 'update']);
Route::delete('region/{id}/delete', [RegionController::class, 'delete']);
