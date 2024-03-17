@extends('layouts.app')

@section('content')
    <!-- header -->
    @include('includes/header')
    <div class="container-fluid px-0">

        <div class="row justify-content-center ">
            <div class="col-12 col-md-2 p-0 " id="sbars">
                @include('includes/sidebar')
            </div>
            <div class="col-md-10 col-sm-12 d-flex flex-column h-sm-100 p-0" id="cont">

                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Profile') }}</h3>

                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-12 ">
                                <div class="jumbotron ">
                                    <div class="row m-2 ">
                                        <div class="col-12 col-sm-4  text-center">
                                            <div class="borders  cont">
                                                <h3>Profile Picture</h3>
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
                                                    <h1>{{ $person[0]->catogary }}</h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="d-none d-sm-block">
                                                <img id="uploaded-image"
                                                    src="/images/{{ $person[0]->catogary }}.jpg "height="200px"
                                                    width="200px">

                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-8  ">
                                            <div>
                                                <ul class="nav nav-tabs " id="ttabs">
                                                    <li class="nav-item  "><a class="nav-link active" data="General"
                                                            href="#General">General 3</a></li>

                                                    <li class="nav-item  "><a class="nav-link" data="job"
                                                            href="#job">Job</a></li>
                                                    <li class="nav-item  "><a class="nav-link" data="doc"
                                                            href="#doc">Documents</a>
                                                    </li>
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
                                                            {{ $person[0]->fullname }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Name With Initial:</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1"> {{ $person[0]->ininame }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4 ">
                                                            <div class="profiletext">NIC</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1">
                                                            {{ $person[0]->nic }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Permanant <br> Address</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1"> {{ $person[0]->paddress }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Residence<br> Address</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1">
                                                            {{ $person[0]->raddress }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Phone Home</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1"> {{ $person[0]->hphone }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">Phone Mobile</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1">
                                                            {{ $person[0]->mphone }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">WhatsApp</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1">
                                                            {{ $person[0]->wphone }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="profiletext">E-Mail</div>
                                                        </div>
                                                        <div class="col-8 tbox mb-1"> {{ $person[0]->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @if (isset($job))
                                                <div id="job" class="tabss d-none">

                                                    <div class="container-fluid py-2 px-0">
                                                        <div class="row ">
                                                            <div class="col-5">
                                                                <div class="profiletext">
                                                                    Job No:</div>
                                                            </div>
                                                            @php
                                                                $i = 0;
                                                            @endphp
                                                            <div class="col-7  mb-1 p-0">
                                                                @foreach ($job as $row)
                                                                    @if ($i == 0)
                                                                        <button class="btn btn-warning m-1 regno"
                                                                            id={{ $i }}
                                                                            data={{ $i }}>
                                                                            {{ $row->regno }} </button>
                                                                    @else
                                                                        <button class="btn btn-secondary m-1 regno"
                                                                            id={{ $i }}
                                                                            data={{ $i }}>
                                                                            {{ $row->regno }}</button>
                                                                    @endif
                                                                    @php
                                                                        $i++;
                                                                    @endphp
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="profiletext">Job Type</div>
                                                            </div>
                                                            <div class="col-7 tbox mb-1" id="jobtype">
                                                                {{ $job[0]->jobtype }}
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-5 ">
                                                                <div class="profiletext">Date Registered</div>
                                                            </div>
                                                            <div class="col-7 tbox mb-1" id="regdate">
                                                                {{ $job[0]->regdate }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="profiletext">Price</div>
                                                            </div>
                                                            <div class="col-7 tbox mb-1" id="jobprice">
                                                                {{ $job[0]->amount }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="profiletext">Exam Date</div>
                                                            </div>
                                                            <div class="col-7 tbox mb-1"id="exadate">
                                                                {{ $job[0]->examdate }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="profiletext">Exam Status</div>
                                                            </div>
                                                            <div class="col-7 tbox mb-1" id="exstatus">
                                                                {{ $job[0]->examstatus }}
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="profiletext">L Permit No</div>
                                                            </div>
                                                            <div class="col-7 tbox mb-1" id="lpno">
                                                                {{ $job[0]->lpermitno }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="profiletext">L Permit Issued</div>
                                                            </div>
                                                            <div class="col-7 tbox mb-1" id="lpidate">
                                                                {{ $job[0]->lpermitdate }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="profiletext">L Permit Expired</div>
                                                            </div>
                                                            <div class="col-7 tbox mb-1" id="lpedate">
                                                                {{ $job[0]->lpermitexp }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="profiletext">Trail Date</div>
                                                            </div>
                                                            <div class="col-7 tbox mb-1" id="tridate">
                                                                {{ $job[0]->trialdate }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="profiletext">Job Status</div>
                                                            </div>
                                                            <div class="col-7 tbox mb-1" id="jstatus">
                                                                {{ $job[0]->jobstatus }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div id="doc" class="tabss d-none">
                                                    <div class="container-fluid py-2 px-0">
                                                        <div class="row ">
                                                            <div class="col-5">
                                                                <div class="profiletext">
                                                                    Job No:</div>
                                                            </div>
                                                            @php
                                                                $i = 0;
                                                            @endphp
                                                            <div class="col-7  mb-1 p-0">
                                                                @foreach ($job as $row)
                                                                    @if ($i == 0)
                                                                        <button class="btn btn-warning m-1 regno "
                                                                            id={{ $i }}
                                                                            data={{ $i }}>
                                                                            {{ $row->regno }} </button>
                                                                    @else
                                                                        <button class="btn btn-secondary m-1 regno "
                                                                            id={{ $i }}
                                                                            data={{ $i }}>
                                                                            {{ $row->regno }}</button>
                                                                    @endif
                                                                    @php
                                                                        $i++;
                                                                    @endphp
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3">
                                                                Doc
                                                            </div>

                                                            <div class="col-3  mb-1"> SN
                                                            </div>
                                                            <div class="col-3  mb-1"> Recieved
                                                            </div>
                                                            <div class="col-3  mb-1"> Date Recieved
                                                            </div>
                                                        </div>
                                                        @php
                                                            $j = 0;
                                                        @endphp
                                                        @foreach ($doc as $row)
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <div class="profiletext">{{ $row->doctype }}</div>
                                                                </div>

                                                                {{-- <div class="col-1 tbox mb-1"> {{$row->active}}
                                                        </div> --}}
                                                                <div class="col-3 tbox mb-1" id={{ $i . $j }}>
                                                                    {{ $row->sn }}
                                                                </div>
                                                                <div class="col-3 tbox mb-1" id={{ $i . $j }}>
                                                                    {{ $row->isrecieved }}
                                                                </div>
                                                                <div class="col-3 tbox mb-1" id={{ $i . $j }}>
                                                                    {{ $row->recived }}
                                                                </div>
                                                            </div>
                                                            @php
                                                                $i++;
                                                            @endphp
                                                        @endforeach



                                                    </div>
                                            @endif
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
   var x ;//={!! json_encode($job->toArray()) !!};
   var y ;//={!! json_encode($doc->toArray()) !!};

    $("#jobtype").html(x[i]["jobtype"])
    $("#regdate").html(x[i]["regdate"])
    $("#jobprice").html(x[i]["amount"])
    $("#exadate").html(x[i]["examdate"])
    $("#exstatus").html(x[i]["examstatus"])
    $("#lpno").html(x[i]["lpermitno"])
    $("#lpidate").html(x[i]["lpermitdate"])
    $("#lpedate").html(x[i]["lpermitexp"])
    $("#tridate").html(x[i]["trialdate"])
    $("#jstatus").html(x[i]["jobstatus"])

  });
});


        </script>
@endsection
