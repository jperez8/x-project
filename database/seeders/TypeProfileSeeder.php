<?php

namespace Database\Seeders;

use App\Models\TypeProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = TypeProfile::TYPES;

        foreach ($types as $type) {
            DB::table('type_profiles')->insert([
                'name' => "$type",
                'description' => "$type profile",
            ]);
        }
    }
}
