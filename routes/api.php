<?php

use App\Http\Controllers\AddProductController;
use App\Http\Controllers\DeleteProductController;
use App\Http\Controllers\DeleteUser;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\LoadAvatarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
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
Route::get("/all_users", [UserOutputController::class, 'all']);
Route::get('/user/{id}', [UserOutputController::class, 'index']);
Route::get('/view/{id}', [UserOutputController::class, 'get']);
Route::post('/addFriend', [FriendsController::class, 'addFriend']);

Route::get('/friends/{id}', [FriendsController::class, 'index']);