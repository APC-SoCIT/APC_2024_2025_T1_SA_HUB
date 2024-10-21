<?php

namespace Database\Seeders;

use App\Models\SaProfile;
use App\Models\StudentGrade;
use Carbon\Carbon;
use Illuminate\Auth\Events\Failed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // $students = [
        //     [
        //         'id_number' => 111,
        //         'subject_code_id' => 'EE133',
        //         'midterm_grade' => '3.5',
        //         'midterm_absences' => '2',
        //         'endterm_grade' => '3',
        //         'endterm_absences' => '3',
        //         'final_grade' => '3'
        //     ],
        //     [
        //         'id_number' => 115,
        //         'subject_code_id' => 'CS101',
        //         'midterm_grade' => '2.0',
        //         'midterm_absences' => '1',
        //         'endterm_grade' => '2.0',
        //         'endterm_absences' => '2',
        //         'final_grade' => '2.5'
        //     ],
        //     [
        //         'id_number' => 115,
        //         'subject_code_id' => 'CS102',
        //         'midterm_grade' => '2.0',
        //         'midterm_absences' => '1',
        //         'endterm_grade' => '2.0',
        //         'endterm_absences' => '2',
        //         'final_grade' => '2.0'
        //     ],
        //     [
        //         'id_number' => 116,
        //         'subject_code_id' => 'IT101',
        //         'midterm_grade' => '1.0',
        //         'midterm_absences' => '4',
        //         'endterm_grade' => '1.5',
        //         'endterm_absences' => '5',
        //         'final_grade' => '1.0'
        //     ],
        //     [
        //         'id_number' => 116,
        //         'subject_code_id' => 'IT102',
        //         'midterm_grade' => '1.0',
        //         'midterm_absences' => '4',
        //         'endterm_grade' => '0.0',
        //         'endterm_absences' => '5',
        //         'final_grade' => '0.0'
        //     ],
        // ];

        // foreach ($students as $student) {
        //     DB::table('student_grades')->insert([
        //         'student_profile_id' => $student['id_number'], // Assuming 'id_number' is used as the profile identifier
        //         'subject_code_id' => $student['subject_code_id'],
        //         'midterm_grade' => $student['midterm_grade'],
        //         'midterm_absences' => $student['midterm_absences'],
        //         'endterm_grade' => $student['endterm_grade'],
        //         'endterm_absences' => $student['endterm_absences'],
        //         'remarks' => $student['final_grade'] === '0.0' ? 'Fail': 'Pass',
        //         'final_grade' => $student['final_grade'],
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
        $students = [
            ['id_number' => 114], // Probation 1 year ago
            ['id_number' => 115], // Probation 1 year ago
            ['id_number' => 116], // Probation 6 months ago
            ['id_number' => 117], // Probation 6 months ago
            ['id_number' => 118], // Probation 6 months ago
            // Realistic data for remaining students
            ['id_number' => 119],
            ['id_number' => 120],
            ['id_number' => 121],
            ['id_number' => 122],
            ['id_number' => 123],
            ['id_number' => 124],
            ['id_number' => 125],
            ['id_number' => 126],
            ['id_number' => 127],
            ['id_number' => 128],
            ['id_number' => 129],
            ['id_number' => 130],
            ['id_number' => 131],
            ['id_number' => 132],
            ['id_number' => 133],
            ['id_number' => 134],
        ];

        // Subject codes array for reference
        $subjects = [ // Random subject code
            'COMP101',
            'COMP102',
            'PHYS101',
            'CHEM101',
            'MATH201',
            'ENG102',
            'HIST102',
            'BIO102',
            'PSY102',
            'CHEM103',
        ];

        // Insert realistic grades for each student
        // Seeding grades
        foreach ($students as $key => $student) {
            // foreach ($subjects as $subject) {
                if (in_array($student['id_number'], [114, 115])) {
                    // Probation 1 year ago
                    DB::table('student_grades')->insert([
                        'student_profile_id' => $student['id_number'],
                        'subject_code_id' => $subjects[array_rand($subjects)],
                        'midterm_grade' => 0.0,
                        'midterm_absences' => 3,
                        'endterm_grade' => 0.0,
                        'endterm_absences' => 2,
                        'remarks' => 'Fail',
                        'final_grade' => 0.0,
                    ]);

                    DB::table('offenses')->insert([
                        'user_id' => $student['id_number'],
                        'type' => 'grade',
                        'description' => '0.0',
                        'status' => 'probation',
                        'date_start' => Carbon::now()->subYear(),
                    ]);

                    SaProfile::where('user_id', $student['id_number'])->update([
                        'status' => 'probation',
                    ]);
                } elseif (in_array($student['id_number'], [116, 117, 118])) {
                    // Probation 6 months ago
                    DB::table('student_grades')->insert([
                        'student_profile_id' => $student['id_number'],
                        'subject_code_id' => $subjects[array_rand($subjects)],
                        'midterm_grade' => 0.0,
                        'midterm_absences' => 2,
                        'endterm_grade' => 0.0,
                        'endterm_absences' => 1,
                        'remarks' => 'Fail',
                        'final_grade' => 0.0,
                    ]);

                    DB::table('offenses')->insert([
                        'user_id' => $student['id_number'],
                        'type' => 'grade',
                        'description' => '0.0',
                        'status' => 'probation',
                        'date_start' => Carbon::now()->subYear(),
                    ]);

                    SaProfile::where('user_id', $student['id_number'])->update([
                        'status' => 'probation',
                    ]);
                } else {
                    // Realistic data for the rest
                    DB::table('student_grades')->insert([
                        'student_profile_id' => $student['id_number'],
                        'subject_code_id' => $subjects[array_rand($subjects)],
                        'midterm_grade' => rand(1.0, 4.0),
                        'midterm_absences' => rand(0, 3),
                        'endterm_grade' => rand(1.0, 4.0),
                        'endterm_absences' => rand(0, 2),
                        'remarks' => 'Pass',
                        'final_grade' => rand(1.0, 4.0),
                    ]);
                }
            // }
        }
    }
}
