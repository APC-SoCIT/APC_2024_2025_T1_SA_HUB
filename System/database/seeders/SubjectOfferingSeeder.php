<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectOfferingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subject_offering_details')->insert([
            [
                'subject_offering_id' => 1,
                'time_constraints' => json_encode([
                    'days' => ['Monday', 'Wednesday'],
                    'time_start' => '08:00',
                    'time_end' => '10:00'
                ]),
                'instructors' => 'Jane Smith',
                'prerequisites' => 'MATH101',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_offering_id' => 2,
                'time_constraints' => json_encode([
                    'days' => ['Tuesday', 'Thursday'],
                    'time_start' => '10:00',
                    'time_end' => '12:00'
                ]),
                'instructors' => 'Emily Clarke',
                'prerequisites' => 'COMP102',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_offering_id' => 3,
                'time_constraints' => json_encode([
                    'days' => ['Wednesday', 'Friday'],
                    'time_start' => '12:00',
                    'time_end' => '14:00'
                ]),
                'instructors' => 'Mark Lee',
                'prerequisites' => 'PHYS101',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_offering_id' => 4,
                'time_constraints' => json_encode([
                    'days' => ['Tuesday', 'Thursday'],
                    'time_start' => '13:00',
                    'time_end' => '15:00'
                ]),
                'instructors' => 'David Tan',
                'prerequisites' => 'CHEM101',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_offering_id' => 5,
                'time_constraints' => json_encode([
                    'days' => ['Monday', 'Wednesday'],
                    'time_start' => '15:00',
                    'time_end' => '17:00'
                ]),
                'instructors' => 'Rachel Green',
                'prerequisites' => 'MATH201',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_offering_id' => 6,
                'time_constraints' => json_encode([
                    'days' => ['Monday', 'Wednesday'],
                    'time_start' => '10:00',
                    'time_end' => '12:00'
                ]),
                'instructors' => 'Lily Adams',
                'prerequisites' => 'ENG102',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_offering_id' => 7,
                'time_constraints' => json_encode([
                    'days' => ['Tuesday', 'Thursday'],
                    'time_start' => '12:00',
                    'time_end' => '14:00'
                ]),
                'instructors' => 'Martin King',
                'prerequisites' => 'HIST101',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_offering_id' => 8,
                'time_constraints' => json_encode([
                    'days' => ['Wednesday', 'Friday'],
                    'time_start' => '14:00',
                    'time_end' => '16:00'
                ]),
                'instructors' => 'George White',
                'prerequisites' => 'BIO101',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_offering_id' => 9,
                'time_constraints' => json_encode([
                    'days' => ['Monday', 'Wednesday'],
                    'time_start' => '13:00',
                    'time_end' => '15:00'
                ]),
                'instructors' => 'Diana Rose',
                'prerequisites' => 'PSY101',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_offering_id' => 10,
                'time_constraints' => json_encode([
                    'days' => ['Tuesday', 'Thursday'],
                    'time_start' => '15:00',
                    'time_end' => '17:00'
                ]),
                'instructors' => 'Oliver Brown',
                'prerequisites' => 'CHEM102',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('subject_offerings')->insert([
            [
                'subject_code' => 'COMP101',
                'subject_name' => 'Introduction to Computer Science',
                'school_level_id' => 1,
                'course_id' => 4,
                'subject_details_id' => 1, // Refers to subject_offering_details.id
                'term_id' => '2024_1ST',
                'section' => 'A',
                'type' => 'Lecture',
                'day_id' => '1', // Monday, Wednesday
                'room_type' => 'Lecture Room',
                'room_id' => '101',
                'remedial' => false,
                'campus_id' => 'Main',
                'reference_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_code' => 'COMP102',
                'subject_name' => 'Data Structures',
                'school_level_id' => 1,
                'course_id' => 4,
                'subject_details_id' => 2, // Refers to subject_offering_details.id
                'term_id' => '2024_3RD',
                'section' => 'B',
                'type' => 'Lecture',
                'day_id' => '2', // Tuesday, Thursday
                'room_type' => 'Lab Room',
                'room_id' => '202',
                'remedial' => false,
                'campus_id' => 'Main',
                'reference_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_code' => 'PHYS101',
                'subject_name' => 'Physics 101',
                'school_level_id' => 1,
                'course_id' => 2,
                'subject_details_id' => 3, // Refers to subject_offering_details.id
                'term_id' => '2024_3RD',
                'section' => 'A',
                'type' => 'Lecture',
                'day_id' => '3', // Wednesday, Friday
                'room_type' => 'Lab Room',
                'room_id' => '303',
                'remedial' => false,
                'campus_id' => 'Main',
                'reference_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_code' => 'CHEM101',
                'subject_name' => 'General Chemistry',
                'school_level_id' => 1,
                'course_id' => 1,
                'subject_details_id' => 4, // Refers to subject_offering_details.id
                'term_id' => '2024_2ND',
                'section' => 'B',
                'type' => 'Lecture',
                'day_id' => '4', // Tuesday, Thursday
                'room_type' => 'Lecture Room',
                'room_id' => '203',
                'remedial' => false,
                'campus_id' => 'Main',
                'reference_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_code' => 'MATH201',
                'subject_name' => 'Advanced Mathematics',
                'school_level_id' => 1,
                'course_id' => 3,
                'subject_details_id' => 5, // Refers to subject_offering_details.id
                'term_id' => '2024_3RD',
                'section' => 'C',
                'type' => 'Lecture',
                'day_id' => '1', // Monday, Wednesday
                'room_type' => 'Lecture Room',
                'room_id' => '305',
                'remedial' => false,
                'campus_id' => 'Main',
                'reference_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_code' => 'ENG102',
                'subject_name' => 'Advanced English Literature',
                'school_level_id' => 1,
                'course_id' => 'ENG',
                'subject_details_id' => 6, // Refers to subject_offering_details.id
                'term_id' => '2024_FALL',
                'section' => 'A',
                'type' => 'Lecture',
                'day_id' => '1', // Monday, Wednesday
                'room_type' => 'Lecture Room',
                'room_id' => '106',
                'remedial' => false,
                'campus_id' => 'Main',
                'reference_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_code' => 'HIST102',
                'subject_name' => 'World History',
                'school_level_id' => 1,
                'course_id' => 'HIST',
                'subject_details_id' => 7, // Refers to subject_offering_details.id
                'term_id' => '2024_FALL',
                'section' => 'B',
                'type' => 'Lecture',
                'day_id' => '2', // Tuesday, Thursday
                'room_type' => 'Lecture Room',
                'room_id' => '207',
                'remedial' => false,
                'campus_id' => 'Main',
                'reference_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_code' => 'BIO102',
                'subject_name' => 'Biology 102',
                'school_level_id' => 1,
                'course_id' => 'SCI',
                'subject_details_id' => 8, // Refers to subject_offering_details.id
                'term_id' => '2024_FALL',
                'section' => 'C',
                'type' => 'Lab',
                'day_id' => '3', // Wednesday, Friday
                'room_type' => 'Lab Room',
                'room_id' => '303',
                'remedial' => false,
                'campus_id' => 'Main',
                'reference_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_code' => 'PSY102',
                'subject_name' => 'Developmental Psychology',
                'school_level_id' => 1,
                'course_id' => 'PSY',
                'subject_details_id' => 9, // Refers to subject_offering_details.id
                'term_id' => '2024_FALL',
                'section' => 'A',
                'type' => 'Lecture',
                'day_id' => '1', // Monday, Wednesday
                'room_type' => 'Lecture Room',
                'room_id' => '401',
                'remedial' => false,
                'campus_id' => 'Main',
                'reference_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_code' => 'CHEM103',
                'subject_name' => 'Organic Chemistry',
                'school_level_id' => 1,
                'course_id' => 'CHEM',
                'subject_details_id' => 10, // Refers to subject_offering_details.id
                'term_id' => '2024_FALL',
                'section' => 'C',
                'type' => 'Lab',
                'day_id' => '2', // Tuesday, Thursday
                'room_type' => 'Lab Room',
                'room_id' => '302',
                'remedial' => false,
                'campus_id' => 'Main',
                'reference_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
