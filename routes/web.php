<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;

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

Route::get("/", [IndexController::class, "index"]);
Route::get("/hello", [IndexController::class, "show"]);

Route::resource('listing', ListingController::class)->only(['show','index']);

// user authentication
Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)->only(['create', 'store']);

Route::prefix('realtor')
->name('realtor.')
->middleware('auth')
->group(function () {
    Route::resource('listing', RealtorListingController::class)->only(['index', 'destroy', 'create', 'store', 'show', 'edit', 'update']);
});