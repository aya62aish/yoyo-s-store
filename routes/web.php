<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
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

Route::name('admin.')->prefix(LaravelLocalization::setLocale() . '/admin')->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {

    Route::middleware('auth')->group(function () {
        // =================================== HOME PAGE
        Route::view('/', 'admin.index')->name('index');

        // =================================== SERVICES
        Route::controller(ServiceController::class)->group(function () {
            Route::resource('services', ServiceController::class);
        });

        // =================================== FEATURES
        Route::controller(FeatureController::class)->group(function () {
            Route::resource('features', FeatureController::class);
        });

        // =================================== MESSAGES
        Route::controller(MessageController::class)->group(function () {
            Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
        });

        // =================================== SUBSCRIBERS
        Route::controller(SubscriberController::class)->group(function () {
            Route::resource('subscribers', SubscriberController::class)->only(['index', 'destroy']);
        });

        // =================================== TESTMONIALS
        Route::controller(TestmonialController::class)->group(function () {
            Route::resource('testmonials', TestmonialController::class);
        });

        // =================================== SETTINGS
        Route::controller(SettingController::class)->group(function () {
            Route::resource('settings', SettingController::class)->only(['index', 'update']);
        });
    });

    require __DIR__ . '/auth.php';
});

require __DIR__.'/auth.php';