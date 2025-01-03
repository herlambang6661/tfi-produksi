<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'stb' => '123',
                'nickname' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('hashclaw137'),
                'role' => 'super',
                'telp' => '0',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::insert($value);
        }
    }
}
