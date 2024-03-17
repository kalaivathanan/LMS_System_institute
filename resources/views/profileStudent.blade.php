@extends('layouts.app')

@section('content')
    <!-- header -->
    @include('includes/header')
    <div class="container-fluid px-0">

        <div class="row justify-content-center ">
            <div class="col-12 col-md-2 p-0 " id="sbars">
                @include('includes/sidebarStudent')
            </div>
            <div class="col-md-10 col-sm-12 d-flex flex-column h-sm-100 p-0" id="cont">

                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Student Profile') }}</h3>

                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-12 ">
                                <div class="jumbotron ">
                                    <div class="row m-2 ">
                                        <div class="col-12 col-sm-4  text-center">
                                            <div class="borders  cont">
                                                <h3>Profile Picture </h3>
                                                @if (!empty($pic))
                                                    <img src="<?= url('') ?>/uploads/{{ $pic }}"
                                                        id="uploaded-image" class="img-fluid">
                                                @else
                                                    <img id="uploaded-image"
                                                        src="https://flexgroup.nz/wp-content/uploads/2018/05/dummy-image.jpg"
                                                        height="100px" width="200px">
                                                @endif


                                                <div class="input-group mt-3">
                                                    <div class="custom-file ">
                                                        <input type="file" accept="image/*" id="cover_image">
                                                    </div>

                                                </div>
                                                <div class="centered d-sm-none">
                                                    <h1>{{ 'Student' }}</h1>
                                                </div>
                                            </div>
                                            <br>

                                        </div>
                                        <div class="col-12 col-sm-8  ">
                                            <div>
                                                <ul class="nav nav-tabs " id="ttabs">
                                                    <li class="nav-item  "><a class="nav-link active" data="General"
                                                            href="#General">General</a></li>
                                                    <li class="nav-item  "><a class="nav-link" data="trainee"
                                                            href="#trainee">Trainee</a>
                                                    </li>
                                                    <li class="nav-item  "><a class="nav-link" data="job"
                                                            href="#job">Courses</a></li>

                                                    <li class="nav-item  "><a class="nav-link" data="pay"
                                                            href="#pay">Payments</a>
                                                    </li>
                                                </ul>

                                            </div>
                                            {{-- <div class="tab-content"> --}}
                                            <div id="General" class="tabss ">
                                                <div class="container-fluid py-2 px-0">
                                                    <div class="row ">
                                                        <div class="col-4">
                                                            <div class="profiletext">Full Name</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1">
                                                            {{ $person[0]->getApplicant->fullname }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Name With Initial:</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1">
                                                            {{ $person[0]->getApplicant->ininame }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4 ">
                                                            <div class="profiletext">NIC</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1">
                                                            {{ $person[0]->getApplicant->nic }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Permanant <br> Address</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1">
                                                            {{ $person[0]->getApplicant->paddress }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Residence<br> Address</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1">
                                                            {{ $person[0]->getApplicant->raddress }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Phone Home</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1"> {{ $person[0]->getApplicant->hphone }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Phone Mobile</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1">
                                                            {{ $person[0]->getApplicant->mphone }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">WhatsApp</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1">
                                                            {{ $person[0]->getApplicant->wphone }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">E-Mail</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1"> {{ $person[0]->getApplicant->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="job" class="tabss d-none">

                                                <div class="container-fluid py-2 px-0">
                                                    <div class="row ">
                                                        <div class="col-4">
                                                            <div class="profiletext">
                                                                Registration No:</div>
                                                        </div>

                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        <div class="col-8 tbox mb-1 ">
                                                            @foreach ($person as $row)
                                                                @if ($i == 0)
                                                                    <button class="btn btn-warning m-1 viewcourse"
                                                                        id={{ $i }} data={{ $i }}>
                                                                        {{ $row->regNo }} </button>
                                                                @else
                                                                    <button class="btn btn-secondary m-1 viewcourse"
                                                                        id={{ $i }} data={{ $i }}>
                                                                        {{ $row->regNo }}</button>
                                                                @endif
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach
                                                            {{-- {{ $person[0]->regNo }} --}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext"> Course Code</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="jcoursecode">
                                                            {{ $batch[0]->course->code }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Course</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="jcoursename">
                                                            {{ $batch[0]->course->name }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Course Type</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="jcoursetype">
                                                            {{ $batch[0]->course->type }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Batch</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="jbatch">
                                                            {{ $batch[0]->id }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Nortional Hours</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="jnortional">
                                                            {{ $batch[0]->course->nortionlHours }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Duration</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="jnweeks">
                                                            {{ $batch[0]->duration }} Weeks
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Course Started</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="jcoursestarted">
                                                            {{ $batch[0]->startdate }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Course Ended</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="jcourseends">
                                                            {{ $batch[0]->enddate }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Course Status</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="jcoursestatus">
                                                            {{ $batch[0]->batchstatus }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Training Shedule</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="jdasperweek">
                                                            {{ $batch[0]->daysperweek }} Days per Week
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Course Fee</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="jcoursefee">
                                                            Rs. {{ $batch[0]->fee }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="trainee" class="tabss d-none">

                                                <div class="container-fluid py-2 px-0">
                                                    <div class="row ">
                                                        <div class="col-4">
                                                            <div class="profiletext">
                                                                Registration No:</div>
                                                        </div>

                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        <div class="col-8 tbox mb-1 ">
                                                            @foreach ($person as $row)
                                                                @if ($i == 0)
                                                                    <button class="btn btn-warning m-1 regno"
                                                                        id={{ $i }} data={{ $i }}>
                                                                        {{ $row->regNo }} </button>
                                                                @else
                                                                    <button class="btn btn-secondary m-1 regno"
                                                                        id={{ $i }} data={{ $i }}>
                                                                        {{ $row->regNo }}</button>
                                                                @endif
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach
                                                            {{-- {{ $person[0]->regNo }} --}}
                                                        </div>
                                                    </div>


                                                    <div class="row ">
                                                        <div class="col-4">
                                                            <div class="profiletext">
                                                                Registration Date:</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1" id="regdate">

                                                            {{ $person[0]->registerd }}
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4">
                                                            <div class="profiletext">
                                                                Status:</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1 " id='regstatus'>
                                                            {{ $person[0]->status }}
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4">
                                                            <div class="profiletext">
                                                                Total Number of Days:</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1 " id="numdate">
                                                            {{ '15' }}
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4">
                                                            <div class="profiletext">
                                                                Number of Days Present</div>
                                                        </div>
                                                        <div class="col-3 tbox mb-1 " id="numpresent">
                                                            {{ '10' }}
                                                        </div>
                                                        <div class="col-2 profiletext mb-1 ">
                                                            Presentage
                                                        </div>
                                                        <div class="col-3 tbox mb-1 " id="numpresentage">
                                                            {{ '66%' }}
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4">
                                                            <div class="profiletext">
                                                                Number of Days Absent</div>
                                                        </div>
                                                        <div class="col-3 tbox mb-1 " id="numabsent">
                                                            {{ '05' }}
                                                        </div>
                                                        <div class="col-2 profiletext mb-1 ">
                                                            Presentage
                                                        </div>
                                                        <div class="col-3 tbox mb-1 " id="absentprestage">
                                                            {{ '34%' }}
                                                        </div>
                                                    </div>
                                                    <div id="curstate">
                                                        @if ($person[0]->status == 'Dropout')
                                                            <div class="row ">
                                                                <div class="col-4">
                                                                    <div class="profiletext">
                                                                        Date Dropout:</div>
                                                                </div>
                                                                <div class="col-8 tbox mb-1" id="datedropout">
                                                                    {{ $person[0]->dropout }}
                                                                </div>

                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-4">
                                                                    <div class="profiletext">
                                                                        Dropout Reason:</div>
                                                                </div>
                                                                <div class="col-8 tbox mb-1 " id="dropoutreason">
                                                                    {{ $person[0]->dropReason }}
                                                                </div>

                                                            </div>
                                                        @elseif($person[0]->status == 'Completed')
                                                            <div class="row ">

                                                                <div class="col-4">
                                                                    <div class="profiletext">
                                                                        Date Completed:</div>
                                                                </div>
                                                                <div class="col-8 tbox mb-1 " id="datecomplete">
                                                                    {{ $person[0]->completed }}
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="profiletext">
                                                                        Result:</div>
                                                                </div>
                                                                <div class="col-8 tbox mb-1 " id="resultstate">
                                                                    {{ '    ' }}
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="profiletext">
                                                                        Certificate No:</div>
                                                                </div>
                                                                <div class="col-8 tbox mb-1 " id="certificateNo">
                                                                    {{ '    ' }}
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="row ">

                                                                <div class="col-4">
                                                                    <div class="profiletext">
                                                                        Date Completed:</div>
                                                                </div>
                                                                <div class="col-8 tbox mb-1 ">
                                                                    Not Yet
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="profiletext">
                                                                        Result:</div>
                                                                </div>
                                                                <div class="col-8 tbox mb-1 ">
                                                                    Not Yet
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="profiletext">
                                                                        Certificate No:</div>
                                                                </div>
                                                                <div class="col-8 tbox mb-1 ">
                                                                    Not Yet
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                            <div id="pay" class="tabss d-none">

                                                <div class="container-fluid py-2 px-0">
                                                    <div class="row ">
                                                        <div class="col-2">
                                                            <div class="profiletext">
                                                                Reg No:</div>
                                                        </div>

                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        <div class="col-10 tbox mb-1 ">
                                                            @foreach ($person as $row)
                                                                @if ($i == 0)
                                                                    <button class="btn btn-warning m-1 viewpay"
                                                                        id={{ $i }} data={{ $i }}>
                                                                        {{ $row->regNo }} </button>
                                                                @else
                                                                    <button class="btn btn-secondary m-1 viewpay"
                                                                        id={{ $i }} data={{ $i }}>
                                                                        {{ $row->regNo }}</button>
                                                                @endif
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach
                                                            {{-- {{ $person[0]->regNo }} --}}
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-2 p-0 p ">
                                                            <div class="profiletext ">
                                                                Type</div>
                                                        </div>
                                                        <div class="col-2 p-0 ">
                                                            <div class="profiletext text-center">
                                                                Amount &nbsp; &nbsp; &nbsp;
                                                            </div>
                                                        </div>
                                                        <div class="col-2 p-0 ">
                                                            <div class="profiletext text-center">
                                                                Status</div>
                                                        </div>
                                                        <div class="col-2 p-0 ">
                                                            <div class="profiletext">
                                                                Due Date</div>
                                                        </div>
                                                        <div class="col-2 p-0 ">
                                                            <div class="profiletext">
                                                                Date Paid</div>
                                                        </div>
                                                        <div class="col-2 p-0 ">
                                                            <div class="profiletext">
                                                                Invoice</div>
                                                        </div>
                                                    </div>
                                                    <div id="spayment">
                                                        @foreach ($pay as $rows)
                                                            @foreach ($rows as $row)
                                                                <div class="row pb-1">
                                                                    <div class="col-2 p-0 ">
                                                                        <div class="profiletext">
                                                                            {{ $row['type'] }}</div>
                                                                    </div>
                                                                    <div class="col-2 p-0 ml-1 text-end">
                                                                        <div class="tbox ">
                                                                            {{ $row['amount'] }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2 p-0 text-center">
                                                                        <div class="tbox">
                                                                            <span style="{{$row['status'] == "pending" ? 'background:red;' : ($row['status'] == "request" ? 'background:blue; color:white;' : 'background:green; color:white;')  }} padding:2px;  border-radius: 5px;" >{{$row['status']}}</span>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2 p-0">
                                                                        <div class="tbox">
                                                                            {{ $row['duedate'] }}</div>
                                                                    </div>
                                                                    <div class="col-2 p-0">
                                                                        <div class="tbox">
                                                                            {{ $row['paidDate'] }} 
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2 p-0">
                                                                        <div class="tbox">
                                                                            {{ $row['invoice'] }}</div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @break
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- image preview model --}}
                                    <div class="modal" tabindex="-1" role="dialog" id="uploadimageModal">
                                        <div class="modal-dialog" role="document" style="min-width: 700px">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <div id="image_demo"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary crop_image">Crop
                                                        and
                                                        Save</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var image_crop
                /// Initializing croppie in my image_demo div
                if(!$('#image_demo').data('croppie'))
                {
                 image_crop = $('#image_demo').croppie({
                    viewport: {
                        width: 600,
                        height: 300,
                        type: 'square'
                    },
                    boundary: {
                        width: 650,
                        height: 350
                    }
                });

                /// catching up the cover_image change event and binding the image into my croppie. Then show the modal.
                $('#cover_image').on('change', function() {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        image_crop.croppie('bind', {
                            url: event.target.result,
                        });
                    }
                    reader.readAsDataURL(this.files[0]);
                    $('#uploadimageModal').modal('show');
                });

                $('.crop_image').click(function(event) {

                    image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {
                $.ajax({
                    url: "/profile/upImage",
                    type: "POST",
                    data: {
                        "image": resp
                    },
                    success: function(data) {

                        $("#uploaded-image").attr('src',resp);
                        $(".user-avatar").attr('src',resp);

                        $('#cover_image').val("");

                    }
                });
            });

                    $('#uploadimageModal').modal('hide');
                });
            }

            $(".nav-tabs a").click(function(event){

                 $(".tabss").addClass('d-none');

                $('a.nav-link').removeClass('active');
                 $(this).addClass('active');
                 var tid=$(this).attr('data');
                tid="#"+tid;
                 $(tid).removeClass('d-none')
                 $(tid).addClass('d-block')
  });
  $("button.regno").click(function(event){
    $(".regno").removeClass("btn-warning");
    $(".regno").addClass("btn-secondary");
   var btn= $(event.target)
   $(btn).addClass("btn-warning");
    var i=btn.attr('data');
    var x ={!! json_encode($person->toArray()) !!};

    //console.log(y);
    $("#regdate").html(x[i]["registerd"]);
    $("#regstatus").html(x[i]["status"]);
        if(x[i]["status"]=="Dropout")
        {
            $("#curstate").html(
                '<div class="row ">'+
                    '<div class="col-4">'+
                        '<div class="profiletext"> Date Dropout:</div>'+
                    '</div>'+
                    '<div class="col-8 tbox mb-1" id="datedropout">'+
                        x[i]["dropout"]
                    +'</div>'+
                '</div>'+
                '<div class="row ">'+
                '<div class="col-4">'+
                    '<div class="profiletext">Dropout Reason:</div>'+
                '</div>'+
                '<div class="col-8 tbox mb-1 " id="dropoutreason">'+
                    x[i]["dropReason"]+
                '</div></div>');
        }else if(x[i]["status"]=="Completed")
    {
        $("#curstate").html(
            '<div class="row ">'+
                '<div class="col-4">'+
                    '<div class="profiletext"> Date Completed:</div>'+
                '</div>'+
                '<div class="col-8 tbox mb-1" id="datedropout">'+
                    x[i]["completed"]
                +'</div>'+
            '</div>'+
            '<div class="row ">'+
            '<div class="col-4">'+
                '<div class="profiletext">Result</div>'+
            '</div>'+
            '<div class="col-8 tbox mb-1 " id="resultstate">'+
                // x[i]["dropReason"]+
            '</div>'+

                ' <div class="col-4">'+
                    '<div class="profiletext">'
                        +'Certificate No:</div>'+
                    '</div>'+
                    '<div class="col-8 tbox mb-1 " id="certificateNo">'+
                    '</div></div>');
        }else{
            $("#curstate").html('<div class="row ">'+

                '<div class="col-4">'+
                    '<div class="profiletext">Date Completed:</div>'+
                '</div>'+
                '<div class="col-8 tbox mb-1 ">Not Yet</div>'+
                '<div class="col-4">'+
                    '<div class="profiletext">Result:</div>'+
                '</div>'+
                '<div class="col-8 tbox mb-1 ">Not Yet</div>'+
                '<div class="col-4">'+
                    '<div class="profiletext">Certificate No:</div>'+
                '</div>'+
                '<div class="col-8 tbox mb-1 ">Not Yet</div>'+
            '</div>');
        }
    });
    $("button.viewcourse").click(function(event){
    $(".viewcourse").removeClass("btn-warning");
    $(".viewcourse").addClass("btn-secondary");
   var btn= $(event.target)
   $(btn).addClass("btn-warning");
    var i=btn.attr('data');
    var y ={!! json_encode($batch) !!};
    $("#jcoursecode").html(y[i].coursecode);
        $("#jcoursename").html(y[i].course.name);
        $("#jcoursetype").html(y[i].public);
        $("#jbatch").html(y[i].center+"_"+y[i].coursecode+"_"+y[i].id);
        $("#jnortional").html(y[i].course.nortionlHours);
        $("#jnweeks").html(y[i].duration+" Weeks");
        $("#jcoursestarted").html(y[i].startdate);
        $("#jcourseends").html(y[i].enddate);
        $("#jdasperweek").html(y[i].daysperweek+" Days per Week");
        $("#jcoursestatus").html(y[i].batchstatus);
        $("#jcoursefee").html("Rs. "+y[i].fee);
//console.log(y);//[1].course.name);
    });
    $("button.viewpay").click(function(event){
    $(".viewpay").removeClass("btn-warning");
    $(".viewpay").addClass("btn-secondary");
   var btn= $(event.target)
   $(btn).addClass("btn-warning");
    var i=btn.attr('data');
    var z ={!! json_encode($pay) !!};
    var p="";
    z[i].forEach(function(element) {
    p=p+'<div class="row pb-1">'+
        '<div class="col-2 p-0 ">'+
            ' <div class="profiletext">'+
                element.type+
                '</div>'+
                '</div>'+
                '<div class="col-2 p-0 ml-1 text-end">'+
                    ' <div class="tbox ">'+
                        element.amount+
                        '</div>'+
                        '</div>'+
                        '<div class="col-2 p-0 text-center">'+
                            ' <div class="tbox">'+
                                element.status+
                                '</div>'+
                                '</div>'+
                                '<div class="col-2 p-0">'+
                                    '<div class="tbox">'+
                                        element.duedate+
                                        '</div>'+
                                        '</div>'+
                                        '<div class="col-2 p-0">'+
                                            '<div class="tbox">'+
                                                element.paidDate+
                                                '</div>'+
                                                '</div>'+
                                                '<div class="col-2 p-0">'+
                                                    '<div class="tbox">'+
                                                          element.invoice+'</div>'+
                                                        '</div>'+
                                                        '</div>';
                                                    });
    $('#spayment').html(p);
    console.log(z[i][0]);
    });
});


        </script>
@endsection
