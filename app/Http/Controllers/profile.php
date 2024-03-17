<?php

namespace App\Http\Controllers;

use App\Models\batch;
use App\Models\jobDocs;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jobs;
use App\Models\studentModel;
use App\Models\studentPaymentsModel;

class profile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function imageCrop()
    {
        $user = auth()->user();
        $pic = $user->profile_pic;
        if ($user->desig == 'student') {
            $person = studentModel::where('uid', $user->id) ->with('getApplicant')->get();
            //$batch=Batch::where('id', $person[0]->getApplicant->batchid)->with('course')->get();
            $batch = [];
           // $pay=[];
            foreach ($person as $persons) {
                // Check if the person has an associated applicant
                if ($persons->getApplicant) {
                    $batches = Batch::where('id', $persons->getApplicant->batchid)->with('course')->first();
                    $pays=studentPaymentsModel::where('applicantid',$persons->getApplicant->id)->get();

                    // Check if the batch is found
                    if ($batches) {
                        $batch[] = $batches;
                    }
                    if($pays){
                        $pay[]=$pays->toArray();
                    }

                }
            }
           // $pay=studentPaymentsModel::where('applicantid',$person[0]->getApplicant->id)->get();
           // dd($pay);
            return view('profileStudent')->with('pic', $pic)->with('person', $person)->with('batch',$batch)->with('pay',$pay);
        } 
        else if ($user->desig == 'admin') {
            $person = Person::where('uid', $user->id)->get();

            $job = jobs::where('uid', $user->id)->get();
            if (isset($job)) {
                $doc = jobDocs::join('doc_types', 'job_docs.docid', '=', 'doc_types.id')->where("regno", $job[0]->regno)->get();
            }
            return view('profile')->with('pic', $pic)->with('person', $person)->with('job', $job)->with('doc', $doc);
        }

        else if ($user->desig == 'academic') {
            $person = Person::where('uid', $user->id)->get();

            $job = jobs::where('uid', $user->id)->get();
            if (isset($job)) {
                $doc = jobDocs::join('doc_types', 'job_docs.docid', '=', 'doc_types.id')->where("regno", $job[0]->regno)->get();
            }
            return view('profileTeacher')->with('pic', $pic)->with('person', $person)->with('job', $job)->with('doc', $doc);
        }

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadIMG(Request $request)
    {

        $data = $request->image;


        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $uid = auth()->user()->id;
        $data = base64_decode($data);
        $uid = auth()->user()->id;
        $image_name = $uid . '_' . time() . '.png';
        $path = public_path() . "/uploads/" . $image_name;
        file_put_contents($path, $data);
        $user = User::find($uid);
        $oldImg = $user->profile_pic;
        $path =  public_path() . "/uploads/" . $oldImg;
        if (file_exists($path)) {


            @unlink($path);
        }
        $user->profile_pic = $image_name;
        $user->save();




        return response()->json(['success' => 'done']);
    }
}
