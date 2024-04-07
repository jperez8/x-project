<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\LeagueSplit;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Style;
use App\Models\TypeProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
            $leagueSplit = LeagueSplit::whereHas('league', fn(Builder $query) => $query->where('type_profile', $user->profile->type_profile))->inRandomOrder()->first();
            $leagueSplit->users()->attach($user, ['points' => rand(0, 99999) / 100, 'delta' => round(mt_rand() / mt_getrandmax(), 5)]);
        }

        User::factory()->admin()->create();
    }
}
