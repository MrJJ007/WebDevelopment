<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', function () {
    return view('home');
})->name('home');

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('post/{post}',[App\Http\Controllers\HomeController::class, 'show'])->name('post.show');

Route::get('multi_post/{multi_post}',[App\Http\Controllers\HomeController::class, 'multi_post_show'])->name('multiPost.show');
//Route::post('multiPost',[App\Http\Controllers\HomeController::class, 'multiPostStore'])->name('multiPost.store');

Route::get('post/edit/{post}',[App\Http\Controllers\HomeController::class, 'edit'])->name('post.edit');
Route::post('postedit',[App\Http\Controllers\HomeController::class, 'editStore'])->name('post.edit.store');


Route::get('createp',[App\Http\Controllers\HomeController::class, 'create'])->name('post.create');
Route::post('post',[App\Http\Controllers\HomeController::class, 'store'])->name('post.store');

Route::post('comment',[App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
Route::post('multi_comment',[App\Http\Controllers\CommentController::class, 'multi_store'])->name('multi.comment.store');

Route::get('comment/edit/{comment}',[App\Http\Controllers\CommentController::class, 'edit'])->name('comment.edit');
Route::post('commentedit',[App\Http\Controllers\CommentController::class, 'editStore'])->name('comment.edit.store');


Route::get('post/delete/{post}',[App\Http\Controllers\HomeController::class, 'deleteStore'])->name('post.edit');
Route::get('comment/delete/{comment}',[App\Http\Controllers\CommentController::class, 'deleteStore'])->name('comment.delete');

Route::get('email',[App\Http\Controllers\MailController::class, 'sendNewCommentEmail'])->name('email');
