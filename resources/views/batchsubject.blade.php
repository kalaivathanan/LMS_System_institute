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
                                <h4 id="title" data-batch={{ $courses[0]->id }}>
                                    {{ $courses[0]->coursecode }}_{{ $courses[0]->id }}
                                    ({{ $courses[0]->course->name }})</h4>
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
                                    <th>Teacher</th>
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
    <div class="modal " id="assign" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-success">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="assignModalLabel">Assign Teacher to Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-success text-light">
                    <input type="hidden" id="sid">
                    <div class="form-group">
                        <label for="courseDropdown">Subject Name</label>
                        <input type="text" id="subname" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="teacherdropdown">Select Teacher</label>
                        <select class="form-control" id="teacherdropdown">
                            <option value=""> Select a Teacher</option>
                            <!-- Options for subjects will be added here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" id="endDate">
                    </div>
                    <div class="form-group">
                        <label for="ratePerHour">Rate per Hour</label>
                        <input type="number" class="form-control" id="ratePerHour">
                    </div>
                </div>
                <div class="modal-footer bg-success text-light">
                    <button type="button" class="btn btn-primary" id="assignButton">Assign</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script  type="application/javascript">
   $(document).ready(function () {
    var SITEURL = "{{ url('/') }}";
    var subjectTable;
    var courseId=$("#title").data("batch");
    //initSubjectTable(2);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



var subjectTable = $('#subjectTable').DataTable({
    destroy: true,
    responsive: true,
    language: {
        processing: "<h4 class='mt-5 text-success'>Loading. Please wait...</h4>",
    },
    processing: true,
    retrieve: true,
    autoWidth: true,
    fixedHeader: true,
        ajax: {
            url: '/viewBatchsubject',
            data: { batch_id: courseId }, // Replace yourBatchId with the actual batch ID
            type: 'GET',
            dataType: 'json',
            dataSrc: 'data',
        },

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
                data: 'people', // Specify the path to the nested property

                render: function(data, type, row) {
                    if (data) {
                        return data.ininame; // Display ininame if people is not null
                    } else {
                        return '-'; // Display a message for null values
                    }
                }
            },

        // ... other columns ...
        { data: 'status' ,render: (data,type,row) => {
                   if(row.status=="inactive"){

                       return ` <div class="btn-group">

                   <button href="" class="btn btn-info btn-sm assign"

                        disabled><i class="fa fa-edit">
                           Assign</i>
                   </button>
                   <a href="" class="btn btn-success btn-sm del"
                       data-act="active"
                       data-row="${row.id}"
                       data-name="${row.name}"

                       ><i class="fas fa-power-off ">
                           &nbsp;enable &nbsp;</i>
                   </a>
                   </div>`;
                  }
                   else
                   {
                    if(row.people!=null){
                       return `<div class="btn-group">

                   <a href="" class="btn btn-secondary btn-sm assign"
                       data-toggle="modal" data-target="#assign"
                       data-row="${row.id}"
                       data-name="${row.name}"

                      "><i class="fa fa-edit">
                           Update</i>
                   </a>
                   <a href="" class="btn btn-danger btn-sm del"
                       data-act="inactive"
                       data-row="${row.id}"
                       ><i class="fa fa-trash">
                           Disable</i>
                   </a>

                   </div>`;
                }else{  return `<div class="btn-group">

<a href="" class="btn btn-primary btn-sm assign"
    data-toggle="modal" data-target="#assign"
    data-row="${row.id}"
    data-name="${row.name}"

   "><i class="fa fa-edit">
        Assign</i>
</a>
<a href="" class="btn btn-danger btn-sm del"
    data-act="inactive"
    data-row="${row.id}"
    ><i class="fa fa-trash">
        Disable</i>
</a>

</div>`;}
                   }
                }}
    ],columnDefs: [
                {
                    targets: [2], // Adjust the column index for ellipsis if needed
                    render: $.fn.dataTable.render.ellipsis(50),
                },
                { responsivePriority: 0, targets: 0 },

                { responsivePriority: 4, targets: 5 },
            ],
    });


$('#subjectTable').off().on('click', '.del',function(event){

    event.preventDefault();
   var batch=$(this).data("row");
   var stat=$(this).data("act");

// alert(stat);
// return;
   $.ajax({
               url: '/activatebatchsubject',
               type: 'post',
               data: {
                   'act':stat,
                   'batch': batch,

               },
               success: function (data) {
                       $('#subjectTable').DataTable().ajax.reload();
                       displayMessage("course status changed.");
                   },
                    error: function (error) {
                       displayError(error.responseJSON.message)

                   }
           });

});

$('#assign').off().on('show.bs.modal', function (event) {

                // var courseDropdown = $('#courseDropdown');
                 var button = $(event.relatedTarget);

               var selectedCourseId = $('#title').data("batch");//$(this).val();
                var teacherdropdown = $('#teacherdropdown');
                    $('#sid').val(button.data("row"));
                $('#subname').val(button.data("name"));
                // Fetch subjects for the selected course from Laravel controller
                $.ajax({
                    url: '/loadinstructor' ,
                    type: 'GET',
                    success: function (data) {
                    teacherdropdown.empty();
                    teacherdropdown.append($('<option>', {
                        value: '',
                        text: 'Select Teacher'
                    }));
                    $.each(data, function (index, subject) {
                        teacherdropdown.append($('<option>', {
                        value: subject.id,
                        text: subject.ininame
                        }));
                    });
                    teacherdropdown.prop('disabled', false);
                    }
                });
                });
$('#assignButton').off().on('click', function () {

   // alert( 'hi'+$('#sid').val());
    var courseDropdown = $('#courseDropdown');
  var teacherdropdown = $('#teacherdropdown');
  var ratePerHour = $('#ratePerHour');
  var startDate = $('#startDate');
  var endDate = $('#endDate');
  var subject=$('#sid');
// Reset any previous validation messages or styles
    $('.validation-error').remove();

    var isValid = true;
    var today = new Date(); // Get today's date
// Validate Course Dropdown
if (!subject.val()) {
        courseDropdown.after('<span class="validation-error text-danger">Unkown subject.</span>');
        isValid = false;
    }
    // Validate Course Dropdown
    if (!courseDropdown.val()) {
        courseDropdown.after('<span class="validation-error text-danger">Please select a course.</span>');
        isValid = false;
    }

    // Validate Subject Dropdown
    if (!teacherdropdown.val()) {
        teacherdropdown.after('<span class="validation-error text-danger">Please select a subject.</span>');
        isValid = false;
    }

    // Validate Rate per Hour
    if (!ratePerHour.val()) {
        ratePerHour.after('<span class="validation-error text-danger">Please enter the rate per hour.</span>');
        isValid = false;
    }

    // Validate Start Date
    if (!startDate.val()) {
        startDate.after('<span class="validation-error text-danger">Please enter a start date.</span>');
        isValid = false;
    } else {
        // Convert the input date to a Date object
        var startDateValue = new Date(startDate.val());

        // Compare the start date to today's date
        if (startDateValue < today) {
        startDate.after('<span class="validation-error text-danger">Start date should be today or later.</span>');
        isValid = false;
        }
    }

    // Validate End Date
    if (!endDate.val()) {
        endDate.after('<span class="validation-error text-danger">Please enter an end date.</span>');
        isValid = false;
    } else {
        // Convert the input date to a Date object
        var endDateValue = new Date(endDate.val());

        // Compare the end date to the start date
        if (endDateValue < startDateValue) {
        endDate.after('<span class="validation-error text-danger">End date should be equal to or greater than start date.</span>');
        isValid = false;
        }
    }

    // Additional custom validation logic can be added here

    // If all validations pass, proceed with the assignment
   var teacherid= $('#teacherdropdown').val()

    var selectedCourseId = $('#title').data('batch');
    var selectedSubjectId = $('#sid').val();;
    var ratePerHour = $('#ratePerHour').val();
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();
//alert(selectedCourseId);
    // Send data to Laravel controller to save in the database
    $.ajax({
        url: '/save-assignment', // Replace with the actual URL for saving data
        type: 'POST',
        data: {
        teacherid:teacherid,
        course_id: selectedCourseId,
        subject_id: selectedSubjectId,
        rate_per_hour: ratePerHour,
        start_date: startDate,
        end_date: endDate
        },
        success: function (response) {
        // Handle success
        $('#subjectTable').DataTable().ajax.reload();
        displayMessage(response.message);

      // $('#assign').modal('hide'); // Close the modal
      hideModal();
        },
        error: function (error) {
        // Handle error

        displayError(response.responseJSON.error);
        }
    });
});
function hideModal() {
  $("#assign").removeClass("in");
  $(".modal-backdrop").remove();
  $('body').removeClass('modal-open');
  $('body').css('padding-right', '');
  $("#assign").hide();
}

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
