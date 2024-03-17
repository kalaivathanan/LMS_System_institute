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
                                    @foreach ($batch as $batches)
                                        <option value="{{ $batches->id }}"
                                            data-batch="{{ $batches->coursecode }}_{{ $batches->id }}">
                                            {{ $batches->coursecode }}_{{ $batches->id }}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>


                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container">
                            <div class="row pb-3 ">
                                <div class="col-12 ">

                                </div>
                            </div>
                            <table class="table table-hover table-striped dt-responsive nowrap" id='dtable'
                                width='100%'>
                                <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th class="text-capitalize">Name</th>
                                        <th class="text-capitalize" width="100">NIC</th>
                                        <th class="text-capitalize" width="50">gender</th>
                                        <th width="100">Phone</th>
                                        <th width="100">WhatsApp</th>
                                        <th class="text-capitalize" width="100">Status</th>
                                        <th width="100">device</th>
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
        <div class="modal fade" id="applicantModal" tabindex="-1" role="dialog" aria-labelledby="applicantModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-success">
                    <div class="modal-header bg-success text-light">
                        <h5 class="modal-title" id="applicantModalLabel">Student Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-success text-light">
                        <input type="hidden" name="iid" id="iid">
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
                            <input type="text" class="form-control" id="dob" disabled>
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


                        <button type="button" class="btn btn-danger  d-inline editBtn" id="editBtn">Edit</button>
                        <button type="button" class="btn btn-secondary d-inline" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal " id="rfidEntryModal" tabindex="-1" role="dialog" aria-labelledby="rfidEntryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rfidEntryModalLabel">RFID Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="sid"></p>
                    <p id="sname"></p>
                    <p id="rfidStatus">Waiting for RFID...</p>
                    <p id="rfidData" style="display: none;">RFID UID: <span id="rfidUid"></span></p>
                </div>
                <div class="modal-footer bg-success text-light">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal" id='btnclose'>Close</button> --}}
                    <div class="text-center bg-success pb-3 btn-group px-5">


                        <button type="button" class="btn btn-danger  d-inline addrfid" id="addrfid">Edit</button>
                        <button type="button" class="btn btn-secondary d-inline btnclose" data-dismiss="modal" id='btnclose'>Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
   function initiateRfidEntry(studentId,studentname) {
        // Trigger the RFID modal on the Laravel side

        $.ajax({
            url: '/addDeviceInitial',
            type: 'POST',
            data: { 'studentId': studentId,'studentname':studentname },
            dataType: 'json',
            success: function(response) {
                $('#rfidEntryModal').modal('show');
                $('#sid').text(studentId);
                $('#sname').text(studentname);
                $('#rfidStatus').text(response.message);
                // Handle the success response if needed
                displayMessage(response.message)

                //$('#rfidEntryModal').modal('hide');
            },
            error: function(error) {
                // Handle the error response if needed
                displayError(error.message)

            }
        });

    }
    function pollRfidEntryStatus(studentId, studentname) {
    function poll() {
        $.ajax({
            url: '/checkRfidEntryStatus',
            type: 'POST',
            data: { 'studentId': studentId },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'recieved') {
                    updateRfidModal(studentId, studentname, response.rfidData);
                    //console.log(response);
                } else {
                    setTimeout(poll, 1000);
                }
            },
            error: function (error) {
                displayError(error.message);
            }
        });
    }

    poll();
}

function updateRfidModal(studentId, studentname, rfidData) {
    // Update the modal content with the RFID data
    $('#sid').text(studentId);
    $('#sname').text(studentname);
    $('#rfidStatus').text('RFID entry complete');
    $('#rfidData').text( rfidData);
    $('#rfblock').css('display', 'block');
}
    // function updateRfidDataOnLaravel(rfidData) {
    //     // Make an AJAX request to update RFID data on Laravel
    //     $.ajax({
    //         url: '/api/update-rfid-data',
    //         type: 'POST',
    //         data: { rfidData: rfidData },
    //         dataType: 'json',
    //         success: function(response) {
    //             // Handle the success response if needed
    //             displayError(response.text)
    //             console.log('RFID data updated successfully on Laravel');
    //         },
    //         error: function(error) {
    //             alert()
    //             // Handle the error response if needed
    //             console.error('Error updating RFID data on Laravel');
    //         }
    //     });
    // }
     $(document).ready(function() {
        var selectedBatchId;

         $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
         });
         var batchtable=$('#dtable').DataTable({
            "language":
            {
                "processing": "<h4 class='mt-5 text-success'>Loading. Please wait...</h4>",
            },
            processing: true,
            retrieve: true,
            serverSide: true,
            responsive:true,
            ajax: {
                url: '/get_student/' +
                selectedBatchId, // Pass the batch ID to the server to retrieve the data
                data: function(d) {
                    d.batch_id = selectedBatchId;
                    // add additional data here, for example:
                        // d.another_param = 'some value';
                },
                type: 'GET'
            }
            ,"autoWidth": true,
            columns:[
                { data: 'id' },
                { data: 'fullname' },
                { data: 'nic' },
                { data: 'gender' },
                { data: 'hphone' },
                { data: 'wphone' },
                { data: 'status' },
              { data: 'deviceid' },
                { data: 'deviceid' ,render: (data,type,row) => {

                var x="";
                var url = "{{ route('applicant.show', ['batch_id' => ':id']) }}";
                  //  url = url.replace(':id', row.id);
                var x=` <div class="btn-group">

                    <a href="${url}" class="btn btn-warning btn-sm viewApplicants" data-toggle="modal" data-target="#applicantModal" data-row="${row.id}">

                    <i class="fa fa-eye">
                        </i>
                </a>`;
              //  console.log(row);
                if(row.deviceid==null){

                    x=x+  `
                    <button class="btn btn-primary" onclick="initiateRfidEntry('${row.id}','${row.fullname}')">
                <i class="fas fa-power-off">
                        Add Device</i>
                    </button>
                `;
            }
                else {
                    x=x+  `

                    <button class="btn btn-danger" onclick="initiateRfidEntry('${row.id}','${row.fullname}')">
                <i class="fas fa-power-off">
                        Change Device</i>
                    </button>
                `;
                }

                x=x+`</div>`;

                 return x;
                }
            }
            ], "rowCallback": function (nRow, aData, iDisplayIndex)
            {
                    var oSettings = this.fnSettings ();
                    $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                    return nRow;
            }

    });
    $('#courseSelect').change(function() {
             selectedBatchId = $(this).val();
             batchtable.ajax.reload();

         });

     $('#applicantModal').on('hidden.bs.modal', function (event) {
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

            $('#editBtn').text('Edit');
            $('#editBtn').removeClass('saveBtn btn-primary').addClass( 'editBtn btn-danger')  ;

        });
        $('#applicantModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var applicantId = button.data('row'); // Extract the applicant ID from data attribute of the button
            var modal = $(this); // Get the modal

            // Make an Ajax call to retrieve the applicant data from the server
            $.ajax({
                url: '/viewApplicant',
                type: 'POST',
                data: {id: applicantId},
                dataType: 'json',
                success: function(data) {
                // Populate the input fields in the modal with the retrieved data
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
                alert('Error: Could not retrieve student details.');
                }
            });
        });
        $('#rfidEntryModal').on('click', '.btnclose', function(event) {
            $('#rfidEntryModal').modal('hide');
        });
        $('#rfidEntryModal').off('click').on('click', '.addrfid', function(event) {
            var sid= $('#sid').text();
            var rfidData=$('#rfidData').text();
            var sname=$('#sname').text();
                    $.ajax({
                url: '/assign-rfid-data',
                type: 'POST',
                data: { rfidData: rfidData,sid:sid,sname:sname },
                dataType: 'json',
                success: function(response) {
                    // Handle the success response if needed
                    displayMessage(response.message)
                   // console.log(response);
                },
                error: function(error) {
                  //  alert()
                    // Handle the error response if needed
                    console.error(error)
                    displayError('Error accepting RFID data ');
                }
            });
            $('#rfidEntryModal').modal('hide');
        });
        $(document).on('click', '.editBtn', function(event) {
           // event.stopPropagation();
    // Enable all the form fields
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
            $('#status').prop('disabled', false);

            // Change the text of the edit button to "Save"
            $('#applicantModal .editBtn').off('click');
            $(this).text('Save');
            $(this).removeClass( 'editBtn btn-danger').addClass('saveBtn btn-primary');

        });


    $('#applicantModal').off('click').on('click', '.saveBtn', function(event) {

             var button = $(event.relatedTarget); // Button that triggered the modal
            var applicantId =  $('#iid').val(); // Extract the applicant ID from data attribute of the button
            var modal = $(this); // Get the modal
            $.ajax({
                    url: '/editApplicant',
                    type: 'POST',
                    data: {
                        id: applicantId,
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
                        displayMessage('Student data updated successfully.');
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
                            displayError('Error: Could not update student\'s details.');
                        }
                    }
                });
    });

    });
    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
    function displayError(message) {
        toastr.error(message, 'Event');
    }
</script>
@endsection
