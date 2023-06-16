<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;

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


//user controller
Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login');
Route::post('/register' , [UserController::class , 'register'])->middleware('guest');
Route::post('/login' ,[UserController::class, 'login'] )->middleware('guest') ;
Route::post('/logout' ,[UserController::class, 'logout'] )->middleware('mustBeLogedIn');


//post controller
Route::get('/create-post'  , [PostController::class , 'showNewPostPage'])->middleware('mustBeLogedIn');
Route::post('/create-post' , [PostController::class , 'createNewPost'])->middleware('mustBeLogedIn');
Route::get('/post/{post}'  , [PostController::class , 'showSinglePost']);

//profile related routes
Route::get('/profile-posts/{user:username}', [ProfileController::class,'showProfilePosts'])->middleware('guest');
Route::delete('/post/{post}', [ProfileController::class,'deletePost'])->middleware('can:delete,post');
Route::get('/post/{post}/edit',[ProfileController::class,'updateFromPage'])->middleware('can:update,post');
Route::put('/post/{post}/edit',[ProfileController::class,'editPost'])->middleware(('can:update,post'));
Route::get('/manage-avatar/{user:username}',[ProfileController::class,'maganeAvatarFromPage'])->middleware('guest');
Route::post('/manage-avatar/{user:username}',[ProfileController::class,'storeAvatar'])->middleware('guest');

//follow related routes

Route::post('/follow-user/{user:username}',[FollowController::class,'followUser'])->middleware('mustBeLogedIn');
Route::post('/unfollow-user/{user:username}',[FollowController::class,'unfollowUser'])->middleware('mustBeLogedIn');