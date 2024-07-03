<?php

namespace App\Http\Controllers\interviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidates;
use App\Models\Interviewer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Skill;
use App\Models\Task;
use App\Models\KidsAssessment;
use App\Models\ZoomMeeting;
use Config;
use DB;


class interviewerController extends Controller
{

    public function index(Request $request)
    {
        $pageTitle = "InterViewer";
        $candidates = Candidates::get();
        $interviewers = Interviewer::get();
        return view('interviewer.index', compact('pageTitle', 'candidates', 'interviewers'));
    }

    public function storeMeeting(Request $request)
    {
        $meeting = ZoomMeeting::create([
            'interviewer_id'   => $request->interviewer,
            'candidate_id'     => $request->candidate,
            'topic'            => $request->topic,
            'start_time'       => $request->start_time,
            'end_time'         => $request->end_time,
            'duration'         => $request->duration,
            'created_by'       => Auth::user()->id,
            'meeting_password' => bcrypt($request->meeting_password),
        ]);
        return redirect()->back()->with('success', 'Meeting created successfully.');
    }

    public function getMeeting()
    {
        $created_by = Auth::user()->id;
        $meetings = ZoomMeeting::where('created_by', '=', $created_by)->get();
        $event_array = [];
        foreach ($meetings as $event) {
            $event_array[] = [
                'id'    => $event->id,
                'topic' => $event->topic,
                'start_time' => $event->start_time,
                'endtime'   => $event->endtime,
            ];
        }
        return response()->json($event_array);
    }
}
