<?php

use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\API\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

    Route::resource('movie', MovieController::class);
    Route::resource('genre', GenreController::class);
    Route::get('movie/{id}/active', [MovieController::class, 'activateMovie']);


