<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
    // Run the role seeder first
    $this->call(RoleSeeder::class);

    // Create an admin user
    User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@admin.com',
        'role' => User::$admin, // Make sure this constant exists
        'password' => Hash::make("Admin123@")
    ]);
}

}
