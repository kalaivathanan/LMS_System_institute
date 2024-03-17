<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\batch;
use App\Models\center;
use App\Models\studentModel;
use App\Models\studentPaymentsModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','getCourses','store']]);
    }
    public function index()
    {
        //return $batchId;
        // $courses = batch::where("batchstatus", 'not started')->get();
        $center = center::where('status', 'active')->get();


        return  view('applicant', compact('center'));
    }
    public function getCourses($center_id)
    {
        $courses = batch::with('course')->where('center', $center_id)->where('batchstatus', 'not started')->get();
        return response()->json($courses);
    }

    public function viewApplicant(Request $request)
    {
        $applicant = Applicant::find($request->id);
        return response()->json($applicant);
    }
    public function editApplicant(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
        // Get the applicant ID and any updated data from the AJAX request
        $id = $request->input('id');
        $data = $request->except('_token', 'id', 'status');

        // Update the applicant record in the database
        $applicant = Applicant::find($id);

        $applicant->update($data);

        // Return a response indicating success or failure
        return response()->json(['success' => true]);
    }
    public function loadstudent(){
        $batch = Batch::whereIn('batchstatus', ['on going', 'locked'])->get();
        $user = auth()->user();
        $pic = $user->profile_pic;
        return view('viewstudent')->with('pic', $pic)->with('batch', $batch);
    }
    public function getApplicantbyNIC($nic)
    {
        //dd("ddd".$nic);
        // Retrieve applicant data based on the NIC from your database
        $applicant = Applicant::where('nic', $nic)->orderby('updated_at','DESC')->first();

        return response()->json($applicant);
    }
    public function registerStudent(Request $request)
    {
        $this->validate($request, [
            // 'nic' => 'required|regex:/^[0-9]{9}[A-Z0-9]$/',
            // 'email' => 'required|email',
            'appid' => 'required|integer',
            'regfee' => 'required|numeric',
            'basefee' => 'required|numeric',
            'regpaid' => 'required | accepted',
            'basepaid' => 'required ',
            'reginv' => ($request->regpaid == "true") ? 'required' : '',
            'baseinv' => ($request->basepaid == "true") ? 'required' : '',
            'regdate' => [
                'required',
                'date',
                'after_or_equal:today',
                'before_or_equal:' . Carbon::now()->addWeeks(2)->format('Y-m-d')
            ],
        ]);


        try {
            DB::transaction(function () use ($request) {
                // Update applicant status to registered
                $applicant = Applicant::findOrFail($request->input('appid'));
                $applicant->status = 'Registered';
                $applicant->save();


                $batch = batch::findOrFail($applicant->batchid);
                if ($batch->batchstatus == "completed") {
                    throw new \Exception('Course already completed');
                }
                if ($batch->batchstatus == "locked") {
                    throw new \Exception('Course already locked');
                }
                if ($batch->installment * 4 >= $batch->duration) {
                    throw new \Exception('Invalid Number of installments');
                }
                $centerdetails = center::findOrFail($batch->center);
                $regNo = $centerdetails->centername . "_" . $batch->courseid . "_" . $batch->id . "_" . $applicant->id;
                // Create a new user
                $user = User::where('username', $applicant->nic)->first();
                if (!isset($user)) {
                    $user = new User();
                    $user->name =  $applicant->fullname;
                    $user->username =  $applicant->nic;
                    $user->email =  $applicant->email;
                    $user->password = Hash::make('1234');
                    $user->center = $batch->center;
                    $user->desig = 'student';
                    $user->save();
                }
                $user->roles()->detach();
                $user->assignRole("Student");


                // Add data to students_model
                $student = new studentModel();
                $student->uid = $user->id;
                $student->regno = $regNo;
                $student->applicantid = $request->input('appid');
                $student->registerd = Carbon::now()->format('Y-m-d');
                $student->center = $batch->center;
                $student->save();

                // Add data to students_payment_model
                //Add reg fee
                $studentPayment = new studentPaymentsModel();
                $studentPayment->applicantid = $request->input('appid');
                $studentPayment->type = "Registration Fee";
                $studentPayment->amount = $request->input('regfee');
                $studentPayment->invoice = $request->input('reginv');
                if ($request->regpaid == "true") {
                    $studentPayment->status = "paid";
                    $studentPayment->paidDate = Carbon::now()->format('Y-m-d');
                } else {

                    $studentPayment->status = "pending";
                }
                $studentPayment->order = "1";
                $studentPayment->duedate = Carbon::now()->format('Y-m-d');
                $studentPayment->save();
                //Add basic fee
                $studentPayment = new studentPaymentsModel();
                $studentPayment->applicantid = $request->input('appid');
                $studentPayment->type = "Base Fee";
                $studentPayment->amount = $request->input('basefee');
                $studentPayment->invoice = $request->input('baseinv');
                if ($request->basepaid == "true") {

                    $studentPayment->status = "paid";
                    $studentPayment->paidDate = Carbon::now()->format('Y-m-d');
                } else {
                    $studentPayment->status = "pending";

                }
                $studentPayment->order = "2";

                $studentPayment->duedate = Carbon::now()->addWeek(1)->format('Y-m-d');
                $studentPayment->save();
                //add installments
                $amount = ($batch->fee - $batch->basepayment) / $batch->installment;

                for ($i = 1; $i <= $batch->installment; $i++) {
                    $studentPayment = new studentPaymentsModel();
                    $studentPayment->applicantid = $request->input('appid');
                    $studentPayment->type = "Instalement " . $i;
                    $studentPayment->amount = $amount;
                    $studentPayment->status = 'pending';

                    $studentPayment->order = $i + 2;
                    if ($batch->batchstatus == "on going") {
                        $ddate = $batch->startdate;
                        $ddate = Carbon::createFromFormat('Y-m-d', $ddate)->addWeek($i * 4);
                        $studentPayment->duedate = $ddate->format('Y-m-d');
                    } else {
                        $studentPayment->duedate = null;
                    }
                    $studentPayment->save();
                }
                //DB::commit();
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

    // Student Payment Details View 
    public function PaymentView(Request $request)
    {
        $user = auth()->user();
        $pic = $user->profile_pic;
        $Student = studentModel::where('uid', $user->id)->first();
        $applicant = Applicant::where('id', $Student->applicantid)->first();
        $studentPaymentDetails = studentPaymentsModel::where('applicantid', $applicant->id)->get();
        return view('payment', compact('studentPaymentDetails', 'applicant', 'pic'));


    }

    // Student Payment Details Update 

    public function updatePayment(Request $request, $studentpaymentid)
    {
        $this->validate($request, [
            'invoice' => 'required',
            'regdate' => [
                'required',
                'date',
                'after_or_equal:today',
                'before_or_equal:' . Carbon::now()->addWeeks(2)->format('Y-m-d')
            ],
        ]);


        $paymentDetails = studentPaymentsModel::find($studentpaymentid);
        $paymentDetails->status = "request";
        $paymentDetails->invoice = $request->invoice;
        $paymentDetails->paidDate = $request->regdate;
        $paymentDetails->update();
        // dd($paymentDetails);

        return redirect()->back()->with('status', 'Payment Request Successfully!');




    }


    public function studentPaymentView($Applicant_id)
    {
        $user = auth()->user();
        $pic = $user->profile_pic;
        $applicant = Applicant::where('id', $Applicant_id)->first();
        $studentPaymentDetails = studentPaymentsModel::where('applicantid', $applicant->id)->get();
        // dd($studentPaymentDetails);
        return view('paymentAdmin', compact('studentPaymentDetails', 'applicant', 'pic'));




    }

    public function StudentPaymentUpdate(Request $request, $Payment_id)
    {
        $this->validate($request, [
            'invoice' => 'required',
            'regdate' => [
                'required',
                'date',
                'after_or_equal:today',
                'before_or_equal:' . Carbon::now()->addWeeks(2)->format('Y-m-d')
            ],
        ]);


        $paymentDetails = studentPaymentsModel::find($Payment_id);
        $paymentDetails->status = $request->status;
        $paymentDetails->invoice = $request->invoice;
        $paymentDetails->paidDate = $request->regdate;
        $paymentDetails->update();
        // dd($paymentDetails);

        return redirect()->back()->with('status', 'Payment Request Successfully!');




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('applicants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->merge(['dob' => date("Y-m-d", strtotime($request->dob))]);
        $rules =[
            'fullname' => 'required',
            'ininame' => 'required',
            'nic' => [
                'required',
                Rule::unique('applicants')->where(function ($query) use ($request) {
                    return $query->where('batchid', $request->input('batchid'));
                }),
            ],
            'paddress' => 'required',
            'raddress' => 'required',
            'dob' => 'required|date|before:-15 years',
            'gender' => 'required',
            'hphone' => 'required',
            'mphone' => 'required',
            'wphone' => 'required',
            'email' => 'required|email',
            'batchid' => 'required|exists:batch,id'
        ];
        $messages = [
            // 'fullname.required' => 'The full name field is required.',
            // 'ininame.required' => 'The ininame field is required.',
            // 'nic.required' => 'The NIC field is required.',
            'nic.unique' => 'you already applied for this course.',
            // 'paddress.required' => 'The permanent address field is required.',
            // 'raddress.required' => 'The residential address field is required.',
            // 'dob.required' => 'The date of birth field is required.',
            // 'dob.date' => 'The date of birth must be a valid date.',
            // 'dob.before' => 'The date of birth must be at least 15 years ago.',
            // 'gender.required' => 'The gender field is required.',
            // 'hphone.required' => 'The home phone field is required.',
            // 'mphone.required' => 'The mobile phone field is required.',
            // 'wphone.required' => 'The work phone field is required.',
            // 'email.required' => 'The email field is required.',
            // 'email.email' => 'The email must be a valid email address.',
            // 'batchid.required' => 'The batch ID field is required.',
            // 'batchid.exists' => 'The selected batch ID is invalid.',
            // Add other custom messages as needed
        ];
        $validatedData = $request->validate($rules, $messages);
        Applicant::create($validatedData);

        return redirect()->route('applicant.index')->with('success', 'Applicant created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        return view('applicants.show', compact('applicant'));
    }
    public function showApplicant($batch_id)
    {

        $user = auth()->user();
        $pic = $user->profile_pic;
        $batch = batch::with('course')->where('id', $batch_id)->first();
        $paymentModel = DB::table('applicants')->where('batchId', $batch_id)->join('student_payments_models', 'applicants.id', '=', 'student_payments_models.applicantid')->select('student_payments_models.*')->get();


        if ($user->hasRole('Teacher')) {
            return view('staffShowApplicant')->with('pic', $pic)->with('batch_id', $batch_id)->with('batch', $batch)->with('paymentModel', $paymentModel);
            
        } else  if ($user->hasRole('Student')) {
            return view('studentShowApplicant')->with('pic', $pic)->with('batch_id', $batch_id)->with('batch', $batch)->with('paymentModel', $paymentModel);

        } else  if ($user->hasRole('Admin')) {
            return view('showApplicant')->with('pic', $pic)->with('batch_id', $batch_id)->with('batch', $batch)->with('paymentModel', $paymentModel);
        } else {
            return view('errorpage.error403')->with('pic', $pic);
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        return view('applicants.edit', compact('applicant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicant $applicant)
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'ininame' => 'required',
            'nic' => 'required',
            'paddress' => 'required',
            'raddress' => 'required',
            'dob' => 'required|date|before:-15 years',
            'gender' => 'required',
            'hphone' => 'required',
            'mphone' => 'required',
            'wphone' => 'required',
            'email' => 'required|email',
            'batchid' => 'required|exists:batch,id'
        ]);

        $applicant->update($validatedData);

        return redirect()->route('applicants.index')->with('success', 'Applicant updated successfully');
    }
    public function getApplicant(Request $request)
    {
        $batch_id = $request->input('batch_id');

        //$applicants = Applicant::where('id', $batch_id);

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $column_serach_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $column_serach = $column_serach_arr[$columnIndex]['data']; // Column courseid
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value


        // Total records
        $totalRecords = Applicant::where('batchid', $batch_id)->select('count(*) as allcount')->count();

        // Total records with filter
        $totalRecordswithFilter = Applicant::where('batchid', $batch_id)
            ->where('fullname', 'like', '%' . $searchValue . '%')
            ->select('count(*) as allcount')
            ->count();

        // Fetch records
        $records = Applicant::orderBy($column_serach, $columnSortOrder)
            ->where('batchid', $batch_id)
            ->where('fullname', 'like', '%' . $searchValue . '%')
            ->select('applicants.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $paymentModel = DB::table('applicants')->where('batchId', $batch_id)->join('student_payments_models', 'applicants.id', '=', 'student_payments_models.applicantid')->select('student_payments_models.*')->get();
            
        $data_arr = array();
        $i = 0;
        foreach ($records as $record) {
            $i++;
            $name = $record->fullname;
            $nic = $record->nic;
            $id = $record->id;
            $gender = $record->gender;
            $phone = $record->hphone;
            $WhatsApp = $record->wphone;
            $status = $record->status;
             $deviceid=$record->device_id;
            $data_arr[] = array(
                "id" => $id,
                "fullname" => $name,
                "nic" => $nic,
                "gender"  => $gender,
                "hphone"  => $phone,
                "wphone"  =>  $WhatsApp,
                "status"  =>  $status,
                "deviceid"=>$deviceid,
                "payments" => collect($paymentModel)->where('applicantid', $id)->values(),
            );
        }
        
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );



        return response()->json($response);
    }
    public function getstudents(Request $request)
    {
        $batch_id = $request->input('batch_id');

        //$applicants = Applicant::where('id', $batch_id);

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $column_serach_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $column_serach = $column_serach_arr[$columnIndex]['data']; // Column courseid
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value


        // Total records
        $totalRecords = Applicant::where('batchid', $batch_id)->where('status', 'Registered')->select('count(*) as allcount')->count();

        // Total records with filter
        $totalRecordswithFilter = Applicant::where('batchid', $batch_id)->where('status', 'Registered')
            ->where('fullname', 'like', '%' . $searchValue . '%')
            ->select('count(*) as allcount')
            ->count();

        // Fetch records
        $records = Applicant::orderBy($column_serach, $columnSortOrder)
            ->where('batchid', $batch_id)->where('status', 'Registered')
            ->where('fullname', 'like', '%' . $searchValue . '%')
            ->select('applicants.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();


        $data_arr = array();
        $i = 0;
        foreach ($records as $record) {
            $i++;
            $name = $record->fullname;
            $nic = $record->nic;
            $id = $record->id;
            $gender = $record->gender;
            $phone = $record->hphone;
            $WhatsApp = $record->wphone;
            $status = $record->status;
             $deviceid=$record->device_id;
            $data_arr[] = array(
                "id" => $id,
                "fullname" => $name,
                "nic" => $nic,
                "gender"  => $gender,
                "hphone"  => $phone,
                "wphone"  =>  $WhatsApp,
                "status"  =>  $status,
                "deviceid"=>$deviceid,
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
}
