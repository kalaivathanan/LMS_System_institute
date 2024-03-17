<?php

namespace App\Http\Controllers;

use App\Models\batch;
use App\Models\batchsubject;
use App\Models\Person;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $pic = $user->profile_pic;
        
        if ($user->hasRole('Teacher')) {
            return view('viewbatch')->with('pic', $pic);
            
        } else  if ($user->hasRole('Student')) {
            return view('errorpage.error403')->with('pic', $pic);

        } else  if ($user->hasRole('Admin')) {
            return view('batch')->with('pic', $pic);
        } else {
            return view('errorpage.error403')->with('pic', $pic);
        }
    }
    public function fetchSubjects($batch_id)
    {

        $subjects = batch::with('course')->where('id', $batch_id)->get();

       $user = auth()->user();
        $pic = $user->profile_pic;
        return view('batchsubject')->with('pic', $pic)->with("courses", $subjects  );
    }
    public function fetchSubjectsforteacher(Request $request)
    {

        $batchId = $request->input('batch_id'); // Get batch ID from the request parameter

        $batchSubjects = BatchSubject::where('batchid', $batchId)->with('people')->get();

        return response()->json(['data' => $batchSubjects]);
    }
    public function loadinstructor()
    {
        $instructor=Person::where('catogary','academic')->where('status','active')->get();
        return response()->json($instructor);
    }
    public function disableBatchSubject(Request $request)
    {
        if ($request->ajax()) {

            $validated = $request->validate([
                'batch' => 'bail|required',
                'act' => 'bail|required',

            ]);
            $subject = batchsubject::where('id', $request->batch)->first();

            $subject->status = $request->act;
            $subject->save();
            return response()->json($validated);
        }
    }
    public function showdata(Request $request)
{
    ## Read value
    $draw = $request->get('draw');
    $start = $request->get("start");
    $rowperpage = $request->get("length"); // Rows display per page

    $columnIndex_arr = $request->get('order');
    $columncourseid_arr = $request->get('columns');
    $order_arr = $request->get('order');
    $search_arr = $request->get('search');

    $columnIndex = $columnIndex_arr[0]['column']; // Column index
    $columncourseid = $columncourseid_arr[$columnIndex]['data']; // Column courseid
    $columnSortOrder = $order_arr[0]['dir']; // asc or desc
    $searchValue = $search_arr['value']; // Search value
    $batchstatus = $request->get('batchstatus'); // Batch status filter value

    // Total records
    $totalRecords = batch::select('count(*) as allcount')->count();

    // Total records with filter
    $totalRecordswithFilter = batch::select('count(*) as allcount')
        ->where('coursecode', 'like', '%' . $searchValue . '%')
        ->when($batchstatus, function ($query, $batchstatus) {
            return $query->where('batchstatus', $batchstatus);
        })
        ->count();

    // Fetch records
    $records = batch::orderBy($columncourseid, $columnSortOrder)
        ->where('batch.coursecode', 'like', '%' . $searchValue . '%')
        ->when($batchstatus, function ($query, $batchstatus) {
            return $query->where('batchstatus', $batchstatus);
        })
        ->select('batch.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

    $data_arr = array();
    $i = 0;
    foreach ($records as $record) {
        $i++;
        $id = $record->id;
        $courseid = $record->coursecode;
        $fee = $record->fee;
        $regFee = $record->regFee;
        $public = $record->public;
        $batchstatus = $record->batchstatus;
        $daysperweek = $record->daysperweek;
        $duration = $record->duration;
        $startdate = $record->startdate;
        $installment = $record->installment;
        $basepayment = $record->basepayment;

        $data_arr[] = array(
            "courseid" => $courseid,
            "id" => $id,
            "fee" => $fee,
            "regFee" => $regFee,
            "public" => $public,
            "daysperweek" => $daysperweek,
            "duration" => $duration,
            "startdate" => $startdate,
            "installment" => $installment,
            "basepayment" => $basepayment,
            "batchstatus" => $batchstatus,
        );
    }

    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordswithFilter,
        "aaData" => $data_arr
    );

    return response()->json($response);
}


    public function disable(Request $request)
    {
        if ($request->ajax()) {

            $validated = $request->validate([
                'id' => 'bail|required',
                'act' => 'bail|required',
                'sdate' => 'bail|required',
            ]);
            $course = batch::where('id', $request->id)->first();

            $course->batchstatus = $request->act;
            if ($request->act == "on going") {
                $course->startdate = $request->sdate;
                $course->enddate = $request->edate;
            } else if ($request->act == "locked") {
                $course->lockdate = $request->sdate;
            } else  if ($request->act == "completed") {
                $course->enddate = $request->sdate;
            }

            $course->save();
            return response()->json($validated);
        }
    }
}
