<?php

namespace Database\Seeders;

use App\Models\Profile;
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
        
        User::factory()->count(10)->has(Profile::factory()->state(new Sequence(
            fn ($sequence) => ['type_profile_id' => TypeProfile::all()->random()],
        )), 'profile')->hasPosts(5)->create();
        User::factory()->admin()->create();
    }
}
