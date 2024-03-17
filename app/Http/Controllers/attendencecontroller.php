<?php

namespace App\Http\Controllers;

use App\Models\acadamiccalender;
use App\Models\Attendance;
use App\Models\Batch;
use App\Models\batchsubject;
use Illuminate\Http\Request;

class attendencecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function loadbatch($type)
    {

        $batch = Batch::whereIn('batchstatus', ['on going', 'locked'])->get();
        $user = auth()->user();
        $pic = $user->profile_pic;
        if ($type == "acadamic") {
            return view('attendenceTeacher')->with('pic', $pic)->with('batch', $batch);
        }else {
            return view('attendence')->with('pic', $pic)->with('batch', $batch);
        }
    }
    public function getSubjectAttendence($batchId)
    {
        $subjects = batchsubject::where('batchid', $batchId)->pluck('name', 'id');
        return response()->json($subjects);
    }
    public function getStudentAttendance($batchId, $subjectId, $year, $month, $usertype)
    {
        $startDate = "$year-$month-01";
        $endDate = date('Y-m-t', strtotime($startDate)); // 't' gives the last day of the month

        // Retrieve attendance data along with lesson details
        $attendanceData = Attendance::with('lesson')
            ->whereHas('lesson', function ($query) use ($batchId, $subjectId) {
                $query->where('batch', $batchId)->where('subject', $subjectId);
            })
            ->whereBetween('intime', [$startDate, $endDate])->with('getStudent') //->where('catogary','student')
            ->get();
        $lessonSchedule = acadamiccalender::where('batch', $batchId)->where('subject', $subjectId)->get();
        return response()->json(['attendanceData' => $attendanceData, 'lessonSchedule' => $lessonSchedule]);
    }
}
