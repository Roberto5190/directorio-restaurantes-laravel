<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\RestaurantWebController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [RestaurantWebController::class, 'index']);
Route::resource('restaurants', RestaurantWebController::class)
      ->only(['index','show','create','store','edit','update','destroy'])
      ->middleware(['auth'])->except(['index','show']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
