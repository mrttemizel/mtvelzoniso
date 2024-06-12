<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'role' => User::ROLE_SUPER_ADMIN,
                'name' => 'Murat TEMİZEL',
                'email' => 'murat.temizel@antalya.edu.tr',
                'password' => '$2y$10$AOClkj6hL0p..zy/KdWe9eN71KWdQqZuoVXkuwt4Y2hS4dQ9t9bWK',
            ],
            [
                'role' => User::ROLE_SUPER_ADMIN,
                'name' => 'Oğuz Topçu',
                'email' => 'oguz.topcu@antalya.edu.tr',
                'password' => bcrypt('admin*!!')
            ]
        ];

        foreach ($admins as $admin) {
            if (User::query()->where('email', $admin['email'])->first()) {
                continue;
            }

            User::query()->create($admin);
        }
    }
}
