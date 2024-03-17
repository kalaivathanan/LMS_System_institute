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
                    <div class="card-header">

                        <h4 class="titleheader_"> ApplicantsList of <span class='text-danger'> {{ $batch->course->name }} _
                                {{ $batch->id }}</span>
                        </h4>

                        <h5 class="float-right text-capitalize">Batch Status: {{ $batch->batchstatus }}</h5>

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
        <!-- Modal  view/Edit applicant -->
        <div class="modal fade" id="applicantModal" tabindex="-1" role="dialog" aria-labelledby="applicantModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-success">
                    <div class="modal-header bg-success text-light">
                        <h5 class="modal-title" id="applicantModalLabel">Applicant Details</h5>
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
        <!-- Modal  Register applicant -->
        <div class="modal" id="registerStudentModal" tabindex="-1" role="dialog"
            aria-labelledby="registerStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-success text-light">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerStudentModalLabel">Register Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Registration form goes here -->
                        {{-- <input type="hidden" id="eemail" name="eemail">
                        <input type="hidden" id="nnic" name="nnic"> --}}
                        <input type="hidden" id="appid" name="appid">
                        <div class="form-group pb-2">
                            <label for="stname">Student Name</label>
                            <input type="text" class="form-control" id="stname" name="stname" disabled>
                        </div>
                        <div class="form-group">
                            <label for="regdate">Registration Date</label>
                            <input type="date" class="form-control" id="regdate" name="regdate" required>
                        </div>

                        <div class="form-group row align-items-center pt-4">
                            <label for="regfee" class="col-sm-2 col-form-label">Reg. Fee</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="regfee" name="regfee" disabled>
                            </div>



                            <div class="col-sm-2 form-check">
                                <input type="checkbox" class="form-check-input big-checkbox" id="Regpaid"
                                    name="Regpaid">
                                <label class="form-check-label ps-2 " for="Regpaid"
                                    style="line-height: 30px">Pay</label>
                            </div>


                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="Reginv" name="Reginv"
                                    placeholder="Invoice_No" disabled>
                            </div>
                        </div>

                        <div class="form-group row align-items-center pt-4">
                            <label for="Basefee" class="col-sm-2 col-form-label">Base. Fee</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="Basefee" name="Basefee" disabled>
                            </div>



                            <div class="col-sm-2 form-check">
                                <input type="checkbox" class="form-check-input big-checkbox" id="Basepaid"
                                    name="Basepaid">
                                <label class="form-check-label ps-2 " for="Basepaid"
                                    style="line-height: 30px">Pay</label>
                            </div>


                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="Baseinv" name="Baseinv"
                                    placeholder="Invoice_No" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeBtn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"  id="regBtn" name="regBtn">Register</button>
                    </div>
                </div>
            </div>
        </div>

           </div>


    <script type="application/javascript">
        $(document).ready(function() {
            var batchId = {!! json_encode($batch_id) !!}; // Get the batch ID passed from the controller
            var batchstatus = {!! json_encode($batch->batchstatus) !!};
            var regfee={!! json_encode($batch->regFee) !!}
            var basefee={!! json_encode($batch->basepayment) !!}
            var payment = {!! json_encode($paymentModel) !!}
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
                    url: '/get_Applicant/' + batchId, 
                    data: function(d) {
                        
                        d.batch_id = batchId;
                        // add additional data here, for example:
                            // d.another_param = 'some value';
                        },
                    type: 'GET',
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
                //  { data: 'email' }, 
                 { data: 'nic' ,render: (data,type,row) => {

                    // const rowValue =  JSON.stringify(Object.entries(row));
                    // console.log({rowValue});
                    var x="";
                    // let A="";
                    var url = "{{ route('applicant.show', ['batch_id' => ':id']) }}";
                   
                      //  url = url.replace(':id', row.id);
                        
                    var x=` <div class="btn-group">  
                                            
                        <a href="${url}" class="btn btn-warning btn-sm viewApplicants" data-toggle="modal" data-target="#applicantModal" data-row="${row.id}">
                        
                        <i class="fa fa-eye">
                            </i>
                    </a>`
                                       if(row.status=="applied"){
                        if(batchstatus=="not started"||batchstatus=="on going"){
                        x=x+  `
                        
                    <a href="" class="btn btn-success  btn-sm del"
                     data-toggle="modal" data-target="#registerStudentModal"
                        data-act="registered"
                        data-id="${row.id}"
                        data-name="${row.fullname}" 
                                          
                        ><i class="fas fa-power-off">
                            Register</i>
                    </a>
                    `;
                    }else {
                        
                        x=x+  ` <a  class="btn btn-secondary  btn-sm del" disabled><i class="fas fa-power-off">
                            Batch Locked</i></a>`
                    }
                }
                    else { 
                         var url4 = "{{ route('Admin.viewPayment', ['Applicant_id' => ':id']) }}";
                            url4 = url4.replace(':id',row.id);

                        x=x+ `
                        <a href="${url4}"  class="btn btn-primary  btn-sm del">
                           <i class="fa-solid fa-money-bill-wave"> Payment</i></a>`
     
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
                       // data-regfee="`+regfee+`"
                        // data-basefee="`+basefee+`"  
        });

       
        $('#registerStudentModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var applicantId = button.data('id'); // Extract the applicant ID from data attribute of the button
            var name = button.data('name'); 
            
            var modal = $(this); // Get the modal
            // modal.find('#eemail').val(eemail);
            // modal.find('#nnic').val(nic);
            modal.find('#stname').val(name);
            modal.find('#appid').val(applicantId);
            modal.find('#regdate').val( moment().format("YYYY-MM-DD"));
            modal.find('#regfee').val(regfee);
            modal.find('#Basefee').val(basefee);           
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
                alert('Error: Could not retrieve applicant details.');
                }
            });
        });
        $('#regBtn').off().on('click', function(e) {
            e.preventDefault();
            $('#regBtn').prop('disabled', true);
            var regfee = $('#regfee').val();
            var basefee = $('#Basefee').val();
            var Basepaid = $('#Basepaid').is(":checked");
            var Regpaid = $('#Regpaid').is(":checked");
            var Reginv = $('#Reginv').val();
            var Baseinv = $('#Baseinv').val();
           
            // Validate form
            if (Regpaid && Reginv.trim() === '') {
                displayError('Please enter invoice number.');
                $('#Reginv').focus();
                $('#regBtn').prop('disabled', false);
                return false;
            }
            if (Basepaid && Baseinv.trim() === '') {
                displayError('Please enter invoice number.');
                $('#Baseinv').focus();
                $('#regBtn').prop('disabled', false);
                return false;
            }
 
            // Save data using Ajax
            $.ajax({
            type: 'POST',
            url: '{{ route("student.register") }}',
            data: {
                nic:$('#nnic').val(),
                email:$('#eemail').val(),
                regdate:$('#regdate').val(),
                appid:$('#appid').val(),
                regfee: regfee,
                basefee: basefee,
                regpaid:Regpaid.toString(),
                basepaid:Basepaid.toString(),
                reginv: Reginv,
                baseinv: Baseinv
            },
            success: function(data) {
                $('#closeBtn').trigger( "click" );
                $('#dtable').DataTable().ajax.reload();
                $('#regBtn').prop('disabled', false);
                displayMessage('Register student successfull.');
            },
            error: function(xhr, status, error) {
                var response = JSON.parse(xhr.responseText);
                displayError('Error: ' + response.errors.message);
                $('#regBtn').prop('disabled', false);

            }
            });
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
    $("#Regpaid").change(function() {
    if(this.checked) {
      $("#Reginv").prop("disabled", false);
      $("#Reginv").focus()
    } else {
      $("#Reginv").prop("disabled", true);
      $("#Reginv").val("");
    }
  });
  $("#Basepaid").change(function() {
    if(this.checked) {
      $("#Baseinv").prop("disabled", false);
      $("#Baseinv").prop("required", true);
      $("#Baseinv").focus()
    } else {
      $("#Baseinv").prop("disabled", true);
      $("#Baseinv").prop("required", false);
      $("#Baseinv").val('');
    }
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
