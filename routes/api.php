<?php

use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\LocationsController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\OtpCheck;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SectionsController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
##-----------------------------------AUTH controller

Route::controller(AuthController::class)->group(function () {
   Route::post('/register', 'register');
   Route::post('/login', 'login');
    Route::post('/forgot', 'forgot');
    Route::post('/reset', 'reset')->middleware('auth:sanctum');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

##-----------------------------------Otp controller
Route::post('/OtpCheck', [OtpCheck::class,'check'])->middleware('auth:sanctum');
Route::post('/SendOtp', [OtpCheck::class,'send'])->middleware('auth:sanctum');

##-----------------------------------------language controller
Route::get('/language/{id}', [LanguageController::class,'index']);
Route::post('/languagepost/{id}',[LanguageController::class,'store']);

##-----------------------------------------locations controller
Route::get('/locations', LocationsController::class);

##-----------------------------------------sections controller
Route::get('/sections', SectionsController::class);

##-----------------------------------------category controller
Route::get('/categories', CategoryController::class);

##-----------------------------------------members controller
Route::controller(MemberController::class)->group(function () {
    Route::get('/members', 'index');
    Route::get('/members/favourite', 'favourite');
    Route::get('/member/{id}', 'show');
    Route::post('/member/favourites/{id}', 'favourites');
    Route::post('member/rate/{id}', 'rate');
});

##-----------------------------------------ads controller
Route::prefix('ads')->controller(AdsController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/banners', 'banners');

});

##-------------------------------------Conatact controller
Route::post('/contact', ContactController::class);

##--------------------------------------rating controller
Route::post('/rating', RatingController::class);


##-------------------------------------search controller
Route::post('/search', [SearchController::class, 'search']);
