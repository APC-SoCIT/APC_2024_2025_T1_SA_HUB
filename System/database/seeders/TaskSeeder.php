<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('tasks')->insert([
            [
                'isActive' => true,
                'office_id' => 108,
                'preffred_program' => 'BS Computer Science',
                'start_date' => Carbon::create(2024, 10, 14), // Monday
                'start_time' => '10:30:00',
                'end_time' => '15:30:00',
                'number_of_sa' => 5,
                'status' => 'ongoing',
                'assignment_type' => 2,
                'to_be_done' => 'Develop and test algorithms for the new system',
                'note' => 'Ensure all code passes unit tests by next Monday',
                'assigned_office' => 'Computer Science',
            ],
            [
                'isActive' => true,
                'office_id' => 113,
                'preffred_program' => 'BS Information Technology',
                'start_date' => Carbon::create(2024, 10, 15), // Tuesday
                'start_time' => '12:00:00',
                'end_time' => '16:30:00',
                'number_of_sa' => 1,
                'status' => 'completed',
                'assignment_type' => 2,
                'to_be_done' => 'Update the database schema and perform data migration',
                'note' => 'Ensure data consistency and update logs',
                'assigned_office' => 'Information Technology',
            ],
            [
                'isActive' => false,
                'office_id' => 105,
                'preffred_program' => 'BS Electronics Engineering',
                'start_date' => Carbon::create(2024, 10, 16), // Wednesday
                'start_time' => '11:00:00',
                'end_time' => '15:00:00',
                'number_of_sa' => 3,
                'status' => 'completed',
                'assignment_type' => 1,
                'to_be_done' => 'Assist in lab equipment calibration and troubleshooting',
                'note' => 'Focus on calibrating Lab 2 equipment',
                'assigned_office' => 'Electronics Engineering',
            ],
            [
                'isActive' => true,
                'office_id' => 106,
                'preffred_program' => 'BS Business Administration',
                'start_date' => Carbon::create(2024, 10, 17), // Thursday
                'start_time' => '10:00:00',
                'end_time' => '16:30:00',
                'number_of_sa' => 4,
                'status' => 'ongoing',
                'assignment_type' => 2,
                'to_be_done' => 'Prepare monthly financial reports for the department',
                'note' => 'Ensure reports are accurate and submit by end of the day',
                'assigned_office' => 'Accounting',
            ],
            [
                'isActive' => true,
                'office_id' => 107,
                'preffred_program' => 'BS Accounting',
                'start_date' => Carbon::create(2024, 10, 18), // Friday
                'start_time' => '11:30:00',
                'end_time' => '17:00:00',
                'number_of_sa' => 3,
                'status' => 'ongoing',
                'assignment_type' => 1,
                'to_be_done' => 'Check and monitor network infrastructure for anomalies',
                'note' => 'Update server status logs after network check',
                'assigned_office' => 'Accounting',
            ],
            [
                'isActive' => true,
                'office_id' => 111,
                'preffred_program' => 'BS Accounting',
                'start_date' => Carbon::create(2024, 10, 21), // Monday
                'start_time' => '10:00:00',
                'end_time' => '14:00:00',
                'number_of_sa' => 2,
                'status' => 'ongoing',
                'assignment_type' => 2,
                'to_be_done' => 'Prepare and verify student records for the upcoming term',
                'note' => 'Ensure accuracy of student details before final submission',
                'assigned_office' => 'Registrar',
            ],
            [
                'isActive' => true,
                'office_id' => 113,
                'preffred_program' => 'BS Business Administration',
                'start_date' => Carbon::create(2024, 10, 22), // Tuesday
                'start_time' => '12:30:00',
                'end_time' => '17:30:00',
                'number_of_sa' => 1,
                'status' => 'ongoing',
                'assignment_type' => 2,
                'to_be_done' => 'Prepare financial forecasts and budget plans',
                'note' => 'Ensure the forecast includes all pending transactions',
                'assigned_office' => 'Business Administration',
            ],
        ]);

    }
}
