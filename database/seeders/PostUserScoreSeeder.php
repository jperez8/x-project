<?php

namespace Database\Seeders;

use App\Models\PostUserScore;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostUserScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        foreach ($user->posts as $posts) {
            $randomUser = User::whereNotIn('id', [$user->id])->inRandomOrder()->first();
            PostUserScore::insert([
                'user_id' => $randomUser->id,
                'post_id' => $posts->id,
                'score' => rand(1, 10)
            ]);
        }
    }
}
