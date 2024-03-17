<?php

namespace App\Http\Controllers;
use App\Models\batchsubject;
use App\Models\acadamiccalender;
use App\Models\batch;
use Illuminate\Support\Facades\Hash;
use App\Models\Person;
use App\Models\subjectteacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use function PHPUnit\Framework\isNull;

class AcadamicstaffController extends Controller
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
        $instructor = Person::where('catogary', 'academic')->get();
        return view('teacher')->with('pic', $pic)->with('ins', $instructor);
    }
    public function checkUsernameAvailability(Request $request)
    {
        $username = $request->input('username');

        // Perform a database query to check if the username is in use
        $isAvailable = !User::where('username', $username)->exists();

        return response()->json(['available' => $isAvailable]);
    }
    public function addAcademic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'fullname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'dob' => 'required|date|before:-15 years|date_format:Y-m-d',
            'nic' => 'required|regex:/^[0-9]{9}[A-Z0-9]$/',
            'gender' => 'required|in:male,female',
            'paddress' => 'required',
            'raddress' => 'required',
            'hphone' => 'nullable|numeric|digits:10',
            'mphone' => 'nullable|numeric|digits:10',
            'wphone' => 'nullable|numeric|digits:10',
            'email' => 'required|email',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            DB::transaction(function () use ($request) {
                $person = new Person();
                $data = $request->all();
                $lastPerson = Person::latest('id')->first();
                $nextId = $lastPerson ? $lastPerson->id + 1 : 1;
                $regNo = 'A' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
                $user = new User();
                $user->name =  $data['fullname'];
                $user->username =  $data['username'];
                $user->email = $data['email'];
                $user->password = Hash::make('1234');
                $user->center = auth()->user()->center;
                $user->desig = 'academic';
                $user->save();
                // Create a new Person model instance and populate it with the form data
                $person = new Person();
                $person->uid = $user->id;
                $person->fullname = $data['fullname'];
                $person->ininame = $data['ininame'];
                $person->regno =  $regNo;
                $person->nic = $data['nic'];
                $person->dob = $data['dob'];
                $person->gender = $data['gender'];
                $person->paddress = $data['paddress'];
                $person->raddress = $data['raddress'];
                $person->hphone = $data['hphone'];
                $person->mphone = $data['mphone'];
                $person->wphone = $data['wphone'];
                $person->email = $data['email'];
                $person->catogary = 'academic';

                // Save the person data to the database
                $person->save();
            });
            return response()->json(['success' => true]);
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
    public function fetchInstructor(Request $request)
    {
        // Read parameters sent by DataTables
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows displayed per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Person::where('catogary', 'academic')->count();
        $totalRecordswithFilter = Person::where('fullname', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Person::where('catogary', 'academic')->orderBy($columnName, $columnSortOrder)
            ->where('fullname', 'like', '%' . $searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = [];
        $i = 0;

        foreach ($records as $record) {
            $i++;
            $fullname = $record->fullname;
            $ininame = $record->ininame;
            $regno = $record->regno;
            $nic = $record->nic;
            $dob = $record->dob;
            $gender = $record->gender;
            $paddress = $record->paddress;
            $raddress = $record->raddress;
            $hphone = $record->hphone;
            $mphone = $record->mphone;
            $wphone = $record->wphone;
            $email = $record->email;
            $status = $record->status;
            $id = $record->id;
            $device_id=$record->device_id;
            $data_arr[] = [
                "id" => $i,
                "fullname" => $fullname,
                "ininame" => $ininame,
                "regno" => $regno,
                "nic" => $nic,
                "dob" => $dob,
                "gender" => $gender,
                "paddress" => $paddress,
                "raddress" => $raddress,
                "hphone" => $hphone,
                "mphone" => $mphone,
                "wphone" => $wphone,
                "email" => $email,
                "status" => $status,
                "uid" => $id,
                "device_id"=>$device_id,
            ];
        }

        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        ];

        return response()->json($response);
    }
    public function viewacademic(Request $request)
    {
        // dd($request);
        $academic = Person::with('getuser')->where('id', $request->id)->first();
        if (!$academic) {
            return response()->json(['error' => 'Academic record not found.'], 404);
        }
        return response()->json($academic);
    }
    public function editAcademic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'dob' => 'required|date|before:-15 years|date_format:Y-m-d',
            // 'nic' => 'required|regex:/^[0-9]{9}[A-Z0-9]$/',
            'gender' => 'required|in:male,female',
            'paddress' => 'required',
            'raddress' => 'required',
            'hphone' => 'nullable|numeric|digits:10',
            'mphone' => 'nullable|numeric|digits:10',
            'wphone' => 'nullable|numeric|digits:10',
            'email' => 'required|email',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Get the academic ID and any updated data from the AJAX request
        $id = $request->input('id');
        $data = $request->except('_token', 'id', 'status');

        // Update the academic record in the database
        $academic = Person::find($id);

        $academic->update($data);

        // Return a response indicating success or failure
        return response()->json(['success' => true]);
    }
    public function activateacadamic(Request $request)
    {
        if ($request->ajax()) {

            $validated = $request->validate([
                'academic' => 'bail|required',
                'act' => 'bail|required',

            ]);
            $person = Person::where('id', $request->academic)->first();

            $person->status = $request->act;
            $person->save();
            return response()->json($validated);
        }
    }
    public function loadCourse()
    {
        $courses = batch::with('course')->get();

        return response()->json($courses);
    }
    public function assignsubjectteacher(Request $request)
    {
        // Validate the request data (you can add more validation rules)
        // dd($request->coursecode);
        $request->validate([
            'course_id' => 'required|exists:coursemodels,id',
            'subject_id' => 'required|exists:batchsubjects,id',
            'rate_per_hour' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        try {
            // Start a database transaction
            DB::beginTransaction();
            // Create a new record in the subject_teacher table
            $curteacher = subjectteacher::where('subjectid', $request->subject_id)
                ->where('courseid',  $request->course_id)->where('status', 'active');

            $enddate = $curteacher->first();
            // dd($enddate);
            if (!isNull($enddate)) {
                $enddate = $enddate->enddate;
                //dd($enddate);
                $currentDateTime = now();
                //if(!isNull($enddate)){
                // Convert $request->end_date to a Carbon instance for comparison
                $endDate = Carbon::parse($enddate);
                //}
                if ($endDate->greaterThan($currentDateTime)) {
                    $curteacher->update(['status' => 'inactive', 'enddate' => $request->start_date]);
                } else {
                    $curteacher->update(['status' => 'inactive']);
                }
            }
            $assignment = new subjectteacher();
            $assignment->teacherid = $request->teacherid; // Assuming you're associating the teacher with the authenticated user
            $assignment->courseid = $request->course_id;
            $assignment->subjectid = $request->subject_id;
            $assignment->rateperhour = $request->rate_per_hour;
            $assignment->startdate = $request->start_date;
            $assignment->enddate = $request->end_date;
            $assignment->save();
            acadamiccalender::where('subject', $request->subject_id)
                ->where('batch',  $request->course_id)
                ->where('start', '>=', $request->start_date)
                ->where('end', '<=', $request->end_date)
                ->where('status', 'Not Conducted')
                ->update(['teacherid' => $assignment->teacherid]);
                batchsubject::where('id', $request->subject_id)
                ->where('batchid',  $request->course_id)->update(['teacherid' => $assignment->teacherid]);
            DB::commit();
            // You can also return a response if needed
            return response()->json(['message' => 'Assignment saved successfully']);
        } catch (\Exception $e) {
            // Something went wrong, so roll back the transaction
            DB::rollback();

            // You can log the error and return an error response
            // return response()->json(['error' => 'An error occurred while updating assignments'], 500);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
