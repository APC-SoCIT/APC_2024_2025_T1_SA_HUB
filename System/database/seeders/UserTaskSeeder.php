<?php

namespace Database\Seeders;

use App\Models\SaTaskTimeLog;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Example tasks and users, replace with real data or get from DB
        $tasks = Task::pluck('id')->toArray(); // Assumes a Task model exists

        $users = User::whereHas('roles', function ($query) { // Uses id_number as user_id
            $query->where('name', 'student_assistant');
        })->pluck('id')->toArray();

        // Number of entries to create
        $entries = 20;

        for ($i = 0; $i < $entries; $i++) {
            // Assign random task and user
            $task_id = $tasks[array_rand($tasks)];
            $user_id = $users[array_rand($users)];

            // Generate a random time in and time out within the same day
            $time_in = Carbon::today()->addDays(rand(1, 14)) // Next two weeks
                ->addHours(rand(10, 17)) // Between 10 AM and 7 PM
                ->addMinutes(rand(0, 59)); // Random minute for time_in

            // Generate a random time out (between 1 to 8 hours after time in)
            $time_out = (clone $time_in)->addHours(rand(1, 8))->addMinutes(rand(0, 59));

            // Calculate total hours
            $total_hours = $time_in->diffInHours($time_out);

            // Create a new timelog entry
            SaTaskTimeLog::create([
                'task_status' => rand(1,2), // 1 = Autohandle 2 = Voluntary
                'task_id' => $task_id,
                'user_id' => $user_id,
                'time_in' => $time_in,
                'time_out' => $time_out,
                'total_hours' => $total_hours,
                'feedback' => $this->randomFeedback(), // Optional feedback function
            ]);
        }
    }

    // Optional function to generate random feedback
    private function randomFeedback()
    {
        $feedbacks = [
            'Good work!',
            'Needs improvement.',
            'Excellent task completion.',
            'Satisfactory performance.',
            'Task completed late but acceptable.',
        ];

        return $feedbacks[array_rand($feedbacks)];
    }
}
