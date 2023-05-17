<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrador',
                'guard_name' => 'web'
            ],
        ];

        Role::insert($roles);

        $permissions = Permission::all();
        $role = Role::first();

        $role->syncPermissions($permissions);

    }
}
