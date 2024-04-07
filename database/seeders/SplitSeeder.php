<?php

namespace Database\Seeders;

use App\Enums\TypeProfile;
use App\Models\League;
use App\Models\LeagueSplit;
use App\Models\Split;
use Database\Factories\LeagueSplitFactory;
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
        $split = Split::factory()->create();

        $leagues = League::all();

        foreach ($leagues as $league) {
            LeagueSplit::factory()->state([
                'split_id' => $split->id,
                'league_id' => $league->id,
            ])->create();
        }
    }
}
