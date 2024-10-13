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

        $probationList = Offense::whereIn('status', ['pending', 'probation'])->with('SaProfile')->get()->groupBy('user_id');
        // dd($probationList);
        $saLists = SaProfile::where('status', '=', 'probation')->get();
        $Sa = SaProfile::whereIn('status', ['probation', 'revoked'])->with('offenses')->get();

        return view('guidance.guidance_probation', compact('probationList'));

    }

    public function scholarship()
    {

        $SaLists = SaProfile::whereIn('status', ['pending', 'probation', 'revoked'])->with('offenses')->get();

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
        $saProfile = SaProfile::where('user_id', '=', $saProfileID)->update(['status' => 'probation']);
        $offense = Offense::where('user_id', $saProfileID)->update(['status' => 'probation']);

        return redirect()->back()->with('success', 'Status updated to probation');
    }

    public function setToRevoke(Request $request, $saProfileID)
    {
        $saProfile = SaProfile::where('user_id', '=', $saProfileID)->update(['status' => 'revoked']);
        $user = User::where('id_number', '=', $saProfileID)->delete();
        $offense = Offense::where('user_id', $saProfileID)->update(['status' => 'revoked']);
        return redirect()->back()->with('success', 'Status updated to revoked');
    }
}
