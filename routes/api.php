<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CreatorController;
use App\Http\Controllers\Api\EditionController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\CollectionController;
use App\Http\Controllers\Api\DocumentTagsController;
use App\Http\Controllers\Api\TagDocumentsController;
use App\Http\Controllers\Api\UserActivitiesController;
use App\Http\Controllers\Api\DocumentEditionsController;
use App\Http\Controllers\Api\DocumentCreatorsController;
use App\Http\Controllers\Api\CreatorDocumentsController;
use App\Http\Controllers\Api\DocumentLanguagesController;
use App\Http\Controllers\Api\DocumentLocationsController;
use App\Http\Controllers\Api\LanguageDocumentsController;
use App\Http\Controllers\Api\LocationDocumentsController;
use App\Http\Controllers\Api\DocumentActivitiesController;
use App\Http\Controllers\Api\DocumentCollectionsController;
use App\Http\Controllers\Api\CollectionDocumentsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('documents', DocumentController::class);

        // Document Editions
        Route::get('/documents/{document}/editions', [
            DocumentEditionsController::class,
            'index',
        ])->name('documents.editions.index');
        Route::post('/documents/{document}/editions', [
            DocumentEditionsController::class,
            'store',
        ])->name('documents.editions.store');

        // Document Activities
        Route::get('/documents/{document}/activities', [
            DocumentActivitiesController::class,
            'index',
        ])->name('documents.activities.index');
        Route::post('/documents/{document}/activities', [
            DocumentActivitiesController::class,
            'store',
        ])->name('documents.activities.store');

        // Document Languages
        Route::get('/documents/{document}/languages', [
            DocumentLanguagesController::class,
            'index',
        ])->name('documents.languages.index');
        Route::post('/documents/{document}/languages/{language}', [
            DocumentLanguagesController::class,
            'store',
        ])->name('documents.languages.store');
        Route::delete('/documents/{document}/languages/{language}', [
            DocumentLanguagesController::class,
            'destroy',
        ])->name('documents.languages.destroy');

        // Document Tags
        Route::get('/documents/{document}/tags', [
            DocumentTagsController::class,
            'index',
        ])->name('documents.tags.index');
        Route::post('/documents/{document}/tags/{tag}', [
            DocumentTagsController::class,
            'store',
        ])->name('documents.tags.store');
        Route::delete('/documents/{document}/tags/{tag}', [
            DocumentTagsController::class,
            'destroy',
        ])->name('documents.tags.destroy');

        // Document Locations
        Route::get('/documents/{document}/locations', [
            DocumentLocationsController::class,
            'index',
        ])->name('documents.locations.index');
        Route::post('/documents/{document}/locations/{location}', [
            DocumentLocationsController::class,
            'store',
        ])->name('documents.locations.store');
        Route::delete('/documents/{document}/locations/{location}', [
            DocumentLocationsController::class,
            'destroy',
        ])->name('documents.locations.destroy');

        // Document Collections
        Route::get('/documents/{document}/collections', [
            DocumentCollectionsController::class,
            'index',
        ])->name('documents.collections.index');
        Route::post('/documents/{document}/collections/{collection}', [
            DocumentCollectionsController::class,
            'store',
        ])->name('documents.collections.store');
        Route::delete('/documents/{document}/collections/{collection}', [
            DocumentCollectionsController::class,
            'destroy',
        ])->name('documents.collections.destroy');

        // Document Creators
        Route::get('/documents/{document}/creators', [
            DocumentCreatorsController::class,
            'index',
        ])->name('documents.creators.index');
        Route::post('/documents/{document}/creators/{creator}', [
            DocumentCreatorsController::class,
            'store',
        ])->name('documents.creators.store');
        Route::delete('/documents/{document}/creators/{creator}', [
            DocumentCreatorsController::class,
            'destroy',
        ])->name('documents.creators.destroy');

        Route::apiResource('collections', CollectionController::class);

        // Collection Documents
        Route::get('/collections/{collection}/documents', [
            CollectionDocumentsController::class,
            'index',
        ])->name('collections.documents.index');
        Route::post('/collections/{collection}/documents/{document}', [
            CollectionDocumentsController::class,
            'store',
        ])->name('collections.documents.store');
        Route::delete('/collections/{collection}/documents/{document}', [
            CollectionDocumentsController::class,
            'destroy',
        ])->name('collections.documents.destroy');

        Route::apiResource('tags', TagController::class);

        // Tag Documents
        Route::get('/tags/{tag}/documents', [
            TagDocumentsController::class,
            'index',
        ])->name('tags.documents.index');
        Route::post('/tags/{tag}/documents/{document}', [
            TagDocumentsController::class,
            'store',
        ])->name('tags.documents.store');
        Route::delete('/tags/{tag}/documents/{document}', [
            TagDocumentsController::class,
            'destroy',
        ])->name('tags.documents.destroy');

        Route::apiResource('users', UserController::class);

        // User Activities
        Route::get('/users/{user}/activities', [
            UserActivitiesController::class,
            'index',
        ])->name('users.activities.index');
        Route::post('/users/{user}/activities', [
            UserActivitiesController::class,
            'store',
        ])->name('users.activities.store');

        Route::apiResource('languages', LanguageController::class);

        // Language Documents
        Route::get('/languages/{language}/documents', [
            LanguageDocumentsController::class,
            'index',
        ])->name('languages.documents.index');
        Route::post('/languages/{language}/documents/{document}', [
            LanguageDocumentsController::class,
            'store',
        ])->name('languages.documents.store');
        Route::delete('/languages/{language}/documents/{document}', [
            LanguageDocumentsController::class,
            'destroy',
        ])->name('languages.documents.destroy');

        Route::apiResource('locations', LocationController::class);

        // Location Documents
        Route::get('/locations/{location}/documents', [
            LocationDocumentsController::class,
            'index',
        ])->name('locations.documents.index');
        Route::post('/locations/{location}/documents/{document}', [
            LocationDocumentsController::class,
            'store',
        ])->name('locations.documents.store');
        Route::delete('/locations/{location}/documents/{document}', [
            LocationDocumentsController::class,
            'destroy',
        ])->name('locations.documents.destroy');

        Route::apiResource('creators', CreatorController::class);

        // Creator Documents
        Route::get('/creators/{creator}/documents', [
            CreatorDocumentsController::class,
            'index',
        ])->name('creators.documents.index');
        Route::post('/creators/{creator}/documents/{document}', [
            CreatorDocumentsController::class,
            'store',
        ])->name('creators.documents.store');
        Route::delete('/creators/{creator}/documents/{document}', [
            CreatorDocumentsController::class,
            'destroy',
        ])->name('creators.documents.destroy');

        Route::apiResource('editions', EditionController::class);

        Route::apiResource('activities', ActivityController::class);
    });
