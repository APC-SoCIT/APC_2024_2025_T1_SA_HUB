<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'student_id' => 114, // Jose Mercado
                'subject_offering_id' => 1,
                'term_id' => '2024-Fall',
                'subject_code' => 'ECE201',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 115, // Alexander Reyes
                'subject_offering_id' => 2,
                'term_id' => '2024-Fall',
                'subject_code' => 'CS101',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 116, // Emily Villanueva
                'subject_offering_id' => 3,
                'term_id' => '2024-Fall',
                'subject_code' => 'IT303',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 117, // John Smith
                'subject_offering_id' => 4,
                'term_id' => '2024-Fall',
                'subject_code' => 'IT305',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 118, // Maria Jones
                'subject_offering_id' => 5,
                'term_id' => '2024-Fall',
                'subject_code' => 'BA101',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 119, // Peter Parker
                'subject_offering_id' => 6,
                'term_id' => '2024-Fall',
                'subject_code' => 'IT401',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 120, // Bruce Lane
                'subject_offering_id' => 7,
                'term_id' => '2024-Fall',
                'subject_code' => 'BA301',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 121, // Clark Kent
                'subject_offering_id' => 8,
                'term_id' => '2024-Fall',
                'subject_code' => 'CS102',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 122, // Diana Prince
                'subject_offering_id' => 9,
                'term_id' => '2024-Fall',
                'subject_code' => 'IT304',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 123, // Barry Allen
                'subject_offering_id' => 10,
                'term_id' => '2024-Fall',
                'subject_code' => 'ECE302',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 124, // Arthur Curry
                'subject_offering_id' => 1,
                'term_id' => '2024-Fall',
                'subject_code' => 'ECE401',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 125, // Victor Stone
                'subject_offering_id' => 2,
                'term_id' => '2024-Fall',
                'subject_code' => 'BA302',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 126, // Hal Jordan
                'subject_offering_id' => 3,
                'term_id' => '2024-Fall',
                'subject_code' => 'BA402',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 127, // Kyle Walker
                'subject_offering_id' => 4,
                'term_id' => '2024-Fall',
                'subject_code' => 'IT202',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 128, // Selina Kyle
                'subject_offering_id' => 5,
                'term_id' => '2024-Fall',
                'subject_code' => 'CS103',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 129, // Lois Lane
                'subject_offering_id' => 6,
                'term_id' => '2024-Fall',
                'subject_code' => 'BA101',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 130, // Harley Quinn
                'subject_offering_id' => 7,
                'term_id' => '2024-Fall',
                'subject_code' => 'CS104',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 131, // Dick Grayson
                'subject_offering_id' => 8,
                'term_id' => '2024-Fall',
                'subject_code' => 'BA303',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 132, // Jason Wood
                'subject_offering_id' => 9,
                'term_id' => '2024-Fall',
                'subject_code' => 'ECE301',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 133, // Tim Drake
                'subject_offering_id' => 10,
                'term_id' => '2024-Fall',
                'subject_code' => 'ECE301',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
            [
                'student_id' => 134, // Steve Rogers
                'subject_offering_id' => 1,
                'term_id' => '2024-Fall',
                'subject_code' => 'ECE301',
                'enrollment_status_id' => 1,
                'date_reference' => Carbon::now(),
                'remarks' => null,
                'confirmed_at' => Carbon::now()->addDay(),
                'enrolled_at' => Carbon::now()->subDay(),
            ],
        ];

        DB::table('student_schedules')->insert($schedules);
    }
}
