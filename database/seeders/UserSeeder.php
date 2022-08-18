<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $role_id = Role::where('value', 'admin')->first()->id;
        User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@mail.ru',
            'city' => 'admin city',
            'address' => 'admin address',
            'index' => 777777,
            'role_id' => $role_id,
            'email_verified_at' => now(),
            'password' => Hash::make(12345678),
            'remember_token' => Str::random(10),
        ]);
    }
}
