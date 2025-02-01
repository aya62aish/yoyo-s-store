<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\SectionsController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
##-----------------------------------AUTH controller

Route::controller(AuthController::class)->group(function () {
   Route::post('/register', 'register');
   Route::post('/login', 'login');
    Route::post('/reset/{id}', 'reset');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

##-------------------------------------Conatact controller
Route::post('/contact', ContactController::class);

##--------------------------------------rating controller
Route::post('/rating', RatingController::class);

##-----------------------------------------sections controller
Route::get('/sections', SectionsController::class);

##-----------------------------------------category controller
Route::get('/categories', CategoryController::class);

##-----------------------------------------members controller
Route::controller(MemberController::class)->group(function () {
   Route::get('/members', 'index');
   Route::get('/member/{id}', 'show');
});