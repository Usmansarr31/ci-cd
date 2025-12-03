<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('produits', App\Http\Controllers\ProduitsController::class);
