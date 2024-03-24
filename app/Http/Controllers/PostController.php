<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Style;
use App\Models\User;
use App\Services\PostUserService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();
        $posts = PostResource::collection($posts);
        return response($posts);
    }

    public function getFeed(User $user): Response
    {
        $followeds_ids = $user->followeds->modelKeys();

        if (empty($followeds_ids)) return $this->index($user->id);

        $posts = Post::whereIn('user_id', [...$followeds_ids, $user->id])->orderBy('created_at', 'DESC')->get();
        $posts = PostResource::collection($posts);

        return response($posts);
    }

    /**
     *
     * @param  \App\Models\User  $user
     * @return json
     */
    public function getPostsByUser(User $user): Response
    {
        $posts = PostResource::collection($user->posts);
        return response($posts);
    }

    /**
     *
     * @param  \App\Models\User  $user
     * @return json
     */
    public function getRandomSearch(User $user, $post_id = 0): Response
    {
        $followeds_ids = $user->followeds->modelKeys();

        $posts = Post::whereNotIn('user_id', [...$followeds_ids, $user->id])->whereIn('style_id', $user->profile->fav_styles)->whereNot('id', $post_id)->orderBy('created_at', 'DESC')->get()->shuffle();
        $posts = PostResource::collection($posts);
        return response($posts);
    }

    function getSearchByStyle(Style $style): Response
    {
        //TODO: PAGINATION
        return response($style->posts);
    }

    /*
    / validate fields before RequestPostValidator?
    */
    public function store(Request $request): Response
    {
        try {
            DB::beginTransaction();

            $post = Post::create([
                'user_id' => $request->user_id,
                'main_comment' => $request->main_comment ?? '',
                'style_id' => $request->style_id
            ]);

            foreach ($request->file('assets') ?? [] as $image) {
                $post->addMedia($image)->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })->toMediaCollection();
            }

            DB::commit();

            Log::info("Post $post->id created succesfully");
            return response($post, 201);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return response($e->getMessage(), 400);
        }
    }

    public function getFavsPosts(User $user): Response
    {
        return response($user->favs);
    }

    public function saveFavPost(User $user, Post $post): Response
    {
        $user->favs()->save($post);

        return response('ok', 201);
    }

    public function putScorePost(Post $post, Request $request)
    {

        $user = Auth::user();
        $postUserService = new PostUserService($user, $post);
        $postUserService->scorePost($request->get('score'));

        Log::info("Post $post->id scored: " .$request->get('score'));
        return response('ok', 201);
    }

    public function getScorePost(Post $post) : ?int {

        $user = Auth::user();
        $postUserService = new PostUserService($user, $post);
        return $postUserService->getScorePost();

    }
}
