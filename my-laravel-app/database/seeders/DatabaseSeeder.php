<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'User',
            'adresse' => '123 Admin St',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'company_name' => null,
            'phone_number' => '123456789',
            'role' => 'admin',
        ]);

        User::create([
            'firstname' => 'Employee',
            'lastname' => 'User',
            'adresse' => '456 Employee St',
            'email' => 'employee@example.com',
            'password' => bcrypt('emp123'),
            'company_name' => null,
            'phone_number' => '987654321',
            'role' => 'employee',
        ]);

        User::create([
            'firstname' => 'Client',
            'lastname' => 'User',
            'adresse' => '789 Client Ave',
            'email' => 'client@example.com',
            'password' => bcrypt('client123'),
            'company_name' => 'cli',
            'phone_number' => '1122334455',
            'role' => 'client',
        ]);
    }
}
