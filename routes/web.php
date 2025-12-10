<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

Route::get('/', [MainController::class, 'index']);
Route::get('/full_image/{img}', [MainController::class, 'show']);

Route::resource('/article', ArticleController::class)->middleware('auth:sanctum');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('article.show')->middleware('stat', 'auth:sanctum');

//Auth
Route::get('/auth/signin', [AuthController::class, 'signin']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/authenticate', [AuthController::class, 'authenticate']);
Route::get('/auth/logout', [AuthController::class, 'logout']);

//Main
Route::get('/', [MainController::class, 'index']);
Route::get('/full_image/{img}', [MainController::class, 'show']);

Route::get('/about', function () {
    return view('main.about');
});

Route::controller(CommentController::class)->prefix('comment')->group(function () {
    Route::get('/', 'index') -> name('comment.index');
    Route::post('/', 'store');
    Route::get('/edit/{comment}', 'edit');
    Route::put('/update/{comment}', 'update') -> name('comment.update');
    Route::get('/delete/{comment}', 'delete');
    Route::get('/accept/{comment}', 'accept');
    Route::get('/reject/{comment}', 'reject');
});

# Страница контактов
Route::get('/contacts', function () {
    $array[] = [
        'name' => 'MosPolytech 1',
        'address' => 'Bolshaya Semenovskaya',
        'email' => 'q@mospoly.ru',
        'phone' => '+7 (910) 950 13-28',
    ];

    $array[] = [
        'name' => 'MosPolytech 2',
        'address' => 'Bolshaya Semenovskaya',
        'email' => 'q@mospoly.ru',
        'phone' => '+7 (910) 950 13-28',
    ];
    $array[] = [
        'name' => 'MosPolytech 3',
        'address' => 'Bolshaya Semenovskaya',
        'email' => 'q@mospoly.ru',
        'phone' => '+7 (910) 950 13-28',
    ];

    return view('main.contacts', ['contacts' => $array]);
});
