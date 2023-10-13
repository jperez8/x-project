<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_valid_post_succesfull()
    {
        $user = User::first();
        $main_comment = "Test comment";
        $style_id = 5;

        Storage::fake('public');

        $file = UploadedFile::fake()->image('photo.jpg');
        $fileName = $file->hashName();

        $response = $this->actingAs($user)
            ->post('/api/post', [
            'image' => $file,
            'user_id' => $user->id,
            'main_comment' => $main_comment,
            'style_id' => $style_id
        ]);

        $response->assertSuccessful();
        Storage::disk('public')->assertExists('post_images/'.$fileName);

        $this->assertDatabaseHas('posts', [
            'main_comment' => 'Test comment',
            'style_id' => $style_id,
            'user_id' => $user->id
        ]);
    }


    //TODO: GET RANDOM SEARCH BY FAV_STYLES & FAV_BRANDS
}
