<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name"=> "Administrador",
            "email"=> "cmarrerodb@gmail.com",
            "password"=> bcrypt("Aa123456*"),
        ])->assignRole('Admin');
        User::factory(10)->create();
    }
}
