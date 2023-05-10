<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => 'qwe',
            'email' => 'qwe@gmail.com',
            'password' => bcrypt('qweqwe')
        ];

        User::create($user);
    }
}
