<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder;
use App\Models\SaTaskTimeLog;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;


class SaManagerDashboardController extends Controller
{
    //

    public function index(){
        return view('sam.sam_dashboard');
    }
    public function onGoing(){
        $user = $this->getuserID();
        $assignedTasks = DB::table('user_tasks_timelog')
        ->join('tasks', 'user_tasks_timelog.task_id', '=', 'tasks.id')
        ->join('users', 'user_tasks_timelog.user_id', '=', 'users.id')
        ->select(
            'user_tasks_timelog.task_id', 
            'tasks.start_date', 
            'tasks.start_time', 
            'tasks.end_time', 
            'tasks.preffred_program', 
            'tasks.to_be_done', 
            'tasks.assigned_office', 
            'tasks.number_of_sa',
            DB::raw('SUM(user_tasks_timelog.total_hours) as accumulated_hours'), 
            'tasks.note',
            DB::raw("TIMESTAMPDIFF(HOUR, CONCAT(tasks.start_date, ' ', tasks.start_time), CONCAT(tasks.start_date, ' ', tasks.end_time)) as task_hours")
            ) 
        ->groupBy('user_tasks_timelog.task_id', 'tasks.start_date', 'tasks.start_time', 'tasks.end_time', 'tasks.number_of_sa', 'tasks.preffred_program', 'tasks.to_be_done', 'tasks.assigned_office', 'tasks.note') // Group by all non-aggregated columns
        ->orderBy('user_tasks_timelog.task_id', 'asc')
        ->get();  
        
        return view('sam.sam_dashboard_ongoing', compact('assignedTasks','user'));
    }

    public function finished(){
        $user = $this->getuserID();
        $assignedTasks = DB::table('user_tasks_timelog')
        ->join('tasks', 'user_tasks_timelog.task_id', '=', 'tasks.id')
        ->join('users', 'user_tasks_timelog.user_id', '=', 'users.id')
        ->select(
            'user_tasks_timelog.task_id',
            'tasks.start_date',
            'tasks.start_time',
            'tasks.end_time',
            'tasks.preffred_program',
            'tasks.to_be_done',
            'tasks.assigned_office',
            'tasks.number_of_sa',
            DB::raw('SUM(user_tasks_timelog.total_hours) as accumulated_hours'), 
            'tasks.note',
            DB::raw("TIMESTAMPDIFF(HOUR, CONCAT(tasks.start_date, ' ', tasks.start_time), CONCAT(tasks.start_date, ' ', tasks.end_time)) as task_hours")
            )
        ->groupBy('user_tasks_timelog.task_id', 'tasks.start_date', 'tasks.start_time', 'tasks.end_time', 'tasks.number_of_sa', 'tasks.preffred_program', 'tasks.to_be_done', 'tasks.assigned_office', 'tasks.note') // Group by all non-aggregated columns
        ->orderBy('user_tasks_timelog.task_id', 'asc')
        ->get();

        return view('sam.sam_dashboard_done', compact('assignedTasks','user'));
    }

    public function viewSaList(Request $request)
    {   
        $user_id = session('user_id');
        $user = User::find($user_id);
        $taskId = $request->route('taskId');

        $saLists = User::join('user_tasks_timelog','users.id','=','user_tasks_timelog.user_id')
        ->join('tasks','user_tasks_timelog.task_id','=','tasks.id')
        ->join('sa_profiles','users.id_number','=','sa_profiles.user_id')
        ->select(
            'sa_profiles.user_id',
            'sa_profiles.first_name',
            'sa_profiles.last_name',
            'sa_profiles.course_program',
            'user_tasks_timelog.id AS timelogId',
            DB::raw('DATE_FORMAT(user_tasks_timelog.time_in, "%H:%i") AS timein'), 
            DB::raw('DATE_FORMAT(user_tasks_timelog.time_out, "%H:%i") AS timeout'),
            'user_tasks_timelog.is_Approved_in',
            'user_tasks_timelog.is_Approved_out',
            'user_tasks_timelog.total_hours' ,
            'user_tasks_timelog.feedback' 
        )
        ->where('tasks.id','=', $taskId)
        ->get();
       
        return view('sam.sam_salist_task_ongoing', compact('saLists','user','taskId'));
    }

    public function acceptTimeIn($id)
    {
        // Find the saList record
        $saList = SaTaskTimeLog::findOrFail($id);

        // Check if pending and allow only if pending
        if ($saList->is_Approved_in !== 'Pending') {
            abort(403, 'Unauthorized action: Time-in status is not Pending.');
        }

        // Update status to Approved
        $saList->is_Approved_in = 'Approved';
        $saList->save();

        // Redirect appropriately (e.g., back to the same page)
        return redirect()->back()->with('success', ' Student Time-In Successfully Approved!');
    } 

    public function acceptTimeOut($id)
    {
        // Find the saList record
        $saList = SaTaskTimeLog::findOrFail($id);

        // Check if pending and allow only if pending
        if ($saList->is_Approved_out !== 'Pending') {
            abort(403, 'Unauthorized action: Time-in status is not Pending.');
        }

        // Update status to Approved
        $saList->is_Approved_out = 'Approved';
        $saList->save();

        // Redirect appropriately (e.g., back to the same page)
        return redirect()->back()->with('success', ' Student Time-Out Approved Successfully!');
    } 

    public function viewSaListDone(Request $request)
    {   
        $user_id = session('user_id');
        $user = User::find($user_id);
        $taskId = $request->route('taskId');

        $saLists = User::join('user_tasks_timelog','users.id','=','user_tasks_timelog.user_id')
        ->join('tasks','user_tasks_timelog.task_id','=','tasks.id')
        ->join('sa_profiles','users.id_number','=','sa_profiles.user_id')
        ->select(
            'sa_profiles.user_id',
            'sa_profiles.first_name',
            'sa_profiles.last_name',
            'sa_profiles.course_program',
            'user_tasks_timelog.id AS timelogId',
            DB::raw('DATE_FORMAT(user_tasks_timelog.time_in, "%H:%i") AS timein'), 
            DB::raw('DATE_FORMAT(user_tasks_timelog.time_out, "%H:%i") AS timeout'),
            'user_tasks_timelog.total_hours' 
        )
        ->where('tasks.id','=', $taskId)
        ->get();
       
        return view('sam.sam_salist_task_done', compact('saLists','user','taskId'));
    }

    public function editHours(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'add_hours' => 'required|numeric',
        ]);

        // Get the existing total_hours value from the timelog or set a default of 0
        $existingTotalHours = 0;
        $timeLog = SaTaskTimeLog::where('id', $request->timelog_id)->first();
        if ($timeLog) {
            $existingTotalHours = $timeLog->total_hours;
        }

        // Determine operation based on the sign of add_hours
        $operation = ($request->add_hours >= 0) ? 'add' : 'subtract';

        // Calculate the new total_hours
        $newTotalHours = $existingTotalHours + $request->add_hours;

        // Update the timelog or create a new one if it doesn't exist
        
        $timeLog->total_hours = $newTotalHours;
        $timeLog->save();

        // Redirect to a success page or display a success message
        return redirect()->back()->with('success', abs($request->add_hours) . ' Hour/s ' . (($operation == 'add') ?  'added' : 'subtracted') . ' successfully!');
    }

    public function getuserID()
    {
        $user_id = session('user_id');
        $user = User::find($user_id);
        return $user;
    }
}
