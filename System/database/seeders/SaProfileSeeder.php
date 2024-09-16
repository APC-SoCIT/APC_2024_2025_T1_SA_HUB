<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('sa_profiles')->insert([
            [
                'user_id' => 111,
                'first_name' => 'Jose',
                'last_name' => 'Mercado',
                'middle_initial' => 'M',
                'gender' => 'Male',
                'contact_number' => 639198887654,
                'birth_date' => '1997-04-28',
                'birth_place' => 'Davao City, Philippines',
                'course_program' => 'BS Electronics Engineering',
            ],
            [
                'user_id' => 115,
                'first_name' => 'Alexander',
                'last_name' => 'Reyes',
                'middle_initial' => 'T',
                'gender' => 'Male',
                'contact_number' => 639168761234,
                'birth_date' => '2000-08-18',
                'birth_place' => 'Mandaluyong, Philippines',
                'course_program' => 'BS Computer Science',
            ],
            [
                'user_id' => 116,
                'first_name' => 'Emily',
                'last_name' => 'Villanueva',
                'middle_initial' => 'B',
                'gender' => 'Female',
                'contact_number' => 639271234567,
                'birth_date' => '1999-02-21',
                'birth_place' => 'Pasig City, Philippines',
                'course_program' => 'BSBA',
            ],
            
        ]);
    }
}
