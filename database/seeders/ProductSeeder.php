<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory(20)->create();
        $options = Option::get();
        foreach ($products as $product){
            $optionIds = $options->random(rand(1, 3))->pluck('id');
            $product->options()->attach($optionIds);
        }
    }
}
