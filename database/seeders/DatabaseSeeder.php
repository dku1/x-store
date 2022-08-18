<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            OptionSeeder::class,
            ValueSeeder::class,
            ProductSeeder::class,
            PositionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ReviewSeeder::class,
            SubscriptionSeeder::class,
            CurrencySeeder::class,
            CouponSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
