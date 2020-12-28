<?php

use App\Http\Controllers\Broadcast;
use App\Models\News;
use App\Models\Fact;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application\Singleton;


app()->singleton('App\Models\Fact',function($app){
    return new Fact('maxlength=140');
});
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


// app()->singleton('App\Controllers\BroadcastController',function($app){
//     $user = new User;
//     return new Broadcast($user);
// });
Route::get('example', [App\Http\Controllers\FactController::class, 'exampleMethod']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//creating posts in general
Route::get('createp',[App\Http\Controllers\PostCreationController::class, 'create'])->name('post.create');
Route::post('post',[App\Http\Controllers\PostCreationController::class, 'store'])->name('post.store');

//functions about multi posts
Route::get('multi_post/{multi_post}',[App\Http\Controllers\MultiPostController::class, 'multi_post_show'])->name('multi_post.show');
Route::get('multi_post/edit/{post}',[App\Http\Controllers\MultiPostController::class, 'multi_edit'])->name('mulit_post.edit');
Route::post('multi_postedit',[App\Http\Controllers\MultiPostController::class, 'multi_edit_store'])->name('multi_post.edit.store');
Route::get('multi_post/delete/{multi_post}',[App\Http\Controllers\MultiPostController::class, 'multi_delete_store'])->name('multi_post.edit');

//functions about basic posts
Route::get('post/{post}',[App\Http\Controllers\BasicPostController::class, 'show'])->name('post.show');
Route::get('post/edit/{post}',[App\Http\Controllers\BasicPostController::class, 'edit'])->name('post.edit');
Route::post('postedit',[App\Http\Controllers\BasicPostController::class, 'edit_store'])->name('post.edit.store');
Route::get('post/delete/{post}',[App\Http\Controllers\BasicPostController::class, 'delete_store'])->name('post.edit');

//about comment creation
Route::post('comment',[App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
Route::post('multi_comment',[App\Http\Controllers\CommentController::class, 'multi_store'])->name('multi.comment.store');
//functions about comments
Route::get('comment/edit/{comment}',[App\Http\Controllers\CommentController::class, 'edit'])->name('comment.edit');
Route::post('commentedit',[App\Http\Controllers\CommentController::class, 'editStore'])->name('comment.edit.store');
Route::get('comment/delete/{comment}',[App\Http\Controllers\CommentController::class, 'deleteStore'])->name('comment.delete');

//all about email
Route::get('email',[App\Http\Controllers\MailController::class, 'sendNewCommentEmail'])->name('email');
Route::get('notification',[App\Http\Controllers\MessageController::class, 'send'])->name('notification');
//all about upvotes
Route::get('post/upvote/{post}',[App\Http\Controllers\UpVoteController::class, 'post_up_vote'])->name('post.up.vote');
Route::get('multi_post/upvote/{multi_post}',[App\Http\Controllers\UpVoteController::class, 'multi_post_up_vote'])->name('multi.post.up.vote');
Route::get('comment/upvote/{comment}',[App\Http\Controllers\UpVoteController::class, 'comment_up_vote'])->name('comment.up.vote');

Route::get('test',function(){
    event(new App\Events\StatusLiked('Someone'));
    return "yes";
})->name('test');
