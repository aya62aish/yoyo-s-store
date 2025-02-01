<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

//Route::get('/', function () {
//  return view('welcome');
//});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

Route::name('admin.')->prefix(LaravelLocalization::setLocale() . '/')->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {

    Route::middleware('auth:admin')->group(function () {
//    dd('auth');


        // =================================== HOME PAGE
//        dd(Auth::check());
//        Route::view('/', 'admin.index')->name(  'index');
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::controller(SectionsController::class)->group(function () {
            Route::get('/sections', 'index')->name('sections');
            Route::post('/sections', 'store')->name('sections.store');
            Route::get('/sections/{id}', 'show')->name('sections.show');
            Route::put('/sections/edit/{id}', 'edit')->name('sections.edit');
            Route::delete('/sections/{id}', 'destroy')->name('sections.destroy');
        });
        Route::controller(CategoriesController::class)->group(function () {
            Route::get('/categories', 'index')->name('categories');
            Route::post('/categories/filter', 'filter')->name('categories.filter');
            Route::post('/categories', 'store')->name('categories.store');
            Route::get('/category/{id}', 'show')->name('categories.show');
            Route::put('/categories/update/{id}', 'update')->name('categories.update');
            Route::delete('/category/{id}', 'destroy')->name('categories.destroy');
        });
        Route::controller(MembersController::class)->group(function () {
            Route::get('/members', 'index')->name('members');
            Route::post('/members/filter', 'filter')->name('members.filter');
            Route::get('/categories/{sectionId}', 'getCategoriesBySection');
            Route::post('/members', 'store')->name('members.store');
            Route::get('/member/{id}', 'show')->name('members.show');
            Route::put('/members/update/{id}', 'update')->name('members.update');
            Route::delete('/member/{id}', 'destroy')->name('members.destroy');

        });
        Route::controller(AdsController::class)->group(function () {
            Route::get('/ads', 'index')->name('ads');
            Route::post('/ads/filter', 'filter')->name('ads.filter');
            Route::get('/categories2/{sectionId}', 'getCategoriesBySection');
            Route::get('/members/{categoryId}', 'getMemberByCategory');
            Route::get('/members/{categoryId}', 'getMemberByCategory');
            Route::post('/ads', 'store')->name('ads.store');
            Route::get('/ad/{id}', 'show')->name('ads.show');
            Route::delete('/ad/{id}', 'destroy')->name('ads.destroy');
            Route::put('/adedit/{id}', 'edit')->name('ads.edit');

        });
        Route::controller(BannersController::class)->group(function () {
            Route::get('/banners', 'index')->name('banners');
            Route::post('/banners/store', 'store')->name('banners.store');
            Route::post('/banners/update/{id}', 'update')->name('banners.update');
            Route::delete('/banners/{id}', 'destroy')->name('banners.destroy');
           Route::get('/ad/members/search','searchMembers')->name('members.search');

        });
        Route::controller(MessagesController::class)->group(function () {
            Route::get('/messages', 'index')->name('messages');
        });

        Route::controller(RatingsController::class)->group(function () {
            Route::get('/ratings', 'index')->name('ratings');

        });
        Route::controller(SettingsController::class)->group(function () {
            Route::get('/settings', 'index')->name('settings');
            Route::put('/settings', 'store')->name('setting.update');
        });
        Route::resource('users', UserController::class);
        Route::get('/admin/users/search', [UserController::class, 'search'])->name('users.search');


    });

    require __DIR__ . '/auth.php';
});

require __DIR__.'/auth.php';
