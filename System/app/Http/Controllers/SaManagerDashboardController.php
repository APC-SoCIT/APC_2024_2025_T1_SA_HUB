<?php

namespace App\Http\Controllers;

use App\Models\Offense;
use App\Models\OffenseItem;
use App\Models\SaProfile;
use Illuminate\Database\Query\Builder;
use App\Models\SaTaskTimeLog;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class SaManagerDashboardController extends Controller
{
    //

    public function index()
    {
        return view('sam.sam_dashboard');
    }

    public function dashboard()
    {
        // Guidance Dashboard Cards
        $totalSA = SaProfile::whereIn('status', ['active', 'pending_revoke', 'probation'])->whereNotIn('status', ['revoked'])->count();
        $activeSA = $this->countActiveSa();
        $inactiveSA = $totalSA - $activeSA;

        //Scholarship Status Pie Chart
        $activeScholar = SaProfile::whereIn('status',['active','pending_revoke'])->count();
        $probationScholar = SaProfile::where('status', '=', 'probation')->count();
        $revokedScholar = SaProfile::where('status', '=', 'revoked')->count();

        // Offence Status Bar Chart
        $zeroProbation = Offense::where('type', 'grade')
            ->whereHas('saProfile', function ($query) {
                $query->where('status', 'probation');
            })
            ->count();
        $zeroRevoked = Offense::where('type', 'grade')
            ->whereHas('saProfile', function ($query) {
                $query->where('status', 'revoked');
            })
            ->count();
        $majorProbation = Offense::where('type', 'major')
            ->whereHas('saProfile', function ($query) {
                $query->where('status', 'probation');
            })
            ->count();
        $majorRevoked = Offense::where('type', 'major')
            ->whereHas('saProfile', function ($query) {
                $query->where('status', 'revoked');
            })
            ->count();

        return view('sam.sam_dashboard', compact('totalSA', 'activeSA', 'inactiveSA', 'activeScholar', 'probationScholar', 'revokedScholar', 'zeroProbation', 'zeroRevoked', 'majorRevoked', 'majorProbation'));
    }

    private function countActiveSa()
    {
        // Get tasks with student assistants where the pivot table status is 'active'
        $tasks = Task::with([
            'studentAssistants' => function ($query) {
                // Only include active student assistants
                $query->wherePivot('task_status', '1');
            }
        ])->distinct()->get();

        // Initialize a count for active student assistants
        $activeSA = 0;

        // Loop through each task to count the number of active student assistants
        foreach ($tasks as $task) {
            $activeSA += $task->studentAssistants->count(); // Count active SAs in each task
        }
        return $activeSA;
    }

    public function probation()
    {

        $probationList = Offense::where('type', 'major')->where('status', 'probation')->get();
        return view('sam.sam_probation', compact('probationList'));
    }

    public function addProbation()
    {
        $SaLists = SaProfile::get();
        $OffenseLists = OffenseItem::get();
        return view('sam.sam_addProbation', compact('SaLists', 'OffenseLists'));
    }

    public function revoke()
    {
        $SaLists = Offense::distinct('user_id')->where('type', 'major')->where('status', 'pending_revoke')->get();
        return view('sam.sam_revoke', compact('SaLists'));
    }

    public function storeProbation(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'stud_id' => 'required|exists:sa_profiles,user_id', // assuming you have a `student_assistants` table
            // 'type' => 'major',
            'description' => 'required|string',
            'status' => 'required|string',
            'date_start' => 'nullable|date|after_or_equal:now',
            'date_end' => 'nullable|date|after_or_equal:date_start', // Ensure the end date is after the start date
        ]);

        // Store the data in the database
        $offense = Offense::create([
            'user_id' => $request->input('stud_id'),
            'type' => 'major',
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
        ]);

        $saProfile = SaProfile::where('user_id', '=', $request->input('stud_id'))->first();

        if ($saProfile) {
            $saProfile->update([
                'status' => $request->input('status'),
            ]);
        }

        // $user = User::where('id_number', '=', $saProfile->user_id)->delete();

        return redirect()->route('sa.manager.probation')->with('success', "Added a New Offense");
    }

    public function setToProbation(Request $request, $saProfileID)
    {
        $saProfile = SaProfile::where('user_id', '=', $saProfileID)->update(['status' => 'probation']);
        $offense = Offense::where('user_id', $saProfileID)->update(['status' => 'probation']);

        return redirect()->back()->with('success', 'Status Updated to Probation');
    }

    public function setToRevoke(Request $request, $saProfileID)
    {
        $saProfile = SaProfile::where('user_id', '=', $saProfileID)->update(['status' => 'revoked']);
        $user = User::where('id_number', '=', $saProfileID)->delete();
        $offense = Offense::where('user_id', $saProfileID)->update(['status' => 'revoked']);
        return redirect()->back()->with('success', 'Status updated to revoked');
    }

    public function cancelPendingRevoke(Request $request, $saProfileID, $offenseId)
    {
        $saProfile = SaProfile::where('user_id', '=', $saProfileID)->update(['status' => 'active']);
        $offense = Offense::where('id', $offenseId)->delete();
        return redirect()->back()->with('success', 'Removed in Revoke Page');
    }

    public function onGoing()
    {
        $user = $this->getuserID();
        $assignedTasks = DB::table('user_tasks_timelog')
            ->where('task_status', '=', 1)
            ->join('tasks', 'user_tasks_timelog.task_id', '=', 'tasks.id')
            ->join('users', 'user_tasks_timelog.user_id', '=', 'users.id')
            ->select(
                'user_tasks_timelog.task_id',
                'user_tasks_timelog.task_status',
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
            ->groupBy('user_tasks_timelog.task_id', 'tasks.start_date', 'tasks.start_time', 'tasks.end_time', 'tasks.number_of_sa', 'tasks.preffred_program', 'tasks.to_be_done', 'tasks.assigned_office', 'tasks.note', 'task_status') // Group by all non-aggregated columns
            ->orderBy('user_tasks_timelog.task_id', 'asc')
            ->get();

        return view('sam.sam_dashboard_ongoing', compact('assignedTasks', 'user'));
    }

    public function finished()
    {
        $user = $this->getuserID();
        $assignedTasks = DB::table('user_tasks_timelog')
            ->where('task_status', '=', 2)
            ->join('tasks', 'user_tasks_timelog.task_id', '=', 'tasks.id')
            ->join('users', 'user_tasks_timelog.user_id', '=', 'users.id')
            ->select(
                'user_tasks_timelog.task_id',
                'user_tasks_timelog.task_status',
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
            ->groupBy('user_tasks_timelog.task_id', 'tasks.start_date', 'tasks.start_time', 'tasks.end_time', 'tasks.number_of_sa', 'tasks.preffred_program', 'tasks.to_be_done', 'tasks.assigned_office', 'tasks.note', 'task_status') // Group by all non-aggregated columns
            ->orderBy('user_tasks_timelog.task_id', 'asc')
            ->get();
        // dd($assignedTasks);
        return view('sam.sam_dashboard_done', compact('assignedTasks', 'user'));
    }

    public function viewSaList(Request $request, $task_id, $list)
    {
        // dd($request->all());
        $user_id = Auth::id();
        $user = User::find($user_id);
        $taskId = $task_id;
        $saList = 0;
        if ($list == 'on-going') {
            $saList = 1;
            $saLists = SaProfile::join('users', 'sa_profiles.user_id', '=', 'users.id_number')
                ->join('user_tasks_timelog', 'users.id', '=', 'user_tasks_timelog.user_id')
                ->join('tasks', 'user_tasks_timelog.task_id', '=', 'tasks.id')
                ->select(
                    'sa_profiles.user_id',
                    'sa_profiles.first_name',
                    'sa_profiles.last_name',
                    'sa_profiles.course_program',
                    'user_tasks_timelog.id AS timelogId',
                    DB::raw('DATE_FORMAT(user_tasks_timelog.time_in, "%H:%i") AS timein'),
                    DB::raw('DATE_FORMAT(user_tasks_timelog.time_out, "%H:%i") AS timeout'),
                    'user_tasks_timelog.total_hours',
                    'user_tasks_timelog.feedback'
                )
                ->where('tasks.id', $taskId)
                ->where('user_tasks_timelog.task_status', $saList)
                ->get();
        } elseif ($list == 'completed') {
            $saList = 2;
            $saLists = SaTaskTimeLog::where('task_status', $saList)->where('task_id', $taskId)->get();
        }
        $status = $saList;
        return view('sam.sam_salist_task_ongoing', compact('saLists', 'user', 'taskId', 'status'));
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
        $user_id = Auth::id();
        $user = User::find($user_id);
        $taskId = $request->route('taskId');

        $saLists = User::join('user_tasks_timelog', 'users.id', '=', 'user_tasks_timelog.user_id')
            ->join('tasks', 'user_tasks_timelog.task_id', '=', 'tasks.id')
            ->join('sa_profiles', 'users.id_number', '=', 'sa_profiles.user_id')
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
            ->where('tasks.id', '=', $taskId)
            ->where('user_tasks_timelog.task_status', '=', 2)
            ->get();

        return view('sam.sam_salist_task_done', compact('saLists', 'user', 'taskId'));
    }

    public function editHours(Request $request)
    {
        // dd($request->all());
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
        return redirect()->back()->with('success', abs($request->add_hours) . ' Hour/s ' . (($operation == 'add') ? 'added' : 'subtracted') . ' successfully!');
    }

    public function getuserID()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        return $user;
    }
}
