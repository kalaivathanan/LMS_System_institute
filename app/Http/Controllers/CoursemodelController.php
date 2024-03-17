<?php

namespace App\Http\Controllers;

use App\Models\Coursemodel;
use App\Models\batch;
use App\Models\batchsubject;
use App\Models\coursesubjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursemodelController extends Controller
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
        return view('course')->with('pic', $pic);
    }
    public function loadSubject()
    {
        $courses = Coursemodel::all();
        $user = auth()->user();
        $pic = $user->profile_pic;
        return view('subject')->with('pic', $pic)->with('courses', $courses);
    }
    public function fetchSubjects($courseId)
    {
        $subjects = coursesubjects::where('courseid', $courseId)->get();

        return response()->json($subjects);
    }
    public function deleteSubject(coursesubjects $subject)
    {
        $subject->delete();
        return response()->json(['message' => 'Subject deleted successfully']);
    }
    public function addSubject(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'courseid' => 'required|exists:coursemodels,id',
            'code' => 'required',
            'name' => 'required',
            'hours' => 'required|numeric',
        ]);

        // Create the new subject
        $subject = new coursesubjects();
        $subject->courseid = $validatedData['courseid'];
        $subject->code = $validatedData['code'];
        $subject->name = $validatedData['name'];
        $subject->hours = $validatedData['hours'];
        $subject->save();

        return response()->json(['message' => 'Subject added successfully']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'code' => 'bail|required|unique:coursemodels',
                'name' => 'bail|required|unique:coursemodels,name|max:50',
                'nortionlHours' => 'bail|required|Numeric',
                'type' => 'required'

            ]);
            $event = coursemodel::create([
                'code' => $request->code,
                'nortionlHours' => $request->nortionlHours,
                'name' => $request->name,
                'type' => $request->type,
                'description' => $request->description,
                'status' => "active",
                'createdby' => auth()->user()->id,
            ]);

            return  view('course');
        }
    }
    public function disable(Request $request)
    {
        if ($request->ajax()) {

            $validated = $request->validate([
                'code' => 'bail|required',
                'act' => 'bail|required',

            ]);
            $course = coursemodel::where('code', $request->code)->first();

            $course->status = $request->act;
            $course->save();
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
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = coursemodel::select('count(*) as allcount')->count();
        $totalRecordswithFilter = coursemodel::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = coursemodel::orderBy($columnName, $columnSortOrder)
            ->where('coursemodels.name', 'like', '%' . $searchValue . '%')
            ->select('coursemodels.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $i = 0;
        foreach ($records as $record) {
            $i++;
            $code = $record->code;
            $name = $record->name;
            $description = $record->description;
            $type = $record->type;
            $hours = $record->nortionlHours;
            $status = $record->status;

            $data_arr[] = array(
                "id" => $i,
                "code" => $code,
                "name" => $name,
                "description" => $description,
                "type" => $type,
                "nortionlHours" => $hours,
                "status" => $status
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

    public function createbatch(Request $request)
    {

        if ($request->ajax()) {
            $validated = $request->validate([
                'courseFee' => 'bail|required|Numeric',
                'coursecode' => 'bail|required|exists:coursemodels,code',
                'courseFee' => 'bail|required|Numeric',
                'basepayment' => 'bail|required|Numeric',
                'noinstall' => 'bail|required|Numeric',
                'duration' => 'bail|required|Numeric',
                'regFee' => 'bail|required|Numeric',
                'dayperweek' => 'bail|required|Numeric',
                'batchtype' => 'required',

            ]);
            try {
              
                DB::transaction(function () use ($request) {
                    $user = auth()->user();
                    $batch = new batch();
                    $batch->coursecode = $request->coursecode;
                    $batch->realcourseid = $request->cid;
                    $batch->duration = $request->duration;
                    $batch->fee = $request->courseFee;
                    $batch->installment = $request->noinstall;
                    $batch->batchstatus = "not started";
                    $batch->daysperweek = $request->dayperweek;
                    $batch->center = $user->center;
                    $batch->public = $request->batchtype;
                    $batch->regFee = $request->regFee;
                    $batch->basepayment = $request->basepayment;
                    $batch->createdby = auth()->user()->id;
                    $batch->save();
                    // $batchid = $batch->id;
                    
                    $courseSubjects = coursesubjects::where('courseid', $batch->realcourseid)->get();
                    $colorPalette = [
                        '#0074D9', '#FF4136', '#2ECC40', '#FF851B', '#7FDBFF',
                        '#B10DC9', '#01FF70', '#F012BE', '#3D9970', '#111111',
                        '#AAAAAA', '#DDDDDD', '#001f3f', '#FFDC00', '#E45641',
                        '#F6D55C', '#20639B', '#3CAEA3', '#F98B60', '#D0C91F',
                        '#9B1B30', '#000000', '#ED7D31', '#5B9BD5', '#70AD47'
                    ];
$i=0;
                    foreach ($courseSubjects as $courseSubject) {
                        // Create a new BatchSubject record with the relevant data
                        $color = $colorPalette [$i];
                        $batchSubject = new batchsubject();
                        $batchSubject->code=$courseSubject->code;
                        $batchSubject->name= $courseSubject->name;
                        $batchSubject->hours=$courseSubject->hours;
                        $batchSubject->courseid=$batch->realcourseid;
                        $batchSubject->batchid=$batch->id;
                        $batchSubject->color=$color;
                        $batchSubject->save();
                        $i++;  
                    }
                });
                return response()->json($validated);
            } catch (\Illuminate\Database\QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    $errorMessage = 'Duplicate entry exception';
                } else {
                    $errorMessage = $e->getMessage();
                }
                DB::rollback();
                return response()->json(['errors' => ['message' => $errorMessage]], 422);
            } catch (\Exception $e) {

                return response()->json(['errors' => ['message' => $e->getMessage()]], 422);
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\coursemodel  $coursemodel
     * @return \Illuminate\Http\Response
     */
    public function show(coursemodel $coursemodel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\coursemodel  $coursemodel
     * @return \Illuminate\Http\Response
     */
    public function edit(coursemodel $coursemodel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\coursemodel  $coursemodel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, coursemodel $coursemodel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\coursemodel  $coursemodel
     * @return \Illuminate\Http\Response
     */
    public function destroy(coursemodel $coursemodel)
    {
        //
    }
}
