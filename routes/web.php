<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingAcceptOffer;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingImageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/email/verify', function () {
    return inertia('Auth/EmailVerify');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect()->route('listing.index')->with('success', 'Email was verified successfully!');
})->middleware(['auth', 'signed'])->name('verification.verify');
 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::resource('notification', NotificationController::class)->middleware('auth')->only(['index']);
Route::name('notification.seen')->put('notification/{notification}/seen', NotificationSeenController::class)->middleware('auth');

Route::resource('user-account', UserAccountController::class)->only(['create', 'store']);
Route::resource('listing.offer', ListingOfferController::class)->only(['store']);

Route::prefix('realtor')
->name('realtor.')
->middleware(['auth', 'verified'])
->group(function () {
    Route::name('listing.restore')->put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])->withTrashed();
    Route::resource('listing', RealtorListingController::class)
    ->only(['index', 'destroy', 'create', 'store', 'show', 'edit', 'update'])
    ->withTrashed();

    Route::name('offer.accept')->put('offer/{offer}/accept', RealtorListingAcceptOffer::class);

    Route::resource('listing.image', RealtorListingImageController::class)->only(['create', 'store', 'destroy']);
});
