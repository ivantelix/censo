<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildings = [
            [
                'name' => 'Bloque 01',
            ],
            [
                'name' => 'Bloque 02'
            ],
            [
                'name' => 'Bloque 03'
            ]
        ];

        Building::insert($buildings);
    }
}
