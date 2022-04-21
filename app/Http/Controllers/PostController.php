<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = collect(Post::with(['user.profile'])->get());

        return response(json_encode($posts->random(10)), 200);
    }

    public function store(Request $request)
    {

        try {            
            $path = $request->image->store('post_images', 'public');

            $post = Post::create([
                'user_id' => $request->user_id,
                'main_comment' => $request->main_comment,
                'image' => $path,
            ]);

            Log::info("Post $post->id created succesfully");
            
            $response = (object) ['success' => true, $post];
            
            return response(json_encode($response), 201);

        } catch (Exception $e) {
            Log::error($e);
            $res = (object) ['error' => true, 'message' => $e];
            return response(json_encode($res), 500);
        }
    }
}
