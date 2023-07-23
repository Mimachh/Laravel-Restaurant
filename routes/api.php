<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\JourController;
use App\Http\Controllers\Public\FermetureController;
use App\Http\Controllers\Api\CouvertsrestantsController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Public\AlcoolController;
use App\Http\Controllers\Public\DessertController;
use App\Http\Controllers\Public\EntreeController;
use App\Http\Controllers\Public\PlatController;
use App\Http\Controllers\Public\SoftController;
use App\Http\Controllers\Public\VinController;

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

    // Différentes informations sur les jours
    Route::get('/jours', [JourController::class, 'index']);
    Route::get('/jours/{id}/opening-hours', [JourController::class, 'getOpeningHours']);
    Route::get('/jours/{id}/{service}/creneaux', [JourController::class, 'getCreneaux']);
    Route::get('/jours/{id}/{service}/couverts', [JourController::class, 'calcGuestWithCouverts']);

    // Récupérer le nombre de couverts restants
    Route::get('/jours/{nom}/couverts_restants', [CouvertsrestantsController::class, 'couvertsRestants']);

    // Information sur la fermeture du restaurant
    Route::get('/fermeture', [FermetureController::class, 'index']);


    // Post du formulaire
    Route::post('/reservation', [ReservationController::class, 'store']);



    // Route pour afficher les différents plats dans la section carte
    Route::get('/entrees', [EntreeController::class, 'index']);
    Route::get('/plats', [PlatController::class, 'index']);
    Route::get('/desserts', [DessertController::class, 'index']);
    Route::get('/alcools', [AlcoolController::class, 'index']);
    Route::get('/softs', [SoftController::class, 'index']);
    Route::get('/vins', [VinController::class, 'index']);
});

