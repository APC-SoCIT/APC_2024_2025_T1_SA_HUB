<?php

namespace App\Console\Commands;

use App\Models\Offense;
use App\Models\StudentGrade;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CheckSaProbation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:sa-probation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check SA grades and clear probation status if the SA grade 0.0 is cleared within the year of the start of the probation status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $studentsOnProbation = Offense::where('type', 'grade')
            ->where('date_start', '>=', Carbon::now()->subYear())
            ->get();

        foreach ($studentsOnProbation as $student) {

            // Get all grades for the student
            $saGrades = StudentGrade::where('student_profile_id', $student->user_id)->get();

            // Check if any grade has 'Fail' remark
            $hasFail = $saGrades->contains(function ($grade) {
                return $grade->remarks === 'Fail';
            });

            // If there are no failing grades, delete the offense record
            if (!$hasFail) {
                $student->delete(); // Delete the offense record if the student has no failing grades
                $this->info('SA with ID ' . $saGrades->student_profile_id . ' has been deleted, because of passed grade within the year');
            }

        }
    }
}
