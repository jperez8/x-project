<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     *
     * @param  \App\User  $user
     * @return json
     */
    public function getProfileDataByUser(User $user)
    {   
        /** @var User $user */
        return response(json_encode($user->posts), 200);
    }
}
