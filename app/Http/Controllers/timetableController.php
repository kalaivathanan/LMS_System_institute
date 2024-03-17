<?php

namespace App\Http\Controllers;

use App\Models\acadamiccalender;
use App\Models\batch;
use App\Models\batchsubject;
use App\Models\Person;
use App\Models\studentModel;
use App\Models\subjectteacher;
use Illuminate\Http\Request;

class timetableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        $user = auth()->user();
        $pic = $user->profile_pic;
        if ($user->desig == 'admin')
            $batches = batch::with('course')->get(); // Fetch batches from your database
        else   if ($user->desig == 'academic') {
            $aamcadic = Person::where('uid', $user->id)->first(); // Execute the query to get the Person instance
if ($aamcadic) {
    $BatchIds = subjectteacher::where('teacherid', $aamcadic->id)->distinct()->pluck('courseid')->toArray();

    $batches = batch::with('course')->whereIn('id', $BatchIds)->get();}
        } else   if ($user->desig == 'student') {
            $applicants = studentModel::where('uid', $user->id)->with('getApplicant')->get();
            $batches = collect();

            foreach ($applicants as $applicant) {
                $batch = Batch::with('course')->find($applicant->getApplicant->batchid);
                if ($batch) {
                    $batches->push($batch);
                }
            }
        }
        //dd($applicat->getApplicant->batchid);
        //  $batches = batch::with('course')->where('id',$applicat->getApplicant->batchid)->get();
        return view('acadamicCalender', compact('batches'))->with('pic', $pic);;
    }
    public function fetchSubjects($courseId)
    {
        $subjects = batchsubject::where('batchid', $courseId)->get();

        return response()->json($subjects);
    }
    public function load(Request $request)
    {

        $batchId = $request->batch_id;
        $events = acadamiccalender::with('getsubject')->where('batch', $batchId)->get();
        // $batchId = $request->input('batch_id');
        // $start = $request->input('start');
        // $end = $request->input('end');

        // // Retrieve events for the selected batch within the current view's date range
        // $events = acadamiccalender::with('getsubject')->where('batch', $batchId)
        //     ->whereBetween('start', [$start, $end])
        //     ->get();

        // Return the events as JSON response
        return response()->json($events);
    }
    public function create(Request $request)
    {

        // return $request->all();
        $input = $request->only([
            'subject', 'batch', 'lesson', 'start',  'ends', 'slotsize', 'color', 'user', 'status',
        ]);

        $request->validate([
            'subject' => 'required',
            'batch' => 'required',
            'lesson' => 'required',
            'start' => 'required|date',
            'ends' => 'required|date|after:start',
            'slotsize' => 'required',
            'color' => 'required',
            'user' => 'required',
            // 'allday'=> 'required',
        ]);

        $subject = batchsubject::find($input['subject']);

        // Check if the subject is found
        if ($subject) {
            // Get the subject name and code
            $subteacher = $subject->teacherid;
            $subjectName = $subject->name;
            $subjectCode = $subject->code;
        } else {
            // Default values if subject is not found
            $subjectName = "Subject Not Found";
            $subjectCode = "N/A";
            $subteacher = "N/A";
        }

        $event = acadamiccalender::create([
            'subject' => $input['subject'],
            'batch' => $input['batch'],
            'lessoncontent' => $input['lesson'],
            'start' => $input['start'],
            'end' => $input['ends'],
            'slotsize' => $input['slotsize'],
            'status' => $input['status'],
            'uid' => auth()->user()->id,
            'color' => $input['color'],
            'teacherid' => $subteacher,
        ]);
        $event->save();
        $event->name = $subjectName; // Replace with the actual subject name
        $event->code = $subjectCode; // Replace with the actual subject code
        return response()->json([
            'event' => $event->toArray(),

        ]);
    }
}
