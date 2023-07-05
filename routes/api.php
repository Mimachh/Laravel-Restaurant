<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\JourController;
use App\Http\Controllers\Public\FermetureController;
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

// Route::middleware('auth:sanctum')->get('/users/{user}', function (Request $request) {
//     return $request->user();
// });


// ROUTE UTILISATEUR
Route::middleware('api')->group(function () {
    Route::get('/jours', [JourController::class, 'index']);
    Route::get('/jours/{id}/opening-hours', [JourController::class, 'getOpeningHours']);
    Route::get('/jours/{id}/{service}/creneaux', [JourController::class, 'getCreneaux']);


    Route::get('/fermeture', [FermetureController::class, 'index']);
});

