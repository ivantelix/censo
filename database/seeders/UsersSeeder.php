<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
            'password' => bcrypt('qweqwe'),
            'role_id' => Role::find(1)->id
        ];

        User::create($user);
    }
}
