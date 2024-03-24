<?php

namespace Database\Seeders;

use App\Enums\TypeProfile;
use App\Models\League;
use App\Models\Split;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class SplitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Split::factory()->has(League::factory()->count(6)->sequence(
            [
                'name' => 'bronze',
                'slug' => 'bronze',
                'type_profile' => TypeProfile::Influencer
            ],
            [
                'name' => 'silver',
                'slug' => 'silver',
                'type_profile' => TypeProfile::Influencer
            ],
            [
                'name' => 'gold',
                'slug' => 'gold',
                'type_profile' => TypeProfile::Influencer
            ],
            [
                'name' => 'bronze',
                'slug' => 'bronze',
                'type_profile' => TypeProfile::Designer
            ],
            [
                'name' => 'silver',
                'slug' => 'silver',
                'type_profile' => TypeProfile::Designer
            ],
            [
                'name' => 'gold',
                'slug' => 'gold',
                'type_profile' => TypeProfile::Designer
            ]
        ))->create();
    }
}
