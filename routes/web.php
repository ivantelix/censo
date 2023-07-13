<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BuildingsController;
use App\Http\Controllers\Admin\ApartmentsController;
use App\Http\Controllers\Admin\CensosController;
use App\Http\Controllers\Admin\UsersController;

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
    Route::get('/search', [CensosController::class, 'search'])->name('search');
    Route::get('/generate/{dni}', [CensosController::class, 'generate'])->name('generate');

    //Rutas de usuarios
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::post('/user', [UsersController::class, 'store'])->name('user');
    Route::get('/user/search/{id}', [UsersController::class, 'search'])->name('search_user');
    Route::post('/user/{user}', [UsersController::class, 'update'])->name('update_user');
    Route::get('/user/delete/{user}', [UsersController::class, 'delete'])->name('delete_user');
});

Route::get('recover-password', [UsersController::class, 'recoverPassword'])->name('recover_password');
Route::post('recover-password', [UsersController::class, 'sendRecoverPassword'])->name('send_recover_password');
Route::post('confirm-reset-password', [UsersController::class, 'resetPassword'])->name('confirm_reset_password');
