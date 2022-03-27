<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        return $this->getUserData($request->user);
    }


    /**
     *
     * @param  \App\User  $user
     * @return json
     */
    public function getUserData(User $user)
    {
        $user->load(['profile', 'posts', 'profile.typeProfile']);

        return response(json_encode($user), 200);
    }
}
