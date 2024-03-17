<?php

namespace App\Http\Controllers;

use App\Models\acadamiccalender;
use App\Models\Applicant;
use App\Models\Attendance;
use App\Models\Person;
use App\Models\Rfidhistory;
use App\Models\studentModel;
use App\Models\TempRfid;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class rfidcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['fetchPendingRecordsForEsp32', 'storeRFID', 'markAttendence']]);
    }
    public function initializedevice(Request $request)
    {
        try {
            $request->validate([
                'studentId' => [
                    'required',
                    'exists:applicants,id',
                ],
                'studentname' => [
                    'required',
                    Rule::exists('applicants', 'fullname')->where('id', $request->input('studentId')),
                ],
            ]);
            $studentId = $request->input('studentId');
            $studentName = $request->input('studentname');

            // Assuming you have the 'applicants' table and the 'uid' column in the 'users' table
            $student = studentModel::where('applicantid',$studentId)->first();

            $uid = $student->uid;
            $user = auth()->user();

            $existingRecord = TempRfid::where('applicantid',  $studentId)->where('name',  $studentName)
                ->first();
            if ($existingRecord) {
                $existingRecord->update(['rfid' => '', 'status' => 'pending']);

                return response()->json(['status' => 'success', 'message' => $studentName . ' waiting for RFID. His RFID will be updated']);
            }
            // Create a new entry in the 'rfidhistory' table
            TempRfid::create([
                'applicantid' => $studentId,
                //'rfid' => $studentId, // You may update this when the actual RFID is received
                'name' => $studentName,
                'status' => 'pending',
                'regtime' => Carbon::now(),
                'uid' => $uid,
                'createdby' => $user->id,
            ]);
            return response()->json(['status' => 'success', 'message' => 'waiting for RFID']);
        } catch (ValidationException $e) {
            $errorMessages = $this->flattenValidationErrors($e->validator->errors());

            return response()->json(['status' => 'error', 'message' => $errorMessages], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function markAttendence(Request $request)
    {
        try {
            $request->validate([
                'stat' => [
                    'required',
                    'regex:/^[0-9A-Fa-f]+$/',
                    'size:8', // 4 bytes (2 characters per byte)
                    // Rule::unique('applicants', 'device_id'),
                    // Rule::exists('applicants', 'device_id')->where('id','<>', $request->input('sid')),
                ],
            ]);
            $rfidData = $request->input('stat');
            $acadamic = Person::where('catogary', 'academic')->where('device_id', $rfidData)->first();
            if ($acadamic) {
                $teacherName=$acadamic->fullname;
                $teachid = $acadamic->id;
                $lessons = acadamiccalender::where('teacherid', $teachid)
                    ->where('start', '>=', Carbon::now())
                    ->where('start', '<=', Carbon::now()->addMinutes(45))
                    ->get();
                if ($lessons->count() > 0) {
                    if ($lessons->count() > 1) {
                        return response()->json(['status' => 'error', 'message' => "lessons are overlaps"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                    }
                    try {
                        DB::beginTransaction();
                        $lessid = "";
                        foreach ($lessons as $lesson) {
                            $lessid = $lesson->id;
                            $lesson->update(['status' => 'Conducted']);
                        }
                        $attend = Attendance::where('lessonid', $lessid)->where('rfid', $request->input('stat'))->get();
                        if ($attend->count() > 0) {
                            DB::rollBack();
                            return response()->json(['status' => 'error', 'message' => "already attend"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                        }
                        Attendance::create([
                            'personid' => $teachid,
                            'catogary' => "academic",
                            'ispresent' => 1,
                            'intime' => Carbon::now(),
                            'lessonid' => $lessid,
                            'rfid' => $request->input('stat'),
                        ]);

                        DB::commit();

                        return response()->json(['status' => 'success', 'message' => 'Attendence Marked','person'=>explode(' ', $teacherName)[0]]);
                    } catch (Exception $e) {
                        // If an exception occurs, rollback changes
                        DB::rollBack();

                        return response()->json(['status' => 'error', 'message' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                    }
                }
                return response()->json(['status' => 'error', 'message' => "No class found"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                $student = Applicant::where('status', 'Registered')->where('device_id', $rfidData)->first();
                if ($student) {
                    // $request->validate([
                    //     'stat' => [
                    //         Rule::unique('applicants', 'device_id'),
                    //     ],
                    // ]);
                    $batchid = $student->batchid;
                    $studentid = $student->id;
                    $studentName=$student->fullname;
                    $lessons = acadamiccalender::where('batch', $batchid)
                        ->where('start', '>=', Carbon::now())
                        ->where('start', '<=', Carbon::now()->addMinutes(45))
                        ->get();
                    if ($lessons->count() > 0) {
                        if ($lessons->count() > 1) {
                            return response()->json(['status' => 'error', 'message' => "lessons are overlaps"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                        }
                        try {
                            DB::beginTransaction();
                            $lessid = "";
                            foreach ($lessons as $lesson) {
                                $lessid = $lesson->id;
                                //$lesson->update(['status' => 'Conducted']);
                            }
                            $attend = Attendance::where('lessonid', $lessid)->where('rfid', $request->input('stat'))->get();
                            if ($attend->count() > 0) {
                                DB::rollBack();
                                return response()->json(['status' => 'error', 'message' => "already attend"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                            }
                            Attendance::create([
                                'personid' => $studentid,
                                'catogary' => "student",
                                'ispresent' => 1,
                                'intime' => Carbon::now(),
                                'lessonid' => $lessid,
                                'rfid' => $request->input('stat'),
                            ]);

                            DB::commit();

                            return response()->json(['status' => 'success', 'message' => 'Attendence Marked','person'=>explode(' ', $studentName)[0]]);
                        } catch (Exception $e) {
                            // If an exception occurs, rollback changes
                            DB::rollBack();

                            return response()->json(['status' => 'error', 'message' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                        }
                    }
                    return response()->json(['status' => 'error', 'message' => "No class found"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                }
            }
            return response()->json(['status' => 'error', 'message' => "Unknown RFID"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        } catch (ValidationException $e) {
            $errorMessages = $this->flattenValidationErrors($e->validator->errors());

            return response()->json(['status' => 'error', 'message' => $errorMessages], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function assingrfid(Request $request)
    {
        try {
            $request->validate([
                'sid' => [
                    'required',
                    'exists:applicants,id',
                ],
                'sname' => [
                    'required',
                    Rule::exists('applicants', 'fullname')->where('id', $request->input('sid')),
                ],
                'rfidData' => [
                    'required',
                    'regex:/^[0-9A-Fa-f]+$/',
                    'size:8', // 4 bytes (2 characters per byte)
                    Rule::unique('applicants', 'device_id'),
                    // Rule::exists('applicants', 'device_id')->where('id','<>', $request->input('sid')),
                ],
            ]);
            try {
                DB::beginTransaction();
                $rfidData = $request->input('rfidData');
                $sid = $request->input('sid');
                $row = Applicant::find($sid);
                $row->device_id = $rfidData;
                $row->save();
                $tempRfidData = TempRfid::where('applicantid', $sid)->first();

                if ($tempRfidData) {

                    Rfidhistory::create([
                        'rfid' => $tempRfidData->rfid,
                        'applicantid' => $tempRfidData->applicantid, 'name' => $tempRfidData->name,
                        'status' => "added",
                        'regtime' => $tempRfidData->regtime,
                        'accepttime' => $tempRfidData->accepttime,
                        'deltime' => Carbon::now(),
                        'uid' => $tempRfidData->uid,
                        'createdby' => $tempRfidData->createdby,
                    ]);

                    // Delete data from temprfid table
                    $tempRfidData->delete();
                }
                // Commit the transaction
                DB::commit();

                return response()->json(['status' => 'success', 'message' => 'RFID was added to' . $request->sname]);

                // return response()->json(['status' => 'success', 'message' => 'RFID Added successfully']);
            } catch (Exception $e) {
                // If an exception occurs, rollback changes
                DB::rollBack();

                return response()->json(['status' => 'error', 'message' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (ValidationException $e) {
            $errorMessages = $this->flattenValidationErrors($e->validator->errors());

            return response()->json(['status' => 'error', 'message' => $errorMessages], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Add this method to your controller to flatten validation error messages
    protected function flattenValidationErrors(MessageBag $messageBag)
    {
        $messages = [];

        foreach ($messageBag->messages() as $fieldMessages) {
            foreach ($fieldMessages as $message) {
                $messages[] = $message;
            }
        }

        return implode(' ', $messages);
    }
    public function storeRFID(Request $request)
    {
        $rfid = $request->input('stat');
        $userid = $request->input('userid');
        $ttime = $request->input('time');
        // $row=Applicant::where('device_id',$rfid);
        // if($row){
        //     return response()->json(['status' => 'error', 'message' => 'RFID already assigned to some one']);
        // }
        $row = TempRfid::where('applicantid', $userid)->where('status', 'pending')->first();
        if ($row) {
            // Update the rfid column with the provided dev value
            $row->update(['rfid' => $rfid, 'accepttime' => $ttime, 'status' => 'recieved']);
            // Respond with a success message
            return response()->json(['status' => 'success', 'message' => 'RFID data stored successfully']);
        } else {
            // Respond with an error message if the record is not found
            return response()->json(['status' => 'error', 'message' => 'Record not found'],JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function fetchPendingRecordsForEsp32()
    {
        $pendingRecords = TempRfid::where('status', 'pending')->get();

        return response()->json($pendingRecords);
    }
    public function checkRfidEntryStatus(Request $request)
    {
        // Check the RFID entry status in the database
        $studentId = $request->input('studentId');

        // For demonstration, assume the RFID data is retrieved from TempRfid table
        $row = TempRfid::where('applicantid', $studentId)->where('status', 'recieved')->first();

        if ($row && $row->status === 'recieved') {
            // RFID entry is complete, return the RFID data
            return response()->json(['status' => 'recieved', 'rfidData' => $row->rfid]);
        } else {
            // RFID entry is not yet complete
            return response()->json(['status' => 'incomplete']);
        }
    }
}
