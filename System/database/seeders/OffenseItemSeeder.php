<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OffenseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offenseItems = [
            [
                'offense_name' => 'Littering',
                'description' => 'Improper disposal of trash within the campus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'offense_name' => 'Disruptive Behavior',
                'description' => 'Causing disturbance in class or common areas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'offense_name' => 'Vandalism',
                'description' => 'Defacing or damaging school property',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'offense_name' => 'Cheating',
                'description' => 'Engaging in dishonest academic practices',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'offense_name' => 'Unauthorized Absence',
                'description' => 'Absent without prior notification or approval',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($offenseItems as $offense) {
            DB::table('offense_items')->insert([
                'offense_name' => $offense['offense_name'],
                'description' => $offense['description'],
                'created_at' => $offense['created_at'],
                'updated_at' => $offense['updated_at'],
            ]);
        }
    }
}
