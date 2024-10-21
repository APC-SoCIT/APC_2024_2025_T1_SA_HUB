<?php

namespace App\Console\Commands;

use App\Models\Offense;
use App\Models\SaProfile;
use App\Models\StudentGrade;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckSAGrades extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:sa-grades';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check SA grades and set scholarship status to probation if grade is 0.0';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $endOfSchoolYear = Carbon::create($today->year, 6, 30, 0, 0, 0); // Assume school year ends in June [year,month,day,hour,minutes,seconds]

        // Find all SAs whose grades are 0.0 and the school year has ended
        $sasWithLowGrade = StudentGrade::where('final_grade', 0.0)
            ->whereDate('updated_at', '<=', $endOfSchoolYear) // After school year ends
            ->get();


        foreach ($sasWithLowGrade as $sa) {
            $saProfile = SaProfile::where('user_id', $sa->student_profile_id)->first();
            // Set the SA's scholarship status to probation
            $saProfile->status = 'probation';
            $saProfile->save();

            // Create a new offense record
            Offense::create([
                'user_id'      => $sa->student_profile_id, // Assuming user_id in Offense refers to SA profile's user_id
                'type'         => 'grade', // Grade-related offense
                'description'  => '0.0',
                'status'       => 'probation',
                'date_started' => now()->format('Y-m-d'),
                'date_ended'   => null, // Set null or end probation manually later
            ]);

            // Log the probation status change (optional)
            $this->info('SA with ID ' . $sa->student_profile_id . ' has been placed on probation due to a grade of 0.0.');
        }
    }
}
