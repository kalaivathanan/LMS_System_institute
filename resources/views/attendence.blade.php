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
                        <div class="row ">
                            <div class="col-sm-6 col-md-3">
                                <h3 class="page-title">Attendance</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Attendance</li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="row py-1">

                                    {{-- <div class="col-sm-6 col-md-3"> --}}
                                    <div class="form-group form-focus select-focus">
                                        <input type="number" class="form-control getAttendace" placeholder="Year"
                                            value={{ now()->year }} id="selectYear">

                                        {{-- </div> --}}
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="form-group form-focus select-focus">
                                        <select class="form-control getAttendace" id="selectMonth">
                                            <option>Select Month</option>
                                            <option value="1" {{ date('n') == 1 ? 'selected' : '' }}>Jan</option>
                                            <option value="2" {{ date('n') == 2 ? 'selected' : '' }}>Feb</option>
                                            <option value="3" {{ date('n') == 3 ? 'selected' : '' }}>Mar</option>
                                            <option value="4" {{ date('n') == 4 ? 'selected' : '' }}>Apr</option>
                                            <option value="5" {{ date('n') == 5 ? 'selected' : '' }}>May</option>
                                            <option value="6" {{ date('n') == 6 ? 'selected' : '' }}>Jun</option>
                                            <option value="7" {{ date('n') == 7 ? 'selected' : '' }}>Jul</option>
                                            <option value="8" {{ date('n') == 8 ? 'selected' : '' }}>Aug</option>
                                            <option value="9" {{ date('n') == 9 ? 'selected' : '' }}>Sep</option>
                                            <option value="10" {{ date('n') == 10 ? 'selected' : '' }}>Oct</option>
                                            <option value="11" {{ date('n') == 11 ? 'selected' : '' }}>Nov</option>
                                            <option value="12" {{ date('n') == 12 ? 'selected' : '' }}>Dec</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row py-1">
                                    <div class="col-md-11">
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
                                <div class="row py-1">
                                    <div class="col-md-11">
                                        <select class="form-control getAttendace" id="subjectSelect">
                                            <option value="">Select a Subject</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table table-nowrap mb-0">
                                    <thead>

                                    </thead>
                                    <tbody>
                                    </tbody>
                            </div>
                        </div>


                    </div>
                </div>

                <script type="application/javascript">
    $(document).ready(function() {
        $('#courseSelect').change(function() {
            var selectedBatchId = $(this).val();

            // Clear existing options in the subjectSelect dropdown
            $('#subjectSelect').empty().append('<option value="">Select a Subject</option>');

            // Make AJAX request to fetch subjects based on the selected batch ID
            if (selectedBatchId) {
                $.ajax({
                    url: '/getSubjectAttendence/' + selectedBatchId,
                    type: 'GET',
                    success: function(response) {
                        // Populate subjectSelect dropdown with fetched subjects
                        $.each(response, function(key, value) {
                            $('#subjectSelect').append('<option value="' + key +
                                '">' + value + '</option>');
                        });
                    }
                });
            }
        });
        $('.getAttendace').off().on('change',function() {
    //$('#selectMonth').off().on('change',function() {
            var selectedMonth = $('#selectMonth').val();
            var selectedBatchId=$('#courseSelect').val();
            var daysInMonth = new Date(new Date().getFullYear(), selectedMonth, 0).getDate();
            var selectedSubjectId=$('#subjectSelect').val();
            var selectedYear=$('#selectYear').val();
            // Remove existing header rows
            $('thead tr').remove();

            // Generate new header rows based on the number of days in the month
            var headerRow = '<tr><th>Employee</th>';
            for (var day = 1; day <= daysInMonth; day++) {
                headerRow += '<th>' + day + '</th>';
            }
            headerRow += '<th>P/A</th></tr>'
            // Append the new header row to the table
            $('thead').append(headerRow);
// Inside your existing script
$.ajax({
    url: '/getStudentAttendance/' + selectedBatchId + '/' + selectedSubjectId + '/' + selectedYear + '/' + selectedMonth+ '/student' ,
    type: 'GET',
    success: function (attendanceData) {
        // Filter only student records
        var studentAttendanceData = attendanceData['attendanceData'].filter(function(record) {
            return record.catogary === 'student';
        });
var lessonData=attendanceData['lessonSchedule'];
        // Clear existing rows in the table body
        $('tbody tr').remove();

        // Create a set to store unique student IDs
        var uniqueStudents = new Set();

        // Loop through the attendance data and organize it by personid
        $.each(studentAttendanceData, function(index, attendance) {
            uniqueStudents.add(attendance.get_student.fullname);
        });
        var totalPresent = 0;
        var totalAbsent = 0;
        var rowPresent=0;
        var rowAbsent=0;
        var dailyPresentCounts = new Array(daysInMonth).fill(0);
        var dailyAbsentCounts = new Array(daysInMonth).fill(0);
        // Loop through each unique student
        uniqueStudents.forEach(function(studentId) {
            var row = '<tr><td>' + studentId + '</td>';

            // Loop through the days in the month
            for (var day = 1; day <= daysInMonth; day++) {
                // Check if the student attended on the current day
                var lessonConducted = (
                        lessonData.find(function (lesson) {
                            return new Date(lesson.start).getDate() == day;
                        })
                    );
                var attendanceStatus = (
                    studentAttendanceData.find(function(attendance) {
                        return attendance.get_student.fullname == studentId && new Date(attendance.intime).getDate() == day;
                    })
                ) ? '<i class="fa fa-check"></i>' :(lessonConducted ? (lessonConducted.status === 'Conducted' ? '<i class="fa fa-close"></i>' : '~') : '-') ;
        if(attendanceStatus=='<i class="fa fa-check"></i>')
        {
            totalPresent++;
            rowPresent++;
            dailyPresentCounts[day - 1]++;
        }else if(attendanceStatus=='<i class="fa fa-close"></i>')
        {
            totalAbsent++;
            rowAbsent++
            dailyAbsentCounts[day - 1]++;
        }

                    // Add a new cell with attendance status for each day
                    var backgroundColor=(
                    studentAttendanceData.find(function(attendance) {
                        return attendance.get_student.fullname == studentId && new Date(attendance.intime).getDate() == day;
                    })
                ) ? 'lightblue' :(lessonConducted ? (lessonConducted.status === 'Conducted' ? 'pink' : 'lightgray') : '') ;
                    // = lessonConducted ? (lessonConducted.status === 'Conducted' ? 'lightblue' : 'lightgray') : '';

                // Add a new cell with attendance status for each day
               // row += '<td>' + attendanceStatus + '</td>';
               row += '<td style="background-color: ' + backgroundColor + ';color:black">' + attendanceStatus + '</td>';

            }

            // Close the row tag for the current student
            row += '<td>'+rowPresent+'/'+rowAbsent+'</td></tr>';
rowAbsent=0;
rowPresent=0;
            // Append the new row to the table body
            $('tbody').append(row);

        });
        var countRow = '<tr><td>Daily Count</td>';
        for (var day = 0; day < daysInMonth; day++) {
             if(dailyPresentCounts[day]=='0'&& dailyAbsentCounts[day]=='0'){
                 countRow += '<td></td>';
             }else{
            countRow += '<td>' + dailyPresentCounts[day] + '/' + dailyAbsentCounts[day] + '</td>';
               // countRow += '<td>' + dailyPresentCounts[day] + '/' + dailyAbsentCounts[day] + '</td>';
         }
            }
            countRow+='<td>'+totalPresent+'/'+totalAbsent+'</td>'
        countRow += '</tr>';
        $('tbody').append(countRow);
    }
});

        });
    });
</script>
            @endsection
            @push('css')
            @endpush
