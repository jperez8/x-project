<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user->load(['profile.typeProfile']);

        return $user->setAppends(['num_followers', 'num_followeds']);
    }

    public function searchBy(string $payload = '')
    {
        $result = User::where('name', 'like', "%$payload%")
            ->orWhereHas('profile', fn ($q) => $q->where('username', 'like', "%$payload%"))
            ->get();
        return response($result);
    }

    public function follow(User $user_logged, User $user_request)
    {
        try {
            Log::info("User $user_request->id request to follow $user_logged->id");

            $user_logged->followeds()->save($user_request);

            return response('ok', 201);
        } catch (Exception $e) {
            Log::error($e);
            abort(500, $e);
        }
    }

    function retrieve()
    {
        //CAMBIAR POR ID BUENO
        $user = User::find(10);
        $user->load('profile');

        return response(json_encode([
            'user' => $user,
            'bearer_token' => $user->createToken('iphone15')->plainTextToken
        ]), 200);
    }
}
