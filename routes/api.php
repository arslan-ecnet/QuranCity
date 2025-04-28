<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SuraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function () {
    Route::post('/', [AuthController::class, 'auth']);
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('surah', [SuraController::class, 'index']);
    Route::post('bookmark', [SuraController::class, 'bookmark']);
});

