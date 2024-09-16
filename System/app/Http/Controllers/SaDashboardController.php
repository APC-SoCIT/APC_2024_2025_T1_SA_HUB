<?php

namespace App\Http\Controllers;

use App\Models\SaProfile;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Term;
use App\Models\StudentSchedule;
use Illuminate\Support\Facades\DB;  
use App\Models\UserTask;
use App\Models\SaTaskTimeLog;
use App\Models\User;
use Carbon\Carbon;
use Session;

class SaDashboardController extends Controller
{
    //

    public function index(){
        $user = $this->getuserID();
        $urgentTasks = DB::table('tasks')
        ->where('assignment_type', 2)
        ->orderby('tasks.id', 'asc')->paginate(3);

        $assignedTasks = DB::table('user_tasks_timelog')
        ->join('tasks', 'user_tasks_timelog.task_id', '=', 'tasks.id')
        ->join('users', 'user_tasks_timelog.user_id', '=', 'users.id')
        ->where('users.id', $user->id)
        ->where('task_status',1)
        ->select(
            'user_tasks_timelog.id',
            'tasks.id AS task_id',
            'tasks.start_date',
            'tasks.start_time',
            'tasks.end_time',
            'tasks.preffred_program',
            'tasks.office_id' , 
            'tasks.to_be_done', 
            'tasks.assigned_office', 
            'tasks.note')
        ->orderby('user_tasks_timelog.id', 'asc')->paginate(5); 
        
        

        return view('sa.sa_dashboard', compact('urgentTasks','assignedTasks','user'));
    }

    

    public function getuserID()
    {
        //
        $user_id = session('user_id');
        $user = User::find($user_id);
        return $user;
    }

    public  function acceptTask(Task $task){
        $user = $this->getuserID();
        
        $hasConflict = SaTaskTimeLog::where('user_id', $user->id)
            ->join('tasks', 'user_tasks_timelog.task_id', '=', 'tasks.id') 
            ->where(function ($query) use ($task) {
                $query->where('tasks.start_time', '<', $task->end_time)
                    ->where('tasks.end_time', '>', $task->start_time);
            })
            ->exists();

        if ($hasConflict) {
            session()->flash('error', 'Cannot accept task due to time conflict with existing tasks.');
            return redirect()->route('sa.dashboard');
        }

        $userTask = new SaTaskTimeLog();
        $userTask->user_id = $user->id;
        $userTask->task_id = $task->id;
        $userTask->task_status = true;
        $userTask->save();

        session()->flash('accept_task_success', 'Task accepted successfully!');
        return redirect()->route('sa.dashboard');
    }

    public function saCounter($num_sa,$task)
    {
        $saCount = DB::table('user_tasks_timelog')
        ->where('task_id',$task->id)
        ->where('task_status_id',1)
        ->count();
        
        return $saCount;
    }

    public function profile(){
        $user = $this->getuserID();
        $userProfiles = SaProfile::where('user_id', $user->id_number)->get();
        $schedule = $this->getSchedule($user->id_number);
        $term = $this->getStudentSchoolYear($user->id_number);
        $taskHistory = DB::table('user_tasks_timelog')
        ->join('tasks', 'user_tasks_timelog.task_id', '=', 'tasks.id')
        ->join('users', 'user_tasks_timelog.user_id', '=', 'users.id')
        ->where('users.id', $user->id)
        ->select(
            'tasks.id','tasks.start_date',
            'tasks.preffred_program',
            'tasks.to_be_done', 
            'tasks.assigned_office', 
            'tasks.note', 
            'user_tasks_timelog.time_in', 
            'user_tasks_timelog.time_out', 
            'user_tasks_timelog.feedback', 
            'user_tasks_timelog.total_hours'
            )
        ->orderby('user_tasks_timelog.id', 'asc')->get();

        $rendered = DB::table('user_tasks_timelog')
        ->join('tasks', 'user_tasks_timelog.task_id', '=', 'tasks.id')
        ->join('users', 'user_tasks_timelog.user_id', '=', 'users.id')
        ->where('users.id', $user->id)
        ->where('task_status',1)
        ->select(
            DB::raw('SUM(user_tasks_timelog.total_hours) as total_hours'),)
        ->get();
        
        // dd($rendered);

        return view('sa.sa_profile', compact('user','userProfiles', 'taskHistory','rendered','schedule','term'));
    }

    public function getStudentSchoolYear($student_id)
{
    // 1. Find the latest schedule entry for the student
    $latestSchedule = StudentSchedule::where('student_id', $student_id)
                                     ->latest('date_reference') // Or a relevant date column
                                     ->first();

    if (!$latestSchedule) {
        // Handle the case where a student has no schedule
        return null; // Or any appropriate action for your application
    }

    // 2. Get school year from terms table, considering is_ongoing flag
    $schoolYear = Term::where('id', $latestSchedule->term_id)
                      ->where('is_ongoing', true)
                      ->value('school_year'); 

    return $schoolYear;
}

    public function getSchedule($id) 
    {   
        $schedule = StudentSchedule::where('student_id', $id)
            ->join('subject_offerings', 'subject_offerings.id', '=', 'student_schedules.subject_offering_id')
            ->join('subject_offering_details', 'subject_offering_details.subject_offering_id', '=', 'subject_offerings.id')
            ->select(
                'subject_offerings.subject_code', 
                'subject_offerings.section', 
                'subject_offerings.day_id', 
                'subject_offering_details.time_constraints', 
                )
            ->get();

        $schedule = $this->convertDayIdsToNames($schedule);
            
        return $schedule; 
    }

    private function convertDayIdsToNames($schedule) 
    {
        $dayNames = [
            1 => 'Mon', 
            2 => 'Tue', 
            3 => 'Wed', 
            4 => 'Thu', 
            5 => 'Fri'];

        foreach ($schedule as $entry) {
            $entry->day = $dayNames[$entry->day_id];
        }

        return $schedule;
    }

    public function addTimeIn(Request $request)
    {   
        $taskId = $request->input('task_id');
        $userId = $request->input('user_id');
        $timein = now();

        $timeLog = SaTaskTimeLog::where('task_id', $taskId)
                                ->where('user_id', $userId)
                                ->where('time_in', null)
                                ->first();

        $newTimeLog = SaTaskTimeLog::where('task_id', $taskId)
                            ->where('user_id', $userId)
                            ->where('time_in','!=', null)
                            ->first();

        if ($timeLog) {
            $task = Task::where('id', $taskId)->first(); 

            if ($task && $timein >= $task->start_date && $timein > $task->start_time) {
                $timeLog->time_in = $timein;
                $timeLog->save();

                return redirect()->back()->with('success', 'Time-in logged successfully.');
            }             
            else {
                return redirect()->back()->with('error', 'Time-in is not allowed before the task start date or start time.');
            }
        }elseif($newTimeLog){
            $timeLog = new SaTaskTimeLog();
                $timeLog->task_id = $taskId;
                $timeLog->user_id = $userId;
                $timeLog->time_in = $timein;
                $timeLog->task_status = true;
                $timeLog->save();

                return redirect()->back()->with('success','New Time-in logged successfully.');
        } else {
            //$timeLog->task_status=1;
            return redirect()->back()->with('error', 'No matching time-in record found or time-in is less than 30 minutes ago.');
        }
    }

    public function addTimeOut(Request $request)
{
    
    $taskId = $request->input('task_id');
    $userId = $request->input('user_id');
    $timeout = now();

    $timeLog = SaTaskTimeLog::where('task_id', $taskId)
        ->where('user_id', $userId)
        ->whereDate('time_in', $timeout->toDateString())
        ->whereNull('time_out')
        //->where('time_in', '<=', $timeout->subMinutes(30)) // Enforce 30-minute rule
        ->first();
    
    if ($timeLog) {
        $task = Task::where('id', $taskId)->first();

        if ($task && $timeout >= $task->start_date && $timeout > $task->start_time) {

            $timeOutCarbon = Carbon::parse($timeout);
            $timeInCarbon = Carbon::parse($timeLog->time_in);

            $totalHours = number_format($timeOutCarbon->diffInSeconds($timeInCarbon) / 3600, 2);

            $timeLog->time_out = $timeout;
            $timeLog->total_hours = $totalHours;
            // $timeLog->is_Approved_out = 'Pending';
            $timeLog->save();

            return redirect()->back()->with('success', 'Time-out logged successfully.');

        } else {
            return redirect()->back()->with('error', 'Time-out is not allowed before the task start date or start time.');
        }

        
    } else {
        return redirect()->back()->with('error', 'No matching time-in record found or time-in is less than 30 minutes ago.');
    }
}
}
