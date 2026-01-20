<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ThingController;
use App\Http\Controllers\API\PlaceController;
use App\Http\Controllers\API\ArchiveController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('things', ThingController::class)->names('api.things');

    Route::apiResource('places', PlaceController::class)->names('api.places');

    Route::get('/archive', [ArchiveController::class, 'index'])->name('api.archive.index');
    Route::patch('/archive/{archive}/restore', [ArchiveController::class, 'restore'])->name('api.archive.restore');
});