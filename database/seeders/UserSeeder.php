<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    // Run the database seeds.

    public function run(): void
    {
        User::factory()->count(5)->create(['user_type' => 'teacher']);
        User::factory()->count(50)->create(['user_type' => 'student']);
    }
}
