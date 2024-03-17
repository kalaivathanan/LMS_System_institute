@extends('layouts.app')

@section('content')
    <!-- header -->
    @include('includes/header')
    <div class="modal fade" id="courseModel" tabindex="-1" role="dialog" aria-labelledby="eventModelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-success text-light">
                <div class="modal-header bg-success text-light ">
                    <h5 class="modal-title " id="eventModelLabel">Create Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-success text-light">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="coursetitle">Course Title</label>
                                    <input type="text" class="form-control" id="coursetitle">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="corusecode">course code</label>
                                    <input type="text" class="form-control" id="corusecode">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="coursehours">course Hourse</label>
                                    <input class="form-control" type="text" id="coursehours">
                                </div>
                            </div>

                            <div class="col-12 col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="coursetype">course type</label>

                                    <select class="form-control" id="coursetype">
                                        <option value="Fulltime">Full Time</option>
                                        <option value="PartTime">Part Time</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coursedesc">course description</label>
                            <input class="form-control" type="text" id="coursedesc">

                        </div>

                    </div>



                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <div class="form-group">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"
                                    id="btnAdd">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="startModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Create Batch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body bg-success text-light">
                    <div class="container-fluid">
                        <div class="row">
                            <input type="hidden" id="cid">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="coursecode">Course Code</label>
                                    <input type="text" class="form-control" id="coursecode" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="corusetitle">Course Title</label>
                                    <input type="text" class="form-control" id="corusetitle" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="courseFee">Course Fee</label>
                                    <input type="text" class="form-control" id="courseFee">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="basepayment">Base payment</label>
                                    <input class="form-control" type="text" id="basepayment">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="noinstall">No of installment</label>
                                    <input class="form-control" type="text" id="noinstall">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="regFee">Registration Fee</label>
                                    <input type="text" class="form-control" id="regFee">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="duration">duration</label>
                                    <input class="form-control" type="text" id="duration">
                                </div>
                            </div>

                            <div class="col-12 col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="batchtype">Batch type</label>

                                    <select class="form-control" id="batchtype">
                                        <option value="Fulltime">Regular</option>
                                        <option value="PartTime">Special</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-4 mb-2">
                                {{-- <div class="form-group">
                                    <label for="startDate">Start Date</label>
                                    <input type="date" class="form-control" id="startDate">
                                </div> --}}
                            </div>
                            <div class="col-12 col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="dayperweek">Days per week</label>
                                    <input class="form-control" type="text" id="dayperweek">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 mb-2">
                                {{-- <div class="form-group">
                                    <label for="startDate">Start Date</label>
                                    <input type="date" class="form-control" id="startDate">
                                </div> --}}
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-success text-light text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnBatch" data-dismiss="modal">Create
                        Batch</button>
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
                        <h4 class="titleheader_">{{ __('Course Details') }}</h4>
                        <a href="" class=" btn titlebutton" data-toggle="modal" data-target="#courseModel"><i
                                class="fa fa-plus"> Create
                                course</i></a>
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
                                        <th scope="col" width="100" class="text-capitalize">code</th>
                                        <th scope="col" class="text-capitalize">name</th>
                                        <th scope="col" class="text-capitalize ">description</th>
                                        <th scope="col" class="text-capitalize" width="60">type
                                        </th>
                                        <th scope="col" class="text-capitalize" width="60">hours</th>
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
    {{-- <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="application/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="application/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script type="application/javascript" src="https://cdn.datatables.net/plug-ins/1.13.2/dataRender/ellipsis.js"></script> --}}
    {{-- <script type="application/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script type="application/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.colVis.min.js"></script>
    <script type="application/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script> --}}
    <script  type="application/javascript">
    
        $(document).ready(function () {
            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });  
            $('#dtable').DataTable({
               
                columnDefs: [ { targets: 3, render: $.fn.dataTable.render.ellipsis( 50 )} ,
      { responsivePriority: 1, targets: 0 },
    { responsivePriority: 2, targets: 1 },
    { responsivePriority: 3, targets: 6 },
    { responsivePriority: 4, targets: 2 },
    { responsivePriority: 5, targets: 5 },
    { responsivePriority: 6, targets: 4 },
],
             processing: true,
             "language": 
            {        
                "processing": "<h4 class='mt-5 text-success'>Loading. Please wait...</h4>",
            },
             retrieve: true,
             serverSide: true,
             ajax: 'course/fetchdata',
             columns:[
                 {data: 'id'},
                 { data: 'code' },
                 { data: 'name' },
                 { data: 'description' },
                 { data: 'type' },
                 { data: 'nortionlHours' },
                 { data: 'status' ,render: (data,type,row) => {
                    if(row.status=="deleted"){
                        return ` <div class="btn-group">  
                                            
                    <button href="" class="btn btn-secondary btn-sm startBatch"
                       
                         disabled><i class="fa fa-edit">
                            start</i>
                    </button>
                    <a href="" class="btn btn-success btn-sm del"
                        data-act="active"
                        data-row="${row.id}"
                        data-code="${row.code}"
                        data-name="${row.name}"><i class="fas fa-power-off ">
                            &nbsp;enable &nbsp;</i>
                    </a>
                    </div>`;
                   }
                    else
                    {
                        return `<div class="btn-group">

                                    
                    <a href="" class="btn btn-info btn-sm startBatch"
                        data-toggle="modal" data-target="#startModel"                       
                        data-row="${row.id}"
                        data-code="${row.code}"
                        data-name="${row.name}"><i class="fa fa-edit">
                            start</i>
                    </a>
                    <a href="" class="btn btn-danger btn-sm del"
                        data-act="deleted"
                        data-row="${row.id}"
                        data-code="${row.code}"
                        data-name="${row.name}"><i class="fa fa-trash">
                            Disable</i>
                    </a>


                    </div>`;
                    } 
                 }}
                 
             ]
            });

          
        
            $("#btnAdd").off().on("click",function(){
                
                    var name=$('#coursetitle').val();
                    var code=$('#corusecode').val();
                    var nortionlHours=$('#coursehours').val();
                    var type=$('#coursetype').val();
                    var description=$('#coursedesc').val();
                  
                   
                    $.ajax({
                                url: SITEURL + "/cour",
                                
                                data: {
                                    name,
                                    code,
                                    nortionlHours,
                                    type ,
                                    description,                              
                                },
                                type: "POST",
                                success: function (data) {
                                    $('#dtable').DataTable().ajax.reload();
                                    displayMessage("course created.");                                                                                                                                    
                                },
                                 error: function (error) {                                 
                                    displayError(error.responseJSON.message)
                                    $("#courseModel").modal('hide');
                                }                                
                            });
                            //return false;
            });  
            $('#dtable').off().on('click', '.del',function(event){
                event.preventDefault();
                var code=$(this).data("code");
                var stat=$(this).data("act");
                $.ajax({
                            url: '/course/disable',
                            type: 'post',
                            data: {
                                'act':stat,
                                'code': code
                            },
                            success: function (data) {
                                    $('#dtable').DataTable().ajax.reload();
                                    displayMessage("course status changed.");                                                                                                                                    
                                },
                                 error: function (error) {                                 
                                    displayError(error.responseJSON.message)
                                   
                                }        
                        });
                
            });
    $('#display').off().on('click', '.startBatch',function(event){
           $("#cid").val($(this).data('row'));
           $("#corusetitle").val($(this).data('name'));
           $("#coursecode").val($(this).data('code'));
           
           });
           $("#btnBatch").off().on("click",function(){
                
                var cid=$('#cid').val();
                var coursecode=$('#coursecode').val();
                var courseFee=$('#courseFee').val();
                var basepayment=$('#basepayment').val();
                var noinstall=$('#noinstall').val();
                var duration=$('#duration').val();
                var regFee=$('#regFee').val();
                var batchtype=$('#batchtype').val();
                // var startDate=$('#startDate').val();
                var dayperweek=$('#dayperweek').val(); 
              //  alert(basepayment);
                $.ajax({
                            url: SITEURL + "/addbatch",
                            
                            data: {
                                cid,
                                coursecode,
                                courseFee,
                                basepayment,
                                noinstall ,
                                duration,
                                regFee ,
                                batchtype,
                               // startDate,
                                dayperweek,
                                                              
                            },
                            type: "POST",
                            success: function (data) {
                                displayMessage("batch created.");                                                                                                                                    
                            },
                             error: function (error) {  
                                console.log(error) ;                              
                                displayError(error.responseJSON.message)
                               // $("#courseModel").modal('hide');
                            }                                
                        });
                        //return false;
        });  
            function displayMessage(message) {
                    toastr.success(message, 'Event');            
                }
                function displayError(message) {
                    toastr.error(message, 'Event');             
                }
                $(document).on("click", "button.del", function() {
                    alert("dfd");
                });
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
