<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PassportAuthController;

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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

// La page où on présente les liens de redirection vers les providers
Route::get("login-register", "SocialiteController@loginRegister");

// La redirection vers le provider
Route::get("redirect/{provider}", "SocialiteController@redirect")->name('socialite.redirect');

// Le callback du provider
Route::get("callback/{provider}", "SocialiteController@callback")->name('socialite.callback');

Route::middleware('auth:api')->group(function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    Route::resource('property', PropertyController::class)->except(['create', 'edit']);
    Route::resource('contact', ContactController::class)->except(['create', 'edit']);
    Route::resource('favorite', FavoriteController::class)->except(['create', 'edit']);
    Route::resource('search', SearchController::class)->except(['create', 'edit']);
});

