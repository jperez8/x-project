<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function authenticate(Request $request)
    {
        $googleUser = Socialite::driver('google')->stateless()->userFromToken($request->token);

        info(json_encode($googleUser));

        /** @var User $user */
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);

        if(!$user->profile) $user->profile()->save($this->generateNewProfile($user, $googleUser->avatar));

        Log::info("User $user->email logged in");

        $user->load('profile.typeProfile');

        return response(json_encode([
            'user' => $user,
            'bearer_token' => $user->createToken($request->device_name)->plainTextToken
        ]), 201);
    }
    
    private function generateNewProfile(User $user, String $avatar): Profile
    {
        $profile = new Profile();

        $profile->type_profile_id = rand(1,3);
        $profile->username = Str::slug($user->name, '-');
        $profile->description = 'Description example';
        $profile->profile_mini_image = $avatar;
        $profile->profile_header_image = "https://via.placeholder.com/200x200.png/00ddbb?text=nemo";
        $profile->phone = "656566565";
        
        return $profile;
    }
}
