<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostUserScore;
use App\Models\User;

class PostUserService
{
    public function __construct(private User $user, private Post $post){}

    public function scorePost(int $score): PostUserScore
    {
        $postUserScore = PostUserScore::updateOrCreate([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id
        ], [
            'score' => $score
        ]);

        return $postUserScore;
    }

    public function getScorePost(): ?int
    {
        return PostUserScore::where('user_id', $this->user->id)->where('post_id', $this->post->id)->pluck('score')->first();
    }
}
