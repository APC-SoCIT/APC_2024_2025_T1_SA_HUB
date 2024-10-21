<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Offense;
use App\Models\OffenseItem;
use App\Models\SaProfile;
use App\Models\Scholarship;
use App\Models\StudentGrade;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class GuidanceController extends Controller
{
    //

    public function dashboard()
    {
        // Guidance Dashboard Cards
        $totalSA = SaProfile::whereIn('status', ['active'])->whereNotIn('status', ['probation', 'revoked'])->count();
        $activeSA = $this->countActiveSa();
        $inactiveSA = $totalSA - $activeSA;

        //Scholarship Status Pie Chart
        $activeScholar = SaProfile::where('status', '=', 'active')->count();
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

        return view('guidance.guidance_dashboard', compact('totalSA', 'activeSA', 'inactiveSA', 'activeScholar', 'probationScholar', 'revokedScholar', 'zeroProbation', 'zeroRevoked', 'majorRevoked', 'majorProbation'));
    }

    public function probation()
    {

        $probationList = Offense::where('type', 'grade')->where('status','probation')->get();
        // dd($probationList);
        // $saLists = SaProfile::where('status', '=', 'probation')->get();
        // $Sa = SaProfile::whereIn('status', ['probation', 'revoked'])->with('offenses')->get();
        // $probationList = StudentGrade::where('final_grade', 0.0)->get();

        return view('guidance.guidance_probation', compact('probationList'));

    }

    public function scholarship()
    {

        // $SaLists = SaProfile::whereIn('status', ['pending', 'probation', 'revoked'])->with('offenses')->get();
        // $SaLists = StudentGrade::where('final_grade', '0.0')->get();
        $SaLists = Offense::where('type', 'grade')
            ->where('date_start', '<=', Carbon::now()->subYear())
            ->get();
        // dd($SaLists);
        return view('guidance.guidance_revoke', compact('SaLists'));

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

    public function setToProbation(Request $request, $saProfileID)
    {
        // Fetch the SA profile using the user ID
        $saProfile = SaProfile::where('user_id', '=', $saProfileID)->first();

        // Check if the SA profile exists
        if ($saProfile) {
            // Determine the new status (toggle between 'active' and 'probation')
            $newStatus = $saProfile->status === 'probation' ? 'active' : 'probation';

            // Update the SA profile's status
            $saProfile->update(['status' => $newStatus]);

            // Toggle the offense status
            if ($newStatus === 'probation') {
                // If the new status is probation, add the SA to the Offense table
                Offense::updateOrCreate(
                    [
                        'user_id' => $saProfileID, // Condition to find existing record
                        'type' => 'grade',
                        'description' => '0.0',
                        'status' => 'probation'
                    ] // Data to update or insert
                );
            } else {
                // If the new status is active, remove the SA from the Offense table
                Offense::where('user_id', $saProfileID)->delete();
            }

            // Return a success message indicating the new status
            return redirect()->back()->with('success', 'Status updated to ' . $newStatus);
        } else {
            // Return an error if no SA profile is found
            return redirect()->back()->with('error', 'SA Profile not found.');
        }
    }

    public function setToRevoke(Request $request, $saProfileID)
    {
        $saProfile = SaProfile::where('user_id', '=', $saProfileID)->update(['status' => 'revoked']);
        $user = User::where('id_number', '=', $saProfileID)->delete();
        $offense = Offense::where('user_id', $saProfileID)->update(['status' => 'revoked']);
        return redirect()->back()->with('success', 'Status updated to revoked');
    }

    public function restoreRevoke($id)
    {
        // Find the user, including the soft-deleted ones
        $user = User::withTrashed()->find($id);

        // Check if the user exists and is soft-deleted
        if ($user && $user->trashed()) {
            $user->restore(); // Restore the soft-deleted user
            SaProfile::where('user_id', $user->id_number)->update(['status' => "active"]);
            return redirect()->back()->with('success', 'User cancelled revoke successfully.');
        }

        return redirect()->back()->with('error', 'User not found or already active.');
    }
}
