<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CollectionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('documents', DocumentController::class);
        Route::resource('collections', CollectionController::class);
        Route::resource('tags', TagController::class);
        Route::resource('users', UserController::class);
        Route::resource('languages', LanguageController::class);
        Route::resource('locations', LocationController::class);
        Route::resource('creators', CreatorController::class);
        Route::resource('searches', SearchController::class);
    });
