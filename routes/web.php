<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StyleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;


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
    return ['Laravel' => app()->version()];
});

Route::post('/auth/google', [GoogleController::class, 'authenticate']);

//Protected Routes by sanctum
Route::middleware(['auth:sanctum', 'throttle:api'])->prefix('api')->group(function () {
    
    Route::controller(PostController::class)->group(function () {
        Route::get('posts', 'index');
        Route::get('posts/{user}', 'getFeed');
        Route::get('posts/unfollowed/{user}/{post_id?}', 'getRandomSearch');
        Route::get('posts/self/{user}', 'getPostsByUser');
        Route::post('post', 'store');
        Route::get('posts/favs/{user}', 'getFavsPosts');
        Route::post('post/{user}/save/{post}', 'saveFavPost');
    });

    Route::controller(UserController::class)->group(function () {
        Route::post('follow/{user_logged}/{user_request}', 'follow');
        Route::get('user/{user}', 'show');
        Route::get('user/search/{payload}', 'searchBy');
    });

    Route::get('style/search/{payload}', [StyleController::class, 'searchBy']);
    
}); 


require __DIR__ . '/auth.php';


