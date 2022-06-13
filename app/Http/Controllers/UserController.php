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
    public function follow(User $user_logged, User $user_request)
    {
        try {
            Log::info("User $user_request->id request to follow $user_logged->id");

            $user_logged->followeds()->save($user_request);

            return 'ok';
        } catch (Exception $e) {
            Log::error($e);
            abort(500, $e);
        }
    }
}
