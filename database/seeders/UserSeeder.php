<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'demo@example.com',
            'password' => 'demo',
            'role' => 'CS',
            'email_verified_at' => Carbon::now(),
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'demo2@example.com',
            'password' => 'demo2',
            'role' => 'Supervisi',
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
