<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Style;
use App\Models\TypeProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = User::factory()->count(10)->has(Profile::factory())->has(Post::factory()->count(3))->create();
        foreach ($users as $user) {
            $league = League::where('type_profile', $user->profile->type_profile)->inRandomOrder()->first();
            $league->users()->attach($user, ['points' => rand(0, 99999) / 100]);
        }

        User::factory()->admin()->create();
    }
}
