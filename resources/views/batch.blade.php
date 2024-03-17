@extends('layouts.app')

@section('content')
    <!-- header -->
    @include('includes/header')
    {{-- startdate modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="sdates">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-success text-light">
                    <h5 class="modal-title text-capitalized" id="hheader">start date</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  bg-success text-light">
                    <div class="form-group">

                        <input type="date" class="form-control" id="startDate">
                    </div>
                </div>
                <input type="hidden" id="mact">
                <input type="hidden" id="mid">
                <input type="hidden" id="period">
                <div class="modal-footer  bg-success text-light">
                    <button type="button" class="btn btn-primary" id='btnUpdate' data-bs-dismiss="modal">Save
                        changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <div class="container-fluid px-0">

        <div class="row justify-content-center ">
            <div class="col-12 col-md-2 p-0 " id="sbars">
                @include('includes/sidebarAdmin')
            </div>
            <div class="col-md-10 col-sm-12 d-flex flex-column h-sm-100 p-0" id="cont">

                <div class="card">
                    <div class="card-header">
                        <h4 class="titleheader_">{{ __('Batch Details') }}</h4>

                        <div class="dropdown titlebutton ">
                            <button class="btn btn-info  dropdown-toggle" type="button" id="batchstatusDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Batch Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="batchstatusDropdown">
                                <a class="dropdown-item" href="#" data-batchstatus="">All</a>
                                <a class="dropdown-item" href="#" data-batchstatus="not started">Not Started</a>
                                <a class="dropdown-item" href="#" data-batchstatus="locked">Locked</a>
                                <a class="dropdown-item" href="#" data-batchstatus="on going">On Going</a>
                                <a class="dropdown-item" href="#" data-batchstatus="completed">Completed</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div id='display'>
                            <table class="table table-hover table-striped dt-responsive nowrap" id='dtable'
                                width='100%'>
                                <thead>
                                    <tr class='mgttableHead'>
                                        <th scope="col" width="60">#</th>
                                        <th scope="col" width="50px" class="text-capitalize">code</th>
                                        <th scope="col" class="text-capitalize">batch</th>
                                        <th scope="col" class="text-capitalize "width="100">fee</th>
                                        <th scope="col" class="text-capitalize " width="100">reg fee</th>
                                        <th scope="col" class="text-capitalize" width="60">type</th>
                                        <th scope="col" class="text-capitalize" width="100">days</th>
                                        <th scope="col" class="text-capitalize" width="60">period</th>
                                        <th scope="col" class="text-capitalize" width="60">start</th>
                                        <th scope="col" class="text-capitalize" width="60">install</th>
                                        <th scope="col" class="text-capitalize" width="60">basic</th>
                                        <th scope="col" class="text-capitalize" width="60" class="borders">action
                                        </th>

                                    </tr>
                                </thead>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script  type="application/javascript">

        $(document).ready(function () {
            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        var batchtable=$('#dtable').DataTable({
            responsive: true,
                columnDefs: [

                            { responsivePriority: 1, targets: 0 },
                            { responsivePriority: 2, targets: 1 },
                            { responsivePriority: 3, targets: 6 },
                            { responsivePriority: 4, targets: 2 },
                            { responsivePriority: 5, targets: 5 },
                            { responsivePriority: 6, targets: 4 },
                ],
                    "language":
                    {
                        "processing": "<h4 class='mt-5 text-success'>Loading. Please wait...</h4>",
                    },
                    processing: true,
                    retrieve: true,
                    serverSide: true,
                    "autoWidth": true,
                    "fixedHeader": true,
                    "rowCallback": function (nRow, aData, iDisplayIndex) {
                        var oSettings = this.fnSettings ();
                        $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                        return nRow;
        },

             ajax:{
                url:'batch/fetchdata' ,
                type: 'GET',
                data: function (d) {
                    d.batchstatus = $('#batchstatusDropdown').data('batchstatus');
                }
            }
              ,
             columns:[
                { data: 'batchstatus' },
                { data: 'courseid' },
                 {data: 'id'},
                 { data: 'fee' },
                 { data: 'regFee' },
                 { data: 'public' },
                 { data: 'daysperweek' },
                 { data: 'duration' },
                 { data: 'startdate' },
                 { data: 'installment' },
                 { data: 'basepayment' },
                 { data: 'batchstatus' ,render: (data,type,row) => {
                   // alert(row.id);
                    var x="";
                    var url = "{{ route('applicant.show', ['batch_id' => ':id']) }}";
                        url = url.replace(':id', row.id);
                    var url1 = "{{ route('batch.subject', ['batch_id' => ':id']) }}";
                        url1 = url1.replace(':id', row.id);
                    var x=` <div class="btn-group " >

                        <a href="${url}" class="btn btn-info btn-sm viewApplicants"
                          data-row="${row.id}"
                        data-code="${row.code}"
                        data-name="${row.name}"><i class="fa fa-eye">
                            </i>
                    </a>
                    <a href="${url1}" class="btn btn-warning btn-sm viewsubject"
                          data-row="${row.id}"
                        data-code="${row.code}"
                        data-name="${row.name}"><i class="fa fa-book" ></i>
                    </a>`;
                    if(row.batchstatus=="not started"){

                        x=x+  `

                    <a href="" class="btn btn-success  btn-sm del"
                    // data-toggle="modal" data-target="#sdate"
                        data-act="on going"
                        data-row="${row.id}"
                        data-period="${row.duration}"
                        ><i class="fas fa-power-off ">
                            &nbsp;start &nbsp;</i>
                    </a>
                    `;
                   }
                    else  if(row.batchstatus=="on going")
                    {
                        x=x+ `


                    <a href="" class="btn btn-danger btn-sm del "

                        data-act="locked"
                        data-row="${row.id}"
                       ><i class="fa-solid fa-lock-open">
                        &nbsp;Lock &nbsp;&nbsp;&nbsp;</i>
                    </a>



                    </div>`;
                    }else  if(row.batchstatus=="locked")
                    {
                        x=x+ `


                    <a href="" class="btn btn-info btn-sm del "

                        data-act="completed &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                        data-row="${row.id}"
                       ><i class="fa-duotone fa-flag-checkered">
                        &nbsp;&nbsp;&nbsp;&nbsp;Finish&nbsp;&nbsp;&nbsp;&nbsp;</i>
                    </a>



                    `;
                    }
                     else if(row.batchstatus=="completed"){
                        x+=`<button href="" class="btn btn-secondary btn-sm del"
                       disabled>
                        <i>&nbsp;&nbsp;completed&nbsp;&nbsp;</i>
                  </button>
                       `;
                    }
                    x=x+` </div>`;
                    return x;
                 }}

             ]
            });

            $('.dropdown-item').on('click', function () {
               // alert("hi");
            var batchstatus = $(this).data('batchstatus');
            $('#batchstatusDropdown').data('batchstatus', batchstatus);
            $('#batchstatusDropdown').html($(this).html());
            batchtable.ajax.reload();
        });


            $('#dtable').off().on('click', '.del',function(event){

                event.preventDefault();
                var id=$(this).data("row");
                var stat=$(this).data("act");
               var period=$(this).data("period");

                        $("#sdates").modal("toggle");
                        $('#mact').val(stat);
                        $('#mid').val(id);
                        $('#period').val(period);
                       // alert(moment().format("yyy-MM-DD"));
                       var today=moment().format("yyyy-MM-DD");
                        $('#startDate').val(today);
                        if(stat=="completed")
                        {
                            $('#hheader').html("End Date");
                            $("#startDate").attr({"min":today});
                        }else  if(stat=="on going")
                        {
                            $('#hheader').html("Start Date");

                            $("#startDate").attr({"max":today});;
                          }
                          if(stat=="locked")
                        {
                            $('#hheader').html("lock Date");
                            //$("#startDate").attr({"max":today});;
                          }


            });
            $('#btnUpdate').off().on("click",function(){
                var mact=$('#mact').val();
                var mid=$('#mid').val();
                var sdate=$('#startDate').val();
                 var enddate=moment(sdate,"yyyy-MM-DD").add($('#period').val(),"weeks").format("yyyy-MM-DD");;

                $.ajax({
                            url: '/batch/disable',
                            type: 'post',
                            data: {
                                'act':mact,
                                'id': mid,
                                'sdate':sdate,
                                "edate":enddate
                            },
                            success: function (data) {
                                    $('#dtable').DataTable().ajax.reload();
                                    displayMessage("status updated.");
                                },
                                 error: function (error) {
                                    displayError(error.responseJSON.message)

                                }
                        });



            });
                function displayMessage(message) {
                    toastr.success(message, 'Event');
                }
                function displayError(message) {
                    toastr.error(message, 'Event');
                }
            //     $(document).on('click', '.viewApplicants', function() {
            //         //  var batchId = $(this).data('row');
            //         //  window.location.href = '/get_Applicant/' + batchId;
            //         e.preventDefault();
            //         var batch_id = $(this).data('batch-id');
            //         var url = $(this).attr('href');
            //         $.ajax({
            //             url: url,
            //             type: 'get',
            //             data: {batch_id: batch_id},
            //             success: function(data) {
            //                 // display the applicant data in the data table
            //             },
            //             error: function(xhr) {
            //                 alert('Error: ' + xhr.responseText);
            //             }
            //         });



            // });

        });

    </script>
@endsection

@push('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/dmuy/MDTimePicker@2.0.0/dist/mdtimepicker.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css" /> --}}
@endpush
