<?php

namespace Database\Seeders;

use App\Models\Brand;

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    private $brands = ['Adidas', 'Burberry', 'Calvin Klein', 'Chanel', 'Gucci', 'H&M (Hennes & Mauritz)', 'Hugo Boss', 'Levis', 'Louis Vuitton', 'Nike', 'Prada', 'Ralph Lauren', 'Tommy Hilfiger', 'Under Armour', 'Versace', 'Zara', 'Armani', 'Balenciaga', 'Fendi', 'Puma', 'Reebok', 'Saint Laurent', 'The North Face', 'Victorias Secret', 'Ralph Lauren', 'Vans', 'Converse', 'New Balance', 'ASOS' ];
    
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
