<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PostController;

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

//GOOGLE ROUTES
Route::post('/auth/google', [GoogleController::class, 'authenticate']);

Route::get('csrf', function() {
    return csrf_token(); 
});


require __DIR__ . '/auth.php';
