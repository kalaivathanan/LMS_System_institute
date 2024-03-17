<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Page-->
    <title>Applicant registration</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/form.css" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="page-wrapper bg-info p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading ">
                    <h2 class="title text-info">Registration Info</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <p>{{ $errors->first() }}</p>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form action="/addapplicant" method="post">
                        @csrf
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <label for="center" class="input--style-1">center</label>
                                <select name="center" id="center">
                                    <option value="">--Select Center--</option>
                                    @foreach ($center as $center)
                                        <option value="{{ $center->id }}">{{ $center->centername }}</option>
                                    @endforeach
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <label for="batchid" class="input--style-1">Course: *</label>
                                <select name="batchid" id="batchid">
                                    {{-- <option value="">--Select Course--</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course->name }}</option>
                                    @endforeach --}}
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Natioanl ID Number *"
                                name="nic" id="nic" required>

                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Full NAME *" required
                                name="fullname" id="fullname">

                        </div>
                        <div class="input-group">
                            <input class="input--style-1" name="ininame" id="ininame" type="text"
                                placeholder="Name with Initial *" required>

                        </div>

                        <div class="row row-space">
                            <div class="col-5">
                                <div class="input-group">
                                    <input class="input--style-1 js-datepicker" type="text" placeholder="BIRTHDATE *"
                                        required name="dob" id="dob">
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="gender" id="gender" required>
                                            <option disabled="disabled" selected="selected" value="">GENDER
                                            </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" name="paddress" id="paddress"
                                placeholder="Permanant Address*">

                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" name="raddress" id="raddress"
                                placeholder="Residential Address:">
                        </div>

                        <div class="row row-space">
                            <div class="col-5">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Phone Residence"
                                        name="hphone" id="hphone">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Phone Mobile"
                                        name="mphone" id="mphone">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-5">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Phone Office"
                                        name="ophone" id="ophone">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Phone WhatsApp"
                                        name="wphone" id="wphone">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" name="email" id="email"
                                placeholder="E-Mail">
                        </div>
                        <div class="p-t-20">
                            <button class="btn btn-success " type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#center').change(function() {
                let center_id = $(this).val();
           //      alert( center_id);
                $.ajax({
                    url: "/get_batches/" + center_id,
                    method: "GET",
                    success: function(data) {

                        var options = '';
                        $.each(data, function(key, value) {
                            //alert(value.course)
                            options += '<option value="' + value.id + '">' + value
                                .course.name+"_"+ value.id  + '</option>';
                        });
                        $('#batchid').html(options);
                    }
                });
            });
            $('#nic').blur(function() {
                var nic = $('#nic').val();

                $.ajax({
                    url: '/getApplicantByNIC/' + nic,
                    type: 'GET',
                    success: function(data) {
                        //alert(data.fullname);
                        // Populate form fields with data received from the server
                        $('#fullname').val(data.fullname);
                        $('#ininame').val(data.ininame);
                        $('#dob').val(data.dob);
                         $('#gender').val(data.gender).trigger('change');

                        $('#paddress').val(data.paddress);
                        $('#raddress').val(data.raddress);
                        $('#hphone').val(data.hphone);
                        $('#mphone').val(data.mphone);
                        $('#ophone').val(data.ophone);
                        $('#wphone').val(data.wphone);
                        $('#email').val(data.email);
                        // Update other fields as needed
                    },
                    error: function(error) {
                        console.log('Error fetching applicant data: ' + error);
                    }
                });
                    });
        });

    </script>



</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
