<?php

use \App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;

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

//Route::get('/', [HomeController::class, 'index'])
//    ->name('index');
//
//Route::get('form', [HomeController::class, 'form'])
//    ->name('form');
//
//Route::post('form', [HomeController::class, 'handle'])
//    ->name('form.handle');

//Route::get('hello/{id}', function ($id) {
//    return "<h1>ID => {$id}</h1>";
//})->where('id', '[0-9]+');

Route::get('/', [HomeController::class, 'index'])
    ->name('index');

Route::get('posts', [PostController::class, 'index'])
    ->name('post.index');

Route::get('posts/create', [PostController::class, 'create'])
    ->name('post.create');

Route::post('posts', [PostController::class, 'store'])
    ->name('posts.store');

Route::get('posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');

Route::get('posts/{post}/edit', [PostController::class, 'edit'])
    ->name('posts.edit');

Route::put('posts/{post}', [PostController::class, 'update'])
    ->name('posts.update');

Route::delete('posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.delete');
