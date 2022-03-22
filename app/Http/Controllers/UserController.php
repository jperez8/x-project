<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user->load(['profile', 'posts', 'profile.typeProfile']);

        return response(json_encode($user));
    }
}
