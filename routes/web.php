<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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


//POST ROUTES
Route::get('/posts', [PostController::class, 'index']);

//USER ROUTE
Route::get('/users/{user}', [UserController::class, 'show']);

//GOOGLE ROUTES
Route::post('/auth/google', [GoogleController::class, 'authenticate']);

Route::get('csrf', function() {
    return csrf_token(); 
});

