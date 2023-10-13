<?php

namespace Database\Seeders;

use App\Models\Style;
use Illuminate\Database\Seeder;

class StyleSeeder extends Seeder
{
    private $styles = ['Boho', 'Hipster', 'Trendy', 'Casual', 'Artsy', 'Clasico', 'Exotico', 'Glamoroso'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Style::factory()
            ->count(count($this->styles))
            ->sequence(fn ($sequence) =>
                ['name' => $this->styles[$sequence->index]],
            )
            ->create();
    }
}
