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
    public function index($user_id)
    {
        $posts = Post::where('user_id', '<>', $user_id)->orderBy('created_at', 'DESC')->get();

        info($posts);
        
        return response($posts);
    }

    public function getFeed(User $user)
    {
        $followeds_ids = $user->followeds->modelKeys();

        if(empty($followeds_ids)) return $this->index($user->id);

        $posts = Post::whereIn('user_id', [...$followeds_ids, $user->id])->orderBy('created_at', 'DESC')->get();

        return response($posts);
    }

    /**
     *
     * @param  \App\Models\User  $user
     * @return json
     */
    public function getPostsByUser(User $user)
    {
        /** @var User $user */
        Log::info("User coming $user->id");
        return response(json_encode($user->posts));
    }

    /**
     *
     * @param  \App\Models\User  $user
     * @return json
     */
    public function getRandomSearch(User $user)
    {
        $followeds_ids = $user->followeds->modelKeys();

        if(empty($followeds_ids)) return $this->index($user->id);

        $posts = Post::whereNotIn('user_id', [...$followeds_ids, $user->id])->orderBy('created_at', 'DESC')->get();

        return $posts;
    }

    /*TODO: Refactor inyect post dependency
    / validate fields before RequestPostValidator?
    */
    public function store(Request $request)
    {

        try {
            $image_path = $request->image->store('post_images', 'public');

            $post = Post::create([
                'user_id' => $request->user_id,
                'main_comment' => $request->main_comment,
                'image' => $image_path,
            ]);

            Log::info("Post $post->id created succesfully");

            $response = ['success' => true, $post];

            return response($response, 201);
        } catch (Exception $e) {
            Log::error($e);
            $res = (object) ['error' => true, 'message' => $e];
            return response(json_encode($res), 500);
        }
    }
}
