<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('id', '>', 45)->orderBy('id', 'DESC')->get();

        return response($posts);
    }

    public function getFeed(User $user)
    {
        $followeds_ids = $user->followeds->map(fn ($f) => $f->id);

        if(!count($followeds_ids) > 0) return $this->index();

        $posts = Post::whereIn('user_id', [...$followeds_ids, $user->id])->orderBy('created_at', 'DESC')->get();

        return response($posts);
    }

    /**
     *
     * @param  \App\User  $user
     * @return json
     */
    public function getPostsByUser(User $user)
    {
        /** @var User $user */
        Log::info("User coming $user->id");
        return response(json_encode($user->posts), 200);
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
