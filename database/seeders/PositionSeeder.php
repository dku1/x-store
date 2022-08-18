<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Value;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = Position::factory(40)->create();
        foreach ($positions as $position) {
            $options = $position->product->options;
            foreach ($options as $option) {
                $values = $option->values()->pluck('id')->toArray();
                if (!empty($values)){
                    $position->values()->attach([array_rand($values)]);
                }
            }
        }
    }
}
