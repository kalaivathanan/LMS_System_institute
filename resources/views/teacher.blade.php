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


                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary titlebutton" id="btnAcademic" data-toggle="modal"
                                    data-target="#addAcademicModal"><i class="fa fa-plus"> Add
                                        Academic</i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-striped dt-responsive nowrap" id='instructorTable'
                            width='100%'>
                            <thead>
                                <tr>
                                    <th width="10">#</th>
                                    <th class="text-capitalize">Name</th>
                                    <th class="text-capitalize" width="100">NIC</th>
                                    <th class="text-capitalize" width="50">Gender</th>
                                    <th width="100">Phone</th>
                                    <th width="100">WhatsApp</th>
                                    <th class="text-capitalize" width="100">Email</th>
                                    <th class="text-capitalize" width="100">RFId</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Add Subject Modal -->
    <div class="modal fade" id="addAcademicModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content bg-success">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="applicantModalLabel">Academic Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-success text-light">
                    <input type="hidden" name="iid" id="iid">
                    <input type="hidden" name="ucheck" id="ucheck" value="invalid">
                    <div class="form-group">
                        <label for="fullname">User Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="username">
                            <button class="btn btn-warning" type="button" id="btnCheck">Check</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control text-capitalize" id="fullname" disabled>
                    </div>

                    <div class="form-group">
                        <label for="ininame">INI Name</label>
                        <input type="text" class="form-control text-capitalize" id="ininame" disabled>
                    </div>

                    <div class="form-group">
                        <label for="nic">NIC</label>
                        <input type="text" class="form-control text-capitalize" id="nic" disabled>
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" disabled>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input type="text" class="form-control text-capitalize" id="gender" disabled>
                    </div>

                    <div class="form-group">
                        <label for="paddress">Postal Address</label>
                        <input type="text" class="form-control text-capitalize" id="paddress" disabled>
                    </div>

                    <div class="form-group">
                        <label for="raddress">Residential Address</label>
                        <input type="text" class="form-control text-capitalize" id="raddress" disabled>
                    </div>

                    <div class="form-group">
                        <label for="hphone">Home Phone</label>
                        <input type="text" class="form-control" id="hphone" disabled>
                    </div>

                    <div class="form-group">
                        <label for="mphone">Mobile Phone</label>
                        <input type="text" class="form-control" id="mphone" disabled>
                    </div>

                    <div class="form-group">
                        <label for="wphone">Work Phone</label>
                        <input type="text" class="form-control" id="wphone" disabled>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" disabled>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control text-capitalize" id="status" disabled>
                    </div>
                </div>



                <div class="text-center bg-success pb-3 btn-group px-5">


                    <button type="button" class="btn btn-primary  d-inline newBtn" id="newBtn" disabled>Save</button>
                    <button type="button" class="btn btn-secondary d-inline" data-dismiss="modal">Close</button>
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

        $('#instructorTable').DataTable({

            processing: true,
            language: {
                processing: "<h4 class='mt-5 text-success'>Loading. Please wait...</h4>",
            },
            retrieve: true,
            serverSide: true,
            // Add your AJAX URL for fetching data from the server here
            ajax: '/fetchInstructor',
            columns: [
                {data: 'id' },
                { data: 'fullname' },
                { data: 'nic' },
                { data: 'gender' },
                { data: 'mphone' },
                { data: 'wphone' },
                { data: 'email' },
                {data: 'device_id'},
               // {data: 'uid'},
                // { data: 'ininame' },
                // { data: 'regno' },
                // { data: 'dob' },                //
                // { data: 'paddress' },
                // { data: 'raddress' },
                // { data: 'hphone' },
                // { data: 'mphone' },
                // { data: 'wphone' },
                // { data: 'email' },
                // { data: 'status' },
                { data: 'status' ,render: (data,type,row) => {
                   if(row.status=="inactive"){
                       return ` <div class="btn-group">
                        <a href="" class="btn btn-warning btn-sm view"
                        data-toggle="modal" data-target="#addAcademicModal"
                          data-row="${row.uid}"
                        data-code="${row.nic}"
                        ><i class="fa fa-eye">View
                            </i>
                    </a>

                   <a href="" class="btn btn-success btn-sm del"
                       data-act="active"
                       data-row="${row.uid}"
                       data-nic="${row.nic}"
                       ><i class="fas fa-power-off ">
                           &nbsp;enable &nbsp;</i>
                   </a>
                   </div>`;
                  }
                   else
                   {
                       return `<div class="btn-group">
                        <a href="" class="btn btn-warning btn-sm view"
                         data-toggle="modal" data-target="#addAcademicModal"
                          data-row="${row.uid}"
                        data-code="${row.nic}"
                        ><i class="fa fa-eye">View
                            </i>
                    </a>


                   <a href="" class="btn btn-danger btn-sm del"
                       data-act="inactive"
                       data-row="${row.uid}"
                       data-code="${row.code}"
                       data-name="${row.name}"><i class="fa fa-trash">
                           Disable</i>
                   </a>


                   </div>`;
                   }
                }}
            ],
            columnDefs: [
                {
                    targets: [1], // Adjust the column index for ellipsis if needed
                    render: $.fn.dataTable.render.ellipsis(50),
                },
                { responsivePriority: 0, targets: 0 },
                { responsivePriority: 2, targets: 1 },
                { responsivePriority: 3, targets: 7 },
                { responsivePriority: 4, targets: 2 },
                { responsivePriority: 5, targets: 4 },
                { responsivePriority: 6, targets: 5 },
                { responsivePriority: 7, targets: 6 },
                { responsivePriority: 8, targets: 3 },
            ],
           });

        $('#btnCheck').off().on('click', function () {
                var username = $('#username').val();
                //alert(username);
                // Perform client-side validation
                if (isValidUsername(username)) {
                    // Username is valid, make an AJAX request to check if it's already in use
                    checkUsernameAvailability(username);
                } else {
                displayError("invalid Username.Only letters,numbers and underscore");
                }
            });
        function isValidUsername(username) {
            // Implement your username validation logic here
            // Example: Check if the username meets certain criteria
            return /^[a-zA-Z0-9_]+$/.test(username); // Example: Only allow letters, numbers, and underscores
        }
        $('.view').off().on('click', function (event) {
            event.preventDefault();
            $('#addAcademicModal').show();
        });
        $('#addAcademicModal').off().on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            if (!button.hasClass('view')) {
               //alert("hi")
                return;
            }
            $('#newBtn').prop('disabled', false);
            $('#newBtn').text('Edit');
            $('#username').prop('disabled', true);
                $('#btnCheck').prop('disabled', true);
                $('#newBtn').removeClass('updateBtn btn-primary newBtn').addClass( 'editBtn btn-danger')  ;

            var applicantId = button.data('row'); // Extract the applicant ID from data attribute of the button
        //  alert(applicantId);
        //  return;
            var modal = $(this); // Get the modal

            // Make an Ajax call to retrieve the applicant data from the server
            $.ajax({
                url: '/viewacademic',
                type: 'POST',
                data: {id: applicantId},
                dataType: 'json',
                success: function(data) {
                // Populate the input fields in the modal with the retrieved data
                modal.find('#username').val(data.getuser.username);
                modal.find('#iid').val(data.id);
                modal.find('#fullname').val(data.fullname);
                modal.find('#ininame').val(data.ininame);
                modal.find('#nic').val(data.nic);
                modal.find('#dob').val(data.dob);
                modal.find('#gender').val(data.gender);
                modal.find('#paddress').val(data.paddress);
                modal.find('#hphone').val(data.hphone);
                modal.find('#mphone').val(data.mphone);
                modal.find('#wphone').val(data.wphone);
                modal.find('#email').val(data.email);
                modal.find('#status').val(data.status);
                modal.find('#raddress').val(data.raddress);

                 // Set the values of other input fields here paddress
                },
                error: function() {
                alert('Error: Could not retrieve applicant details.');
                }
            });
        });
    function checkUsernameAvailability(username) {
        // Make an AJAX request to the server to check if the username is available
        $.ajax({
            url: '/check-username-availability', // Replace with your server-side endpoint
            method: 'POST',
            data: { username: username },
            success: function (response) {
                if (response.available) {
                    // Username is
                    displayMessage( " Username is available");
                    $('#username').prop('disabled', true);
                    $('#btnCheck').prop('disabled', true);
                    $('#fullname').prop('disabled', false);
                    $('#ininame').prop('disabled', false);
                    $('#nic').prop('disabled', false);
                    $('#dob').prop('disabled', false);
                    $('#gender').prop('disabled', false);
                    $('#paddress').prop('disabled', false);
                    $('#raddress').prop('disabled', false);
                    $('#hphone').prop('disabled', false);
                    $('#mphone').prop('disabled', false);
                    $('#wphone').prop('disabled', false);
                    $('#email').prop('disabled', false);
                    $('#status').prop('disabled', true);
                    $('#status').val("inactive");
                    $('#ucheck').val("valid");
                    $('.newBtn').prop('disabled', false);
                    $('#fullname').focus();
                } else {
                    // Username is not available
                    displayError("User name allready Taken");

                }
            },
            error: function () {
                // Handle AJAX error if needed
                displayError('Error checking username availability.');
            }
        });
    }
        $('#addAcademicModal').on('hidden.bs.modal', function (event) {
            clearModal();
            $('#newBtn').prop('disabled', true);
            $('#username').prop('disabled', false);
            $('#btnCheck').prop('disabled', false);
            $('#fullname').prop('disabled', true);
            $('#ininame').prop('disabled', true);
            $('#nic').prop('disabled', true);
            $('#dob').prop('disabled', true);
            $('#gender').prop('disabled', true);
            $('#paddress').prop('disabled', true);
            $('#raddress').prop('disabled', true);
            $('#hphone').prop('disabled', true);
            $('#mphone').prop('disabled', true);
            $('#wphone').prop('disabled', true);
            $('#email').prop('disabled', true);
            $('#status').prop('disabled', true);
            $('#instructorTable').DataTable().ajax.reload();
              $('#newBtn').text('Save');
            $('#newBtn').removeClass('updateBtn btn-danger editBtn').addClass( 'newBtn btn-primary')  ;

        });

        $('#addAcademicModal').off('click').on('click', '.newBtn', function(event) {

            if( $('#ucheck').val()=="invalid")
            {
                displayError('Error invalid username.');
                return;
            }
          var button = $(event.relatedTarget); // Button that triggered the modal

         //var applicantId =  $('#iid').val(); // Extract the applicant ID from data attribute of the button
         var modal = $(this); // Get the modal
         $.ajax({
                 url: '/addAcademic',
                 type: 'POST',
                 data: {
                     username: $('#username').val(),
                     fullname: $('#fullname').val().toLowerCase(),
                     ininame: $('#ininame').val().toLowerCase(),
                     nic: $('#nic').val(),
                     dob: $('#dob').val(),
                     gender: $('#gender').val().toLowerCase(),
                     paddress: $('#paddress').val().toLowerCase(),
                     raddress: $('#raddress').val().toLowerCase(),
                     hphone: $('#hphone').val(),
                     mphone: $('#mphone').val(),
                     wphone: $('#wphone').val(),
                     email: $('#email').val(),
                     status: $('#status').val()
                 },
                 dataType: 'json',
                 success: function(data) {
                     // Disable all the form fields again
                   //  console.log(data);
                     clearModal();

                     $('#username').prop('disabled', false);
                     $('#btnCheck').prop('disabled', false);
                     $('#fullname').prop('disabled', true);
                     $('#ininame').prop('disabled', true);
                     $('#nic').prop('disabled', true);
                     $('#dob').prop('disabled', true);
                     $('#gender').prop('disabled', true);
                     $('#paddress').prop('disabled', true);
                     $('#raddress').prop('disabled', true);
                     $('#hphone').prop('disabled', true);
                     $('#mphone').prop('disabled', true);
                     $('#wphone').prop('disabled', true);
                     $('#email').prop('disabled', true);
                     $('#status').prop('disabled', true);
                     displayMessage('Applicant data updated successfully.');
                 },
                 error: function(response) {
                     if (response.status === 422) {
                         var errors = response.responseJSON.errors;
                         var errorsHtml = '<ul>';

                         $.each(errors, function (key, value) {
                             errorsHtml += '<li>' + value[0] + '</li>'; // Only display the first error message for each field
                         });

                         errorsHtml += '</ul>';

                         // Display the errors to the user
                         displayError(errorsHtml);

                     } else {
                         displayError('Error: Could not insert academic details.');
                     }
                 }
             });
 });
 $('#addAcademicModal').on('click', '.editBtn', function(event) {
    event.preventDefault();
    $('#username').prop('disabled', true);
    $('#btnCheck').prop('disabled', true);
    $('#fullname').prop('disabled', false);
    $('#ininame').prop('disabled', false);
    $('#nic').prop('disabled', true);
    $('#dob').prop('disabled', false);
    $('#gender').prop('disabled', false);
    $('#paddress').prop('disabled', false);
    $('#raddress').prop('disabled', false);
    $('#hphone').prop('disabled', false);
    $('#mphone').prop('disabled', false);
    $('#wphone').prop('disabled', false);
    $('#email').prop('disabled', false);
    $('#status').prop('disabled', true);
    $('#newBtn').text('update');
    $('#newBtn').removeClass('newBtn btn-danger editBtn').addClass( 'updateBtn btn-primary')  ;

});
$('#addAcademicModal').on('click', '.updateBtn', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
            var applicantId =  $('#iid').val(); // Extract the applicant ID from data attribute of the button
            var modal = $(this); // Get the modal
            $.ajax({
                    url: '/editAcademic',
                    type: 'POST',
                    data: {
                        id: applicantId,
                        fullname: $('#fullname').val().toLowerCase(),
                        ininame: $('#ininame').val().toLowerCase(),
                        //nic: $('#nic').val(),
                        dob: $('#dob').val(),
                        gender: $('#gender').val().toLowerCase(),
                        paddress: $('#paddress').val().toLowerCase(),
                        raddress: $('#raddress').val().toLowerCase(),
                        hphone: $('#hphone').val(),
                        mphone: $('#mphone').val(),
                        wphone: $('#wphone').val(),
                        email: $('#email').val(),
                        status: $('#status').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Disable all the form fields again
                        $('#fullname').prop('disabled', true);
                        $('#ininame').prop('disabled', true);
                        $('#nic').prop('disabled', true);
                        $('#dob').prop('disabled', true);
                        $('#gender').prop('disabled', true);
                        $('#paddress').prop('disabled', true);
                        $('#raddress').prop('disabled', true);
                        $('#hphone').prop('disabled', true);
                        $('#mphone').prop('disabled', true);
                        $('#wphone').prop('disabled', true);
                        $('#email').prop('disabled', true);
                        $('#status').prop('disabled', true);


                        // Update the data in the modal with the updated data from the server
                        modal.find('#fullname').val(data.fullname);
                        modal.find('#ininame').val(data.ininame);
                        modal.find('#nic').val(data.nic);
                        modal.find('#dob').val(data.dob);
                        modal.find('#gender').val(data.gender);
                        modal.find('#paddress').val(data.paddress);
                        modal.find('#raddress').val(data.raddress);
                        modal.find('#hphone').val(data.hphone);
                        modal.find('#mphone').val(data.mphone);
                        modal.find('#wphone').val(data.wphone);
                        modal.find('#email').val(data.email);
                        modal.find('#status').val(data.status);
                        // Change the text of the edit button back to "Edit"
                        $('#editBtn').text('Edit');
                       $('#editBtn').removeClass('saveBtn btn-primary').addClass( 'editBtn btn-danger')  ;
                        // Show a success message
                        displayMessage('Applicant data updated successfully.');
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;
                            var errorsHtml = '<ul>';

                            $.each(errors, function (key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>'; // Only display the first error message for each field
                            });

                            errorsHtml += '</ul>';

                            // Display the errors to the user
                            displayError(errorsHtml);

                        } else {
                            displayError('Error: Could not update applicant details.');
                        }
                    }
});
});
            $('#instructorTable').off().on('click', '.del',function(event){

                 event.preventDefault();
                var academic=$(this).data("row");
                var stat=$(this).data("act");
                $.ajax({
                            url: '/activateacadamic',
                            type: 'post',
                            data: {
                                'act':stat,
                                'academic': academic
                            },
                            success: function (data) {
                                    $('#instructorTable').DataTable().ajax.reload();
                                    displayMessage("course status changed.");
                                },
                                 error: function (error) {
                                    displayError(error.responseJSON.message)

                                }
                        });

            });

            $('#assign').on('show.bs.modal', function (event) {
                var courseDropdown = $('#courseDropdown');
                var button = $(event.relatedTarget);
               // alert(button.data("row"));
                var subjectDropdown = $('#subjectDropdown');
                // Fetch courses from Laravel controller
                $('#iid').val(button.data("row"));
                $.ajax({
                    url: '/courses',
                    type: 'GET',
                    success: function (data) {
                    courseDropdown.empty();
                    courseDropdown.append($('<option>', {
                        value: '',
                        text: 'Select Batch'
                    }));

                    $.each(data, function (index, course) {
                        courseDropdown.append($('<option>', {
                        value: course.id,
                        text: course.coursecode+"_"+course.id+"("+course.course.name+")"
                        }));
                    });
                    }
                });
                // Clear and disable the subject dropdown initially
                subjectDropdown.empty().prop('disabled', true);
                });
                $('#courseDropdown').on('change', function () {
                var selectedCourseId = $(this).val();
                var subjectDropdown = $('#subjectDropdown');

                // Fetch subjects for the selected course from Laravel controller
                $.ajax({
                    url: '/timetable/fetch-subjects/' + selectedCourseId,
                    type: 'GET',
                    success: function (data) {
                    subjectDropdown.empty();
                    subjectDropdown.append($('<option>', {
                        value: '',
                        text: 'Select Subject'
                    }));
                    $.each(data, function (index, subject) {
                        subjectDropdown.append($('<option>', {
                        value: subject.id,
                        text: subject.name
                        }));
                    });
                    subjectDropdown.prop('disabled', false);
                    }
                });
                });
$('#assignButton').off().on('click', function () {


    var courseDropdown = $('#courseDropdown');
  var subjectDropdown = $('#subjectDropdown');
  var ratePerHour = $('#ratePerHour');
  var startDate = $('#startDate');
  var endDate = $('#endDate');
// Reset any previous validation messages or styles
    $('.validation-error').remove();

    var isValid = true;
    var today = new Date(); // Get today's date

    // Validate Course Dropdown
    if (!courseDropdown.val()) {
        courseDropdown.after('<span class="validation-error text-danger">Please select a course.</span>');
        isValid = false;
    }

    // Validate Subject Dropdown
    if (!subjectDropdown.val()) {
        subjectDropdown.after('<span class="validation-error text-danger">Please select a subject.</span>');
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
   var id= $('#iid').val();

    var selectedCourseId = $('#courseDropdown').val();
    var selectedSubjectId = $('#subjectDropdown').val();
    var ratePerHour = $('#ratePerHour').val();
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();

    // Send data to Laravel controller to save in the database
    $.ajax({
        url: '/save-assignment', // Replace with the actual URL for saving data
        type: 'POST',
        data: {
        id:id,
        course_id: selectedCourseId,
        subject_id: selectedSubjectId,
        rate_per_hour: ratePerHour,
        start_date: startDate,
        end_date: endDate
        },
        success: function (response) {
        // Handle success
        console.log('Assignment saved:', response);
        $('#assign').modal('hide'); // Close the modal
        },
        error: function (error) {
        // Handle error
        console.error('Error saving assignment:', error);
        }
    });
});
// $('#assign').on('show.bs.modal', function (event) {
//     alert("ff");
//     return;
//                 var courseDropdown = $('#courseDropdown');
//                 var button = $(event.relatedTarget);
//                // alert(button.data("row"));
//                 var subjectDropdown = $('#subjectDropdown');
//                 // Fetch courses from Laravel controller
//                 $('#iid').val(button.data("row"));
//                 $.ajax({
//                     url: '/courses',
//                     type: 'GET',
//                     success: function (data) {
//                     courseDropdown.empty();
//                     courseDropdown.append($('<option>', {
//                         value: '',
//                         text: 'Select Batch'
//                     }));

//                     $.each(data, function (index, course) {
//                         courseDropdown.append($('<option>', {
//                         value: course.id,
//                         text: course.coursecode+"_"+course.id+"("+course.course.name+")"
//                         }));
//                     });
//                     }
//                 });
//                 // Clear and disable the subject dropdown initially
//                 subjectDropdown.empty().prop('disabled', true);
//                 });
//                 $('#courseDropdown').on('change', function () {
//                 var selectedCourseId = $(this).val();
//                 var subjectDropdown = $('#subjectDropdown');

//                 // Fetch subjects for the selected course from Laravel controller
//                 $.ajax({
//                     url: '/timetable/fetch-subjects/' + selectedCourseId,
//                     type: 'GET',
//                     success: function (data) {
//                     subjectDropdown.empty();
//                     subjectDropdown.append($('<option>', {
//                         value: '',
//                         text: 'Select Subject'
//                     }));
//                     $.each(data, function (index, subject) {
//                         subjectDropdown.append($('<option>', {
//                         value: subject.id,
//                         text: subject.name
//                         }));
//                     });
//                     subjectDropdown.prop('disabled', false);
//                     }
//                 });
//                 });
// $('#assignButton').off().on('click', function () {


//     var courseDropdown = $('#courseDropdown');
//   var subjectDropdown = $('#subjectDropdown');
//   var ratePerHour = $('#ratePerHour');
//   var startDate = $('#startDate');
//   var endDate = $('#endDate');
// // Reset any previous validation messages or styles
//     $('.validation-error').remove();

//     var isValid = true;
//     var today = new Date(); // Get today's date

//     // Validate Course Dropdown
//     if (!courseDropdown.val()) {
//         courseDropdown.after('<span class="validation-error text-danger">Please select a course.</span>');
//         isValid = false;
//     }

//     // Validate Subject Dropdown
//     if (!subjectDropdown.val()) {
//         subjectDropdown.after('<span class="validation-error text-danger">Please select a subject.</span>');
//         isValid = false;
//     }

//     // Validate Rate per Hour
//     if (!ratePerHour.val()) {
//         ratePerHour.after('<span class="validation-error text-danger">Please enter the rate per hour.</span>');
//         isValid = false;
//     }

//     // Validate Start Date
//     if (!startDate.val()) {
//         startDate.after('<span class="validation-error text-danger">Please enter a start date.</span>');
//         isValid = false;
//     } else {
//         // Convert the input date to a Date object
//         var startDateValue = new Date(startDate.val());

//         // Compare the start date to today's date
//         if (startDateValue < today) {
//         startDate.after('<span class="validation-error text-danger">Start date should be today or later.</span>');
//         isValid = false;
//         }
//     }

//     // Validate End Date
//     if (!endDate.val()) {
//         endDate.after('<span class="validation-error text-danger">Please enter an end date.</span>');
//         isValid = false;
//     } else {
//         // Convert the input date to a Date object
//         var endDateValue = new Date(endDate.val());

//         // Compare the end date to the start date
//         if (endDateValue < startDateValue) {
//         endDate.after('<span class="validation-error text-danger">End date should be equal to or greater than start date.</span>');
//         isValid = false;
//         }
//     }

//     // Additional custom validation logic can be added here

//     // If all validations pass, proceed with the assignment
//    var id= $('#iid').val();

//     var selectedCourseId = $('#courseDropdown').val();
//     var selectedSubjectId = $('#subjectDropdown').val();
//     var ratePerHour = $('#ratePerHour').val();
//     var startDate = $('#startDate').val();
//     var endDate = $('#endDate').val();

//     // Send data to Laravel controller to save in the database
//     $.ajax({
//         url: '/save-assignment', // Replace with the actual URL for saving data
//         type: 'POST',
//         data: {
//         id:id,
//         course_id: selectedCourseId,
//         subject_id: selectedSubjectId,
//         rate_per_hour: ratePerHour,
//         start_date: startDate,
//         end_date: endDate
//         },
//         success: function (response) {
//         // Handle success
//         console.log('Assignment saved:', response);
//         $('#assign').modal('hide'); // Close the modal
//         },
//         error: function (error) {
//         // Handle error
//         console.error('Error saving assignment:', error);
//         }
//     });
// });
 function clearModal(){
    $('#ucheck').val("invalid");
    $('#username').val("");
    $('#fullname').val("");
    $('#ininame').val("");
    $('#nic').val("");
    $('#dob').val("");
    $('#gender').val("");
    $('#paddress').val("");
    $('#raddress').val("");
    $('#hphone').val("");
    $('#wphone').val("");
    $('#mphone').val("");
    $('#status').val("");
    $('#email').val("");
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
