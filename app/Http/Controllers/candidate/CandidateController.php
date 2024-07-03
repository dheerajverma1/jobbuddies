<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Candidates;
use App\Models\Interviewer;
use App\Models\ZoomMeeting;
use Illuminate\Support\Facades\Auth;
use DataTables;

class CandidateController extends Controller
{
    /**
     * Returns get Candidate List
     * @group Candidates
     * @header Content-Type application/json
     * @header Authorization Bearer {token}
     **/
    public function index(Request $request)
    {
        $pageTitle = "Candidates Meetings";
        $candidates = Candidates::get();
        $interviewers = Interviewer::get();
        return view('candidate.index', compact('pageTitle', 'candidates', 'interviewers'));
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

    public function getMeeting(){
       $created_by = Auth::user()->id;
       $meetings = ZoomMeeting::where('created_by','=',$created_by)->get();
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
