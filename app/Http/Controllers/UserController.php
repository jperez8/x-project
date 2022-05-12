<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     *
     * @param  \App\User  $user
     * @return String
     */
    public function follow(User $user)
    {
        try {
            /** @var User $user_logged */
            $user_logged = Auth::user();

            Log::info("User $user->id request to follow $user_logged->id");

            $user_logged->followers()->save($user);

            return 'ok';
        } catch (Exception $e) {
            Log::error($e);
            return 'error';
        }
    }
}
