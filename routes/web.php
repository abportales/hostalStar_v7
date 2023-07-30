<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Controla login/logout
Auth::routes();

Route::get('/', [GeneralController::class, 'index']);

Route::resource('/general', GeneralController::class);
Route::resource('/rooms', RoomController::class);
Route::resource('/rents', RentController::class);
Route::get('/general/{id}/{balance}', [GeneralController::class, 'charged'])->name('general.charged');
