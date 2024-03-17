@extends('layouts.app')

@section('content')
    <!-- header -->
    @include('includes/header')
    <div class="container-fluid px-0">

        <div class="row justify-content-center ">
            <div class="col-12 col-md-2 p-0 " id="sbars">
                @include('includes/sidebarAdmin')
            </div>
            <div class="col-md-10 col-sm-12 d-flex flex-column h-sm-100 p-0" id="cont">

                <div class="card">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control " id="courseSelect">
                                    <option value=""> Select a Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" data-course="{{ $course->name }}">
                                            {{ $course->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary titlebutton" id="btnAddsubject"><i class="fa fa-plus"> Add
                                        Subject</i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-striped dt-responsive nowrap" id="subjectTable">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Subject Code</th>
                                    <th>Subject Name</th>
                                    <th>Teaching Hours</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Subjects will be populated dynamically using JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Add Subject Modal -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content bg-success">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="applicantModalLabel">Add Subjects</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-success text-light">
                    <input type="hidden" name="courseid" id="courseid">
                    <div class="form-group">
                        <label for="course">Course</label>
                        <input type="text" class="form-control text-capitalize" id="course" disabled>
                    </div>

                    <div class="form-group">
                        <label for="code">Subject Code</label>
                        <input type="text" class="form-control text-capitalize" id="code">
                    </div>

                    <div class="form-group">
                        <label for="name">Subject Name</label>
                        <input type="text" class="form-control text-capitalize" id="name">
                    </div>

                    <div class="form-group">
                        <label for="hours">Teaching Hours</label>
                        <input type="text" class="form-control" id="hours">
                        {{-- @error('hours')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>

                </div>
                <div class="text-center bg-success pb-3 btn-group px-5">


                    <button type="button" class="btn btn-danger  d-inline addBtn" id="addSubject">Add</button>
                    <button type="button" class="btn btn-secondary d-inline" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script  type="application/javascript">
   $(document).ready(function () {
    var SITEURL = "{{ url('/') }}";
    var subjectTable;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function initSubjectTable(courseId) {
        subjectTable.clear().draw();
        $.ajax({
            url: SITEURL + '/fetchSubjects/' + courseId,
            method: 'GET',
            data: function (d) {
                d.courseid = $('#courseSelect').val(); // Pass the selected courseid
            },
            success: function (response) {
                subjectTable.rows.add(response).draw();
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    

    subjectTable = $('#subjectTable').DataTable({
        destroy:true,          
        "language": 
                    {        
                        "processing": "<h4 class='mt-5 text-success'>Loading. Please wait...</h4>",
                    },
        processing: true,
        retrieve: true,
                          // serverSide: true,
                          "autoWidth": true,
    "fixedHeader": true,
    "rowCallback": function (nRow, aData, iDisplayIndex) {
        // ... Set the row number for the first column ...
    },
       data: [], // Initialize with empty data
        columns: [
            { 
            data: null,
            render: function (data, type, row, meta) {
                return meta.row + 1;
            }
        },
        
            { data: 'code' },
            { data: 'name' },
            { data: 'hours' },
            {
            data: null,
            render: function (data, type, row) {
                var deleteButton = '<button class="btn btn-danger btn-sm deleteSubject" data-subjectid="' + data.id + ' data-courseid="' + data.courseid + '">Delete</button>';
                return deleteButton;
            }
        }
            // ... Other columns ...
        ]
    });

    $('#courseSelect').off().on('change', function () {
        var courseId = $(this).val();
        initSubjectTable(courseId);
        // ... Your other code ...
    });
    $('#subjectTable').off().on('click', '.deleteSubject', function () {
    var subjectId = $(this).data('subjectid');
    var row = $(this).closest('tr');
    if (confirm('Are you sure you want to delete this subject?')) {
        $.ajax({
            url: '/delete-subject/' + subjectId, // Replace with your route
            type: 'DELETE',
            success: function () {
                subjectTable.row(row).remove().draw();
            },
            error: function (error) {
                console.error(error);
            }
        });
    }
});
//var course_id = null; // Store the course ID
$('#btnAddsubject').off().on('click', function(event){
    
    var selectedOption = $('#courseSelect option:selected');
        var course_id = selectedOption.val();
        var course_name = selectedOption.data('course');

    
    if(course_id==""){
       
       
        displayError("Please select a course");
       return;
    }else{

        $('#addSubjectModal').modal('show');
        $('#courseid').val(course_id);
        $('#course').val(course_name);
    }
});


// Event handler for Add button
$('#addSubject').off().on('click', function () {
    var course_id= $('#courseid').val();
    var code = $('#code').val();
    var name = $('#name').val();
    var hours = $('#hours').val();

    // Perform an AJAX request to add subject
    $.ajax({
        url: '/add-subject', // Replace with your server-side route
        method: 'POST',
        data: {
            courseid: course_id,
            code: code,
            name: name,
            hours: hours,
            // Add other data fields if needed
        },
        success: function (response) {
            // If addition was successful, close the modal and reset form
            $('#addSubjectModal').modal('hide');
            $('#code').val('');
            $('#name').val('');
            $('#hours').val('');
            initSubjectTable(course_id);
        },
        error: function (error) {
            var a = JSON.parse(error.responseText);
            a=a.errors;
            var errorMessages = [];
        
        if (a.code) {
            errorMessages = errorMessages.concat(a.code);
        }
        
        if (a.name) {
            errorMessages = errorMessages.concat(a.name);
        }
        
        if (a.hours) {
            errorMessages = errorMessages.concat(a.hours);
        }
        
        errorMessages.forEach(function (error) {
            displayError(error);
        });
        
        }
    });
});
            function displayMessage(message) {
                    toastr.success(message, 'Event');            
                }
                function displayError(message) {
                    toastr.error(message, 'Event');             
                }
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
