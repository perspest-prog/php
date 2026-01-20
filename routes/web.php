<?php

use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThingController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\UsageController;

Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register'])->name('register.process');

Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('things', ThingController::class);
Route::resource('places', PlaceController::class);

Route::get('/archive', [ArchiveController::class, 'index'])->name('archive.index');
Route::put('/archive/{archive}', [ArchiveController::class, 'update'])->name('archive.update');

Route::get('/usages/create', [UsageController::class, 'create'])->name('usages.create');
Route::post('/usages/create', [UsageController::class, 'store'])->name('usages.store');