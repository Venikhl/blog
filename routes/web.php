<?php

use \App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\CommentController;

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

Route::redirect('/', 'posts')
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

Route::get('secret', function (){
    return 'top secret INFO!';
})->middleware('auth');

Route::resource('posts', PostController::class)
    ->except('index', 'show')
    ->middleware('auth');

Route::resource('posts', PostController::class)
    ->only('index', 'show');

Route::prefix('posts/{post}')
    ->middleware('auth')
    ->group(function (){

        Route::resource('comments', CommentController::class)
            ->only('store');

    });

Route::resource('comments', CommentController::class)
    ->middleware('auth')
    ->only('destroy');
