<?php

// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\LeaveDayController;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [LeaveDayController::class, 'index'])->name('dashboard');
    Route::post('/apply-leave', [LeaveDayController::class, 'store'])->name('apply-leave');
});
