<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_like_post_succesfully()
    {
        $user = User::find(2);
        $post = Post::first();

        $response = $this->actingAs($user)->post(route('like', ['post_id' => $post->id]));

        $response->assertSuccessful();
        $this->assertDatabaseHas('likes', ['user_id' => $user->id, 'post_id' => $post->id]);
    }

    public function test_unlike_post_succesfully()
    {
        $user = User::find(2);
        $post = Post::first();

        $response = $this->actingAs($user)->post(route('like', ['post_id' => $post->id]));

        $response->assertSuccessful();
        $this->assertDatabaseHas('likes', ['user_id' => $user->id, 'post_id' => $post->id]);

        $response = $this->actingAs($user)->post(route('like', ['post_id' => $post->id]));
        $response->assertSuccessful();
        $this->assertDatabaseMissing('likes', ['user_id' => $user->id, 'post_id' => $post->id]);
    }
}
