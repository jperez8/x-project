<?php

namespace Database\Seeders;

use App\Models\Brand;

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    private $brands = ['Zara', 'Nike', 'Reebok', 'Polo', 'Burberry', 'Balenciaga', 'Gucci', 'Kenzo'];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory() 
            ->count(count($this->brands))
            ->sequence(fn ($sequence) => 
                ['name' => $this->brands[$sequence->index]],
            )
            ->create();
    }
}
