<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function authenticate(Request $request)
    {
        $googleUser = Socialite::driver('google')->stateless()->userFromToken($request->token);

        /** @var User $user */
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);

        Log::info("User $user->email logged in");

        $user->load('profile.typeProfile');

        return response(json_encode([
            'user' => $user,
            'bearer_token' => $user->createToken($request->device_name)->plainTextToken
        ]), 201);
    }
}
