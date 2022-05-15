<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PostController;
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

//SANCTUM TEMPORAL
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});
///////////////////////

Route::post('/auth/google', [GoogleController::class, 'authenticate']);

//Protected Routes by sanctum
Route::middleware(['auth:sanctum'])->prefix('api')->group(function () {
    
    Route::controller(PostController::class)->group(function () {
        Route::get('posts', 'index');
        Route::get('posts/{user}', 'getFeed');
        Route::get('posts/self/{user}', 'getPostsByUser');
        Route::post('post', 'store');
    });

    Route::get('follow/{user}', [UserController::class, 'follow']);
}); 


require __DIR__ . '/auth.php';
