<?php

namespace App\Http\Controllers;

use App\Enums\TypeLeague;
use App\Enums\TypeProfile;
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

        $profile->type_profile = TypeProfile::cases()[rand(0, count(TypeProfile::cases()) - 1)];
        $profile->username = Str::slug($user->name, '-');
        $profile->description = 'Description example';
        $profile->profile_mini_image = $avatar;
        $profile->profile_header_image = "https://via.placeholder.com/200x200.png/00ddbb?text=nemo";
        $profile->phone = "656566565";
        $profile->fav_styles = json_encode([1,2,3,4,5]);
        $profile->fav_brands = json_encode([1,2,3,4,5]);

        return $profile;
    }
}
