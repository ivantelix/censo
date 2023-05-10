<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BuildingsController;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Rutas de edificios
    Route::get('buildings', [BuildingsController::class, 'index'])->name('buildings');

});
