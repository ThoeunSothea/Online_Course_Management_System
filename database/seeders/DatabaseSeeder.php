<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);


        User::create([
        'role_id' => 1, // admin role
        'username' => 'testuser', // Use username instead of name
        'email' => 'test@example.com',
        'password' => bcrypt('12345678'),
        'email_verified_at' => now(),
]);
    }
}
