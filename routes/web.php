<?php

use \App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\UserController;

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

//Route::get('secret', function (){
//    return 'top secret INFO!';
//})->middleware('auth');

Route::resource('posts', PostController::class)
    ->except('index', 'show')
    ->middleware('auth');

Route::resource('posts', PostController::class)
    ->only('index', 'show');

Route::delete('posts/{post}/image', [PostController::class, 'deleteImage'])
    ->middleware('auth')
    ->name('posts.deleteImage');

Route::prefix('posts/{post}')
    ->middleware(['auth', 'verified'])
    ->group(function (){

        Route::resource('comments', CommentController::class)
            ->only('store');

    });

Route::resource('comments', CommentController::class)
    ->middleware(['auth', 'verified'])
    ->only('destroy');

Route::resource('users', UserController::class)
    ->only('show');

Route::get('products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('products/create', [ProductController::class, 'create'])
    ->name('products.create');

Route::post('products', [ProductController::class, 'store'])
    ->name('products.store');

Route::get('products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('products/{product}/edit', [ProductController::class, 'edit'])
    ->name('products.edit');

Route::put('products/{product}', [ProductController::class, 'update'])
    ->name('products.update');

Route::delete('products/{product}', [ProductController::class, 'destroy'])
    ->name('products.delete');
