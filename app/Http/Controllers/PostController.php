<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = collect(Post::with(['user', 'user.profile'])->get());

        return response(json_encode($posts->random(10)), 200);
    }
}
