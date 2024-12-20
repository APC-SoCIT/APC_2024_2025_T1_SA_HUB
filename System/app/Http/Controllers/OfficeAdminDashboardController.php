<?php

namespace App\Http\Controllers;

use App\Models\Offense;
use Illuminate\Support\Facades\Log;
use App\Models\SaTaskTimeLog;
use App\Models\SaProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Courses;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class OfficeAdminDashboardController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    //View all tasks - not used
    public function index()// Does not do anything
    {
        $tasks = Task::where('office_id', '=', Auth::user()->id);
        return view('office.office_dashboard', compact('tasks'));
    }

    public function program()
    {
        $program = Courses::where('is_offered', true)->get();
        return $program;
    }

    //view inactive tasks

    public function dashboard()
    {
        //$tasks = Task::all();
        $courses = $this->program();
        $user = $this->getuserID();
        $tasks = Task::where('isActive', true)->where('office_id', '=', Auth::user()->id_number)->get();
        $tasksWithInfo = $this->processTasks($tasks);
        return view('office.office_dashboard', compact('user', 'tasksWithInfo', 'courses'));
    }

    public function history()
    {
        $taskCompleted = SaTaskTimeLog::where('task_status', 2)
            ->distinct('task_id')->get();

        return view('office.office_history', compact('taskCompleted'));
    }

    private function processTasks($tasks)
    {
        $processedTasks = [];
        foreach ($tasks as $task) {
            $startTime = strtotime($task->start_time); // Convert to Unix timestamp
            $endTime = strtotime($task->end_time);
            $task->startTimeFormatted = date("h:i A", strtotime($task->start_time));
            $task->endTimeFormatted = date("h:i A", strtotime($task->end_time));
            $task->totalHours = round(($endTime - $startTime) / 3600, 1); // Assumes these are timestamps
            $task->saCount = DB::table('user_tasks_timelog')
                ->where('task_id', $task->id)
                ->where('task_status', 1)
                ->count();
            $processedTasks[] = $task;
        }
        return $processedTasks;
    }

    public function taskView()
    {
        return view('office.office_task_review');
    }

    public function getuserID()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        return $user;
    }

    public function saCounter($num_sa, $task)
    {
        $saCount = DB::table('user_tasks_timelog')
            ->where('task_id', $task->id)
            ->where('task_status', 1)
            ->count();
        if ($saCount < $num_sa) {
            session()->flash('success', 'Student Assistant full!!');
        }
    }

    public function taskSaList(Request $request, $id)
    {
        $user = $this->getuserID();
        $saLists = SaTaskTimeLog::where('task_id', '=', $id)
            ->where('task_status', '=', 1)
            ->distinct()
            ->latest()
            ->get();
        $taskId = $id;
        return view('office.salist_task', compact('saLists', 'user', 'taskId'));
    }

    public function taskSaListComplete(Request $request, $id)
    {
        $user = $this->getuserID();
        $saLists = SaTaskTimeLog::where('task_id', '=', $id)
            ->where('task_status', '=', 2)
            ->distinct()
            ->latest()
            ->get();
        $taskId = $id;
        return view('office.salist_task', compact('saLists', 'user', 'taskId'));
    }

    public function addFeedback(Request $request)
    {
        // Retrieve the specific time log using first()
        $timeLog = SaTaskTimeLog::where('id', $request->timelogId)
            ->whereNotNull('time_out')
            ->first();

        if ($timeLog) {
            $timeLog->feedback = $request->feedback;
            $timeLog->save();

            return redirect()->route('office.saList.complete', $timeLog->task_id)->with('success', 'Feedback saved successfully!');
        } else {
            // Handle the error case where a time log is not found
            return redirect()->back()->with('error', 'Cannot provide feedback before the time out is recorded.');
        }
    }

    public function getSaData($status)
    {
        if ($status === 'ongoing') {
            $task_status = 1;
        } elseif ($status === 'completed') {
            $task_status = 2;
        }
        $query = User::join('user_tasks_timelog', 'users.id', '=', 'user_tasks_timelog.user_id')
            ->join('sa_profiles', 'users.id', '=', 'sa_profiles.user_id')
            ->select(
                'users.id_number',
                'sa_profiles.first_name',
                'sa_profiles.last_name',
                'users.email',
                DB::raw('SUM(user_tasks_timelog.total_hours) as total_hours')
            )
            ->where('user_tasks_timelog.task_status', '=', $task_status)
            ->groupBy('users.id_number', 'sa_profiles.first_name', 'sa_profiles.last_name', 'users.email')
            ->get(); // Group by these fields

        // dd($task_status);

        return $query;
    }

    public function saReport($status = "ongoing")
    {
        $user = $this->getuserID();

        // Query for ongoing tasks
        $saListsOngoing = SaTaskTimeLog::select(
            'user_id',
            DB::raw('SUM(total_hours) as total_rendered_hours'),
            DB::raw('COUNT(DISTINCT task_id) as total_tasks_accepted')
        )
            ->where('task_status', '=', 1)
            ->groupBy('user_id')
            ->get();

        // Query for completed tasks
        $saListsCompleted = SaTaskTimeLog::select(
            'user_id',
            DB::raw('SUM(total_hours) as total_rendered_hours'),
            DB::raw('COUNT(DISTINCT task_id) as total_tasks_accepted')
        )
            ->where('task_status', '=', 2)
            ->groupBy('user_id')
            ->having('total_rendered_hours', '=', 90)
            ->get();

        // Select the appropriate list based on status
        $saLists = $status === 'ongoing' ? $saListsOngoing : $saListsCompleted;
        // dd($saLists);
        $offenses = Offense::whereIn('user_id', $saLists->pluck('user.id_number'))->get()->keyBy('user_id');
        return view('reports.sa_report', compact('status', 'saLists', 'user', 'offenses'));
    }


    public function officeReport()
    {
        $user = $this->getuserID();
        $officeLists = User::join('tasks', 'users.id_number', '=', 'tasks.office_id') // Users who posted tasks
            ->join('user_tasks_timelog', 'tasks.id', '=', 'user_tasks_timelog.task_id') // Tasks with logged work
            ->select(
                'users.faculty',
                DB::raw('COUNT(distinct tasks.id) as total_tasks_posted'), // Distinct count for accurate reporting
                DB::raw('COUNT(distinct user_tasks_timelog.user_id) as total_accepted_sa'),
                DB::raw('SUM(user_tasks_timelog.total_hours) as total_rendered_hours')
            )
            ->where('user_tasks_timelog.total_hours', '!=', null) // Keep focus on completed tasks
            ->groupBy('users.faculty')
            ->get();


        return view('reports.office_report', ['officeLists' => $officeLists, 'user' => $user]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        $user = $this->getuserID();

        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date|after_or_equal:today',
            'start_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $startTime = Carbon::parse($value);
                    if ($startTime->lt(Carbon::parse('08:00')) || $startTime->gt(Carbon::parse('22:00'))) {
                        $fail('Start time must be between 8 AM and 10 PM.');
                    }
                },
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
                function ($attribute, $value, $fail) {
                    $endTime = Carbon::parse($value);
                    if ($endTime->gt(Carbon::parse('22:00'))) {
                        $fail('End time must be before or at 10 PM.');
                    }
                },
            ],
            'number_of_sa' => 'required|integer',
            'preffred_program' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($value && !DB::table('courses')->where('name', $value)->exists()) {
                        $fail('The selected program is invalid.');
                    }
                },
            ],
            'assignment_type' => 'required|in:1,2',
            'to_be_done' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            // Flash the error messages to the session
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated(); // Get validated data
        $task = new Task($validatedData);
        $task->office_id = $user->id_number;
        $task->assigned_office = $user->faculty;


        if ($task['assignment_type'] == 1) {
            $task->save();
            $this->handleAutoAssignment($task, $validatedData);
        } else {
            $this->handleVoluntary($task);
        }
        // Return success response
        return redirect()->route('office.dashboard')->with('success', 'Task added successfully!');
    }

    private function handleAutoAssignment(Task $task, array $data)
    {
        // Find SAs with matching program (if provided)
        $eligibleSAs = SaProfile::where('course_program', $data['preffred_program'])
            ->whereDoesntHave('offenses', function ($query) {
                // Exclude SAs under probation for major offenses
                $query->where('type', 'major')
                    ->where('status', 'probation');
            })
            ->get();

        // Find SAs with available time slots
        $availableSAs = $this->findSAsWithAvailability($eligibleSAs, $task);
        // Assign the task

        $this->assignTaskToSAs($task, $availableSAs);
    }

    private function findSAsWithAvailability($eligibleSAs, Task $task)
    {
        return $eligibleSAs->filter(function ($sa) use ($task) {
            // Schedule Conflict Check (Existing Code)
            $hasScheduleConflict = DB::table('student_schedules')
                ->join('subject_offerings', 'subject_offerings.id', '=', 'student_schedules.subject_offering_id')
                ->join('subject_offering_details', 'subject_offering_details.subject_offering_id', '=', 'subject_offerings.id')
                ->where('student_schedules.student_id', $sa->id) // Replace with how you get the SA's ID
                ->where(function ($query) use ($task) {
                    $query->where(function ($query) use ($task) {
                        // Task starts within existing schedule
                        $query->whereRaw('SUBSTRING_INDEX(subject_offering_details.time_constraints, "-", 1) BETWEEN ? AND ?', [$task->start_time, $task->end_time]);
                    })
                        ->orWhere(function ($query) use ($task) {
                            // Task ends within existing schedule
                            $query->whereRaw('SUBSTRING_INDEX(subject_offering_details.time_constraints, "-", -1) BETWEEN ? AND ?', [$task->start_time, $task->end_time]);
                        })
                        ->orWhere(function ($query) use ($task) {
                            // Task surrounds an existing schedule
                            $query->whereRaw('SUBSTRING_INDEX(subject_offering_details.time_constraints, "-", 1) < ?', [$task->start_time])
                                ->whereRaw('SUBSTRING_INDEX(subject_offering_details.time_constraints, "-", -1) > ?', [$task->end_time]);
                        });
                })
                ->exists();

            // Accepted Task Conflict Check
            $hasTaskConflict = DB::table('user_tasks_timelog')
                ->join('tasks', 'user_tasks_timelog.task_id', '=', 'tasks.id') // Join with the 'tasks' table
                ->where('user_tasks_timelog.user_id', $sa->id)
                ->where(function ($query) use ($task) {
                    $query->where(function ($query) use ($task) {
                        // Task starts within existing accepted task
                        $query->whereRaw('tasks.start_time BETWEEN ? AND ?', [$task->start_time, $task->end_time]);
                    })
                        ->orWhere(function ($query) use ($task) {
                            // Task ends within existing accepted task
                            $query->whereRaw('tasks.end_time BETWEEN ? AND ?', [$task->start_time, $task->end_time]);
                        })
                        ->orWhere(function ($query) use ($task) {
                            // Task surrounds an existing accpeted task
                            $query->whereRaw('tasks.start_time < ?', [$task->start_time])
                                ->whereRaw('tasks.end_time > ?', [$task->end_time]);
                        });
                })
                ->exists();

            return !($hasScheduleConflict || $hasTaskConflict);
        });
    }

    private function assignTaskToSAs(Task $task, $availableSAs)
    {

        $saIndex = 0;
        $numberOfSAsNeeded = $task->number_of_sa; // Or retrieve dynamically if your task can handle a range

        foreach ($availableSAs as $sa) {

            // Get the SA id based on the Sa id_number
            $userId = DB::table('users')
                ->where('id_number', $sa->user_id)
                ->value('id');

            // Check if SA has already accepted this task
            if (
                SaTaskTimeLog::where('task_id', $task->id)
                    ->where('user_id', $userId) // Assuming you have the SA's ID
                    ->where('task_status', 1)  // Ensure accepted status
                    ->exists()
            ) {
                $saIndex++;
            } else {
                $this->acceptTaskAndLog($task, $sa);
                $saIndex++;
            }

            if ($saIndex >= $numberOfSAsNeeded) {
                break;
            }

        }
    }

    private function acceptTaskAndLog(Task $task, SaProfile $sa)
    {

        $userId = DB::table('users')
            ->where('id_number', $sa->user_id)
            ->value('id');

        // Assuming 'user_id' represents the SA in your user_tasks_timelog table
        $taskLog = new SaTaskTimeLog();
        $taskLog->task_id = $task->id;
        $taskLog->user_id = $userId;
        $taskLog->task_status = 1;

        $taskLog->save();
    }

    private function handleVoluntary(Task $task)
    {
        $task->status = 'pending';
        $task->save();
    }

    // Edit Task
    public function edit(string $id)
    {
        $task = Task::find($id);
        $courses = Courses::all();
        return view('office.office_edit_task', compact('task', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $task = Task::findOrFail($id);

        // Update the time portions

        //$task->update($request->all());

        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'number_of_sa' => 'required|integer',
            'preffred_program' => 'nullable|string',
            'assignment_type' => 'nullable|in:1,2',
            'to_be_done' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        // Directly update the task properties
        $task->start_date = $validatedData['start_date'];
        $task->start_time = $validatedData['start_time'];
        $task->end_time = $validatedData['end_time'];
        $task->number_of_sa = $validatedData['number_of_sa'];
        $task->preffred_program = $validatedData['preffred_program'];
        $task->assignment_type = $validatedData['assignment_type'];
        $task->to_be_done = $validatedData['to_be_done'];
        $task->note = $validatedData['note'];
        $task->save();

        // Check for change to Auto Assignment
        if ($task->assignment_type == 1) {
            $this->handleAutoAssignment($task, $validatedData); // Trigger Auto-Assignment
        }

        return redirect()->route('office.dashboard')->with('success', 'Task edited successfully!');
    }

    public function addTask()
    {
        $courses = $this->program();
        $user = $this->getuserID();
        return view('office.office_add_task', compact('user', 'courses'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancel(string $id)
    {
        //
        $task = Task::findOrFail($id);
        $task->isActive = false;
        $task->deleted_at = now();
        $task->save();

        return redirect()->route('office.dashboard')->with('success_delete', 'Task Deleted successfully!');


    }
    public function delete(string $id)
    {
        //
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('office.dashboard')->with('success_delete', 'Task Deleted successfully!');


    }
}
