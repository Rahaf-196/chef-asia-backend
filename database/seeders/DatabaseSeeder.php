<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Chef Asia',
            'email' => 'Rshn123@chefasia.com',
            'password' => Hash::make('124578369'),
            'role' => 'admin',
        ]);

        // Seed categories and products from combined seeder
        $this->call(ProductAndCategorySeeder::class);
    }
}
