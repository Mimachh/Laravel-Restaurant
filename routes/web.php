<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PlatController;
use App\Http\Controllers\Admin\AllergeneController;

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
})->name('welcome');

Route::get('/home', function () {
    return view('home');
});


Route::get('redirects', 'App\Http\Controllers\HomeController@index');


// ROUTE SUPER ADMIN
Route::group(["middleware" => ['auth', 'role:1'], "prefix" => "admin", "as" => "admin."], function() {
    
    Route::group(["prefix" => "users", "as" => "users."], function() {
        Route::get('/', [UserController::class, 'index'])->name('index');

        // Create
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');

        // Edit
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');

        // Système de suppression
        Route::delete('/destroy-multiple', [UserController::class, 'destroyMultiple'])->name('destroy-multiple');
        Route::get('/trash', [UserController::class, 'trash'])->name('trash');
        Route::delete('/force-destroy-multiple', [UserController::class, 'forceDestroyMultiple'])->name('force-destroy-multiple');

        // Restore
        Route::post('/restore-multiple', [UserController::class, 'restoreMultiple'])->name('restore-multiple');
    });

});

// ROUTE POUR LES AUTEURS

Route::group(["middleware" => ['auth', 'role:1,2,3'], "prefix" => "admin", "as" => "admin."], function() {
    
    // PLATS
    Route::group(["prefix" => "plats", "as" => "plats."], function() {
        Route::get('/', [PlatController::class, 'index'])->name('index');

        // Create
        Route::get('/create', [PlatController::class, 'create'])->name('create');
        Route::post('/', [PlatController::class, 'store'])->name('store');

        // Edit
        Route::get('/{id}/edit', [PlatController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PlatController::class, 'update'])->name('update');

        // Système de suppression
        Route::delete('/destroy-multiple', [PlatController::class, 'destroyMultiple'])->name('destroy-multiple');
        Route::get('/trash', [PlatController::class, 'trash'])->name('trash');
        Route::delete('/force-destroy-multiple', [PlatController::class, 'forceDestroyMultiple'])->name('force-destroy-multiple');

        // Restore
        Route::post('/restore-multiple', [PlatController::class, 'restoreMultiple'])->name('restore-multiple');
    });

    // ALLERGENES
    Route::group(["prefix" => "allergenes", "as" => "allergenes."], function() {
        Route::get('/', [AllergeneController::class, 'index'])->name('index');

        // Create
        Route::get('/create', [AllergeneController::class, 'create'])->name('create');
        Route::post('/', [AllergeneController::class, 'store'])->name('store');

        // Edit
        Route::get('/{id}/edit', [AllergeneController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AllergeneController::class, 'update'])->name('update');

        // Système de suppression
        Route::delete('/destroy-multiple', [AllergeneController::class, 'destroyMultiple'])->name('destroy-multiple');
        Route::get('/trash', [AllergeneController::class, 'trash'])->name('trash');
        Route::delete('/force-destroy-multiple', [AllergeneController::class, 'forceDestroyMultiple'])->name('force-destroy-multiple');

        // Restore
        Route::post('/restore-multiple', [AllergeneController::class, 'restoreMultiple'])->name('restore-multiple');
    });

});

Route::middleware(['auth', 'role:1'])->group(function () {
    
    // Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');

    // Create
    // Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    // Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');

    // Edit
    // Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    // Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');


    // Système de suppression
    // Route::delete('/admin/users/destroy-multiple', [UserController::class, 'destroyMultiple'])->name('admin.users.destroy-multiple');
    // Route::get('/admin/users/trash', [UserController::class, 'trash'])->name('admin.users.trash');
    // Route::delete('/admin/users/force-destroy-multiple', [UserController::class, 'forceDestroyMultiple'])->name('admin.users.force-destroy-multiple');

    // Restore
    // Route::post('/admin/users/restore-multiple', [UserController::class, 'restoreMultiple'])->name('admin.users.restore-multiple');

});

Route::middleware(['auth', 'role:1,2,3,4'])->group(function () {

    // Pour le dasboard admin

});

Route::group(['middleware' => 'auth'], function() {
    // Route pour tous les rôles à part user
    Route::group([
        'middleware' => 'role:1,2,3,4', 
        'prefix' => 'admin',
        'name' => 'admin.',
        'as' => 'admin.'
    ], function() {
        Route::get('/dashboard', function() {
            return view('admin.dashboard');
        })->name('dashboard');
    });
    
});


