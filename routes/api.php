<?php

use App\Http\Controllers\AddProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DeleteProductController;
use App\Http\Controllers\DeleteUser;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoadAvatarController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserOutputController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => 'auth:sanctum'], function(){
//     Route::post('/load-avatar', '\App\Http\Controllers\LoadAvatarController');
// });

Route::post('/load-avatar', [LoadAvatarController::class, 'store']);
Route::post('/changeInfoUser', [UserOutputController::class, 'changeInfoUser']);
Route::post('/dataOrder', [UserOutputController::class, 'dataOrder']);
Route::post('/dop_info', [UserOutputController::class, 'dop_info']);
Route::get('/all_users', [UserOutputController::class, 'all_users']);
Route::get("/five_users", [UserOutputController::class, 'random_five']);
Route::get('/user/{id}', [UserOutputController::class, 'index']);
Route::get('/view/{id}', [UserOutputController::class, 'get']);
Route::post('/user_ban/{id}', [UserOutputController::class, 'user_ban']);
Route::post('/user_unban/{id}', [UserOutputController::class, 'user_unban']);

Route::post('/addFriend', [FriendsController::class, 'addFriend']);
Route::get('/friends/{id}', [FriendsController::class, 'index']);
Route::post('/friends/accept/{id}', [FriendsController::class, 'accept_friend']);
Route::post('/friends/delete/{id}', [FriendsController::class, 'delete_friend']);
Route::post('/friends/block/{id}', [FriendsController::class, 'block_friend']);

Route::get('/all_posts', [PostsController::class, 'all']);
Route::post('/add_post', [PostsController::class, 'add_post']);
Route::get('/user_post', [PostsController::class, 'posts_user']);
Route::get('/posts_user_view/{id}', [PostsController::class, 'posts_user_view']);
Route::post('/delete_post/{id}', [PostsController::class, 'delete_post']);
Route::post('/edit_post/{id}', [PostsController::class, 'edit_post']);

Route::get('/output_comm', [CommentController::class, 'output_comm']);
Route::post('/add_comm', [CommentController::class, 'add_comm']);
Route::post('/del_comm/{id}', [CommentController::class, 'del_comm']);

Route::post('/likes/create',[LikeController::class, 'store']);
Route::delete('/likes/{id}/delete', [LikeController::class, 'destroy']);

Route::get('/rooms', [RoomController::class, 'all']);

Route::get('/rooms/{id}/messages', [MessageController::class, 'all']);
Route::get('/messages/{id}',[MessageController::class, 'getMessages']);
Route::post('/messages/create', [MessageController::class, 'store']);

Route::get('/category', [CategoryController::class, 'all']);
Route::post('/add_category', [CategoryController::class, 'add_category']);
Route::post('/delete_category/{id}', [CategoryController::class, 'delete_category']);