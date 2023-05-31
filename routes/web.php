<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BuildingsController;
use App\Http\Controllers\Admin\ApartmentsController;
use App\Http\Controllers\Admin\CensosController;

Route::get('/', function () {
    return view('auth.login');
})->middleware(['guest']);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Rutas de edificios
    Route::get('/buildings', [BuildingsController::class, 'index'])->name('buildings');
    Route::get('/building/search/{id}', [BuildingsController::class, 'search'])->name('search_building');
    Route::post('/building', [BuildingsController::class, 'store'])->name('create_building');
    Route::post('/building/{building}', [BuildingsController::class, 'update'])->name('update_building');

    //Ruta de apartamentos
    Route::get('/apartments', [ApartmentsController::class, 'index'])->name('apartments');
    Route::get('/apartment/search/{id?}', [ApartmentsController::class, 'search'])->name('search_apartments');
    Route::post('/apartment', [ApartmentsController::class, 'store'])->name('create_apartment');
    Route::post('/apartment/{apartment}', [ApartmentsController::class, 'update'])->name('update_apartment');
    Route::get('/apartment/delete/{apartment}', [ApartmentsController::class, 'delete'])->name('delete_apartment');

    //Rutas de censo
    Route::get('/censos', [CensosController::class, 'show'])->name('censos');
    Route::post('/censo', [CensosController::class, 'store'])->name('store');
    Route::get('/censos/getFamily/{leader_id?}', [CensosController::class, 'getFamilyLeader'])->name('getFamilyLeader');
});
