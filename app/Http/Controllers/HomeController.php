<?php

namespace app\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Models\batch;
use App\Models\Coursemodel;
use App\Models\subjectteacher;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $pic = $user->profile_pic;
        $regstudentCount= Applicant::where('status', 'registered')->count();
        $batchCount = batch::where('batchstatus', 'not started')->count();
        $courseCount= Coursemodel::where('status', 'active')->count();
        $StaffCount= subjectteacher::where('status', 'active')->orWhere('status', 'Unassinged')->count();
        $recentApplicants = Applicant::where('status', 'registered')->orderBy('created_at', 'desc')->limit(5)->get();  // Get 5 recent applicants

        $activeBatchCount = Applicant::where('status', 'Registered')->count();
        $inactiveBatchCount = Applicant::where('status', 'not')->count();

        $chartData = [
            'labels' => ['Active', 'Inactive'],
            'datasets' => [[
                'data' => [$activeBatchCount, $inactiveBatchCount],
                'backgroundColor' => ['#007bff', '#ffc107'],
                'hoverBackgroundColor' => ['#0056b3', '#ffa000'],
          ]],
        ];


        if ($user->hasRole('Teacher')) {
            return view('dashboardAcadamic')->with('pic', $pic)->with('nos',$regstudentCount);
        } else  if ($user->hasRole('Student')) {
            return view('dashboardStudent')->with('pic', $pic)->with('nos',$regstudentCount);
        } else  if ($user->hasRole('Admin')) {
            return view('dashboardAdmin')->with('pic', $pic)->with('nos',$regstudentCount)->with('Nob',$batchCount)->with('Noc',$courseCount)->with('Not',$StaffCount)->with('CharData',$chartData)->with('recentApplicants', $recentApplicants);
        } else {
            return view('errorpage.error403')->with('pic', $pic);
        }
    }

}
