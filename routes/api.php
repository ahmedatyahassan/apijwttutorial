<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['prefix'=>'/'], function(){
    Route::post('register', [UserAuthController::class, 'register']);
    Route::get('login', [UserAuthController::class, 'login']);
});


Route::group(['prefix'=>'/admin'], function(){
    Route::get('/login', [AdminAuthController::class, 'login']);
    Route::post('/register', [AdminAuthController::class, 'register']);
});


// All Available Routes for Users
Route::group(['prefix'=> '/', 'middleware' => 'authForAll:api'], function () {
    Route::get('categories', [CategoryController::class, 'index']);

});

// All Available Routes for Users & Admins
Route::group(['prefix'=> '/shared', 'middleware' => ['authForAll:api&admin']], function(){
    Route::get('/categories', [CategoryController::class, 'index']);
});

// Available Routes Admins
Route::group(['prefix'=> '/admin', 'middleware' => 'authForAll:admin'], function () {
    Route::post('/category', [CategoryController::class, 'create']);
    Route::get('/users', [UserController::class, 'index']);
});