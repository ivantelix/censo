<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'building-list',
                'guard_name' => 'web'
            ],
            [
                'name' => 'building-search',
                'guard_name' => 'web'
            ],
            [
                'name' => 'building-create',
                'guard_name' => 'web'
            ],
            [
                'name' => 'building-update',
                'guard_name' => 'web'
            ],
        ];

        Permission::insert($permissions);
    }
}
