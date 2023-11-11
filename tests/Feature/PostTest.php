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

        $image1 = UploadedFile::fake()->image('photo1.jpg');
        $image2 = UploadedFile::fake()->image('photo2.jpg');
        $image3 = UploadedFile::fake()->image('photo3.jpg');

        $response = $this->actingAs($user)
            ->post('/api/post', [
            'images' => [$image1, $image2, $image3],
            'user_id' => $user->id,
            'main_comment' => $main_comment,
            'style_id' => $style_id
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('posts', [
            'main_comment' => 'Test comment',
            'style_id' => $style_id,
            'user_id' => $user->id
        ]);


        $this->assertDatabaseCount('media', 3);
    }


    //TODO: GET RANDOM SEARCH BY FAV_STYLES & FAV_BRANDS
}
