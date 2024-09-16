<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('courses_tables')->insert([
            [
                'campus_id' => 'Makati',
                'code' => 'IT123',
                'name' => 'Information Technology',
                'is_offered' => 1,
            ],
            [
                'campus_id' => 'Makati',
                'code' => 'CS123',
                'name' => 'Computer Science',
                'is_offered' => 1,
            ],
            [
                'campus_id' => 'Manila',
                'code' => 'IT123',
                'name' => 'Information Technology',
                'is_offered' => 0,
            ],
            [
                'campus_id' => 'Laguna',
                'code' => 'CS123',
                'name' => 'Computer Science',
                'is_offered' => 1,
            ],
        ]);
    }
}
