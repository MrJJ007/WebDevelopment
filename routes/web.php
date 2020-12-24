<?php

use App\Models\News;
use App\Models\ApiCall;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application\Singleton;

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

app()->singleton('App\Models\Fact',function($app){
    return new Fact('maxlength=140');
});
Route::get('example', [App\Http\Controllers\FactController::class, 'exampleMethod']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', function () {
    return view('home');
})->name('home');

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('post/{post}',[App\Http\Controllers\HomeController::class, 'show'])->name('post.show');

Route::get('multi_post/{multi_post}',[App\Http\Controllers\HomeController::class, 'multi_post_show'])->name('multi_post.show');
//Route::post('multiPost',[App\Http\Controllers\HomeController::class, 'multiPostStore'])->name('multiPost.store');
Route::get('multi_post/edit/{post}',[App\Http\Controllers\HomeController::class, 'multi_edit'])->name('mulit_post.edit');
Route::post('multi_postedit',[App\Http\Controllers\HomeController::class, 'multi_edit_store'])->name('multi_post.edit.store');
Route::get('multi_post/delete/{multi_post}',[App\Http\Controllers\HomeController::class, 'multi_delete_store'])->name('multi_post.edit');

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
