@extends('layouts.app')

@section('content')
    <!-- header -->
    @include('includes/header')
    <div class="modal fade" id="eventModel" tabindex="-1" role="dialog" aria-labelledby="eventModelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-success text-light">
                <div class="modal-header bg-success text-light ">
                    <h5 class="modal-subject " id="eventModelLabel">Create Events</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-success text-light">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="subject_id">Select Subject:</label>
                                    <select id="subject_id" name="subject_id" class="form-control">
                                        <option value="" data="">Select a Subject</option>
                                        <!-- Default empty option -->
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label for="eventDete">Event Start Date</label>
                                    <input type="date" class="form-control" id="eventDete">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pickerstart">Event Start Time</label>
                                    <input class="form-control" type="text" id="pickerstart" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label for="eventDeteend">Event End Date</label>
                                    <input type="date" class="form-control" id="eventDeteend">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pickerend">Event End Time</label>
                                    <input class="form-control" type="text" id="pickerend" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="ccolor">Event color</label>
                                    <input class="form-control" type="color" id="ccolor" readonly="">
                                    <input class="form-control" type="hidden" id="userid" readonly="">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="form-group">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                        id="btnAdd">&nbsp;Add&nbsp;</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                <h3>{{ __('Acadamic Calender') }}</h3>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <form id="batch-select-form">
                                    <select class="form-control " id="batch_id" name="batch_id">
                                        <option value="-1"> Select a Course</option>
                                        <!-- Populate options dynamically using Blade -->
                                        @foreach ($batches as $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->coursecode }}_{{ $batch->id }}
                                                ({{ $batch->course->name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>

                        </div>
                    </div>


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id='full_calendar_events'>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script type="application/javascript" src='https://cdn.jsdelivr.net/npm/fullcalendar@6.0.3/index.global.min.js'></script>
    <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="application/javascript" src="https://cdn.jsdelivr.net/gh/dmuy/MDTimePicker@2.0.0/dist/mdtimepicker.js"></script>
    <script  type="application/javascript">
    mdtimepicker('#pickerstart', {
    timeFormat: 'hh:mm:ss.000', // format of the time value (data-time attribute)
    format: 'h:mm tt', // format of the input value
    theme: 'green', // theme of the timepicker
    hourPadding: true, // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM);
    clearBtn: false, // determines if clear button is visible
    is24hour: false, // determines if the clock will use 24-hour format in the UI;

    });
    mdtimepicker('#pickerend', {
    timeFormat: 'hh:mm:ss.000', // format of the time value (data-time attribute)
    format: 'h:mm tt', // format of the input value
    theme: 'green', // theme of the timepicker
    hourPadding: true, // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM);
    clearBtn: false, // determines if clear button is visible
    is24hour: false, // determines if the clock will use 24-hour format in the UI;

    });
    var calendar;
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('full_calendar_events');

     calendar = new FullCalendar.Calendar(calendarEl, {
        // Configure FullCalendar options here
            initialView: 'timeGridWeek',  headerToolbar: {
                left: "prevYear prev today next nextYear",
                center: 'subject',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },

            timeZone: 'Asia/Kolkata',
            selectable:true,
        eventClick:function (event) {
           // console.error(event.event.extendedProps.uid+"FFF") ;
            if(event.event.extendedProps.uid!={{auth()->user()->id}})
            {
                displayError("This event not belogns to you");
                return;
            }
        },

        dateClick: function (info) {
            // Calculate the clicked cell's start date and end date
           // console.log(info)
            var startDate = info.date;
            var endDate = new Date(startDate);
            endDate.setMinutes(startDate.getMinutes() + 30); // Add 30 minutes
            // Extract the time parts from the start and end dates
            var startTime = startDate.toISOString().substr(11, 5);
            var endTime = endDate.toISOString().substr(11, 5);
            startDate = moment(startDate);
            endDate = moment(endDate);
            startDate= startDate.format('YYYY-MM-DD');
            endDate =endDate.format('YYYY-MM-DD');
            $('#eventDete').val(startDate);
            $('#pickerstart').val(startTime);
            $('#pickerend').val(endTime);
            $('#eventDeteend').val(endDate);
            $('#userid').val({{auth()->user()->id}});
            if($('#batch_id').val()!=-1){
                $("#eventModel").modal('toggle');
            }else{
                displayError("Please select course");
            }
            $("#btnAdd").off().on('click',function(){
                var subject=$('#subject_id').val();
                var batch=$('#batch_id').val();
                var start= $('#eventDete').val();
                var lesson="not set";
                var startTime = moment($('#pickerstart').val(), 'hh:mm A');
                var endTime = moment($('#pickerend').val(), 'hh:mm A');
                var duration = moment.duration(endTime.diff(startTime));
                    endTime=endTime.format('HH:mm:ss');
                    startTime=startTime.format('HH:mm:ss');
                    start=start+" "+startTime;
                var ends =$('#eventDeteend').val() + " "+endTime;
                var slotsize=duration.asHours();
                var user= {{auth()->user()->id}};
                var color= $('#ccolor').val();
                var status="Not Conducted";

              //  console.log(user);
                $.ajax({
                    url: SITEURL + "/timetable/create-event",
                    data: {
                        subject,
                        batch,
                        lesson,
                        start,
                        ends,
                        slotsize,
                        user,
                        status,
                        color,
                    },
                    type: "POST",
                    success: function (response) {
                        displayMessage("Event created.");
                        var event = response.event;
                        var backgroundColor = event.color;

                        // Calculate the relative luminance of the background color
                        var r = parseInt(backgroundColor.slice(1, 3), 16) / 255;
                        var g = parseInt(backgroundColor.slice(3, 5), 16) / 255;
                        var b = parseInt(backgroundColor.slice(5, 7), 16) / 255;

                        var luminance = 0.2126 * r + 0.7152 * g + 0.0722 * b;

                        // Set the text color based on luminance
                        var textcolor = luminance > 0.5 ? '#000000' : '#FFFFFF';

                        // Access the subject details
                        var subjectName = response.name;
                        var subjectCode = response.code;
                        calendar.refetchEvents();
                    },
                    error: function (error) {
                        if(error.responseJSON.errors)
                        {
                            // console.log(error)
                            displayError(error.responseJSON.errors.subject);
                        }
                    }
                });
              //  $("#eventModel").modal('close');
            });

        },

        displayEventEnd:true,
        editable:true,
        eventDrop: function (info) {

            if(info.event.extendedProps.uid!={{auth()->user()->id}})
            {
                console.error(info+"FFF") ;
            displayError("This event not belogns to you ddd");
            info.revert()
            return;
            }
            var event_start = moment(info.event.start).format('yyyy-MM-DD HH:mm:ss');
            var event_end = moment(_.isNull(info.event.end)?info.event.start:info.event.end).format('yyyy-MM-DD HH:mm:ss');

            $.ajax({
                url: SITEURL + '/calendar/edit-event',
                data: {
                    start: event_start,
                    end: event_end,
                    id: info.event.id,
                    type: 'edit'
                },
                type: "PATCH",
                success: function (response) {
                    displayMessage("Event updated");
                }
            });
        },

        });

        calendar.render();
    });
 $(document).ready(function () {

    $('#subject_id').off().on('change', function() {
        var selectedColor=$(this).find('option:selected').data('color');
        $('#ccolor').val(selectedColor);
    });


    $('#batch_id').off().on('change', function() {
        var selectedBatchId = $(this).val();

            if (selectedBatchId != -1) {
                 fetchEventsForBatch(selectedBatchId);
                 $.ajax({
                    url: '/timetable/fetch-subjects/' + selectedBatchId, // Replace with the actual route
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var subjectSelect = $('#subject_id');
                        subjectSelect.empty(); // Clear existing options
                        subjectSelect.append($('<option>', {
                            value: '',
                            text: 'Select a Subject',

                        }));
                        $.each(response, function(key, value) {
                            subjectSelect.append($('<option>', {
                                value: value.id,
                                text: value.name,
                                'data-color':value.color,
                            }));

                        });

                    },
                    error: function(xhr) {
                        console.error('Error fetching subjects:', xhr);
                    }
                });
            }
    });



    function fetchEventsForBatch(batchId) {
        //Make an AJAX request to your Laravel backend to fetch events for the selected batch
        $.ajax({
            url: '/timetable/load' , //
            data: {
            batch_id: batchId,

        },
            method: 'GET',
            success: function(response) {
                // Parse the response and add events to the FullCalendar
                //console.log(response);
                var events = parseEvents(response);
                calendar.removeAllEvents(); // Remove existing events
                calendar.addEventSource(events); // Add new events
            },
            error: function(error) {
                console.error('Error fetching events: ' + error);
            }
        });
    }


    function parseEvents(response) {
        // Parse the response from your server and convert it into an array of FullCalendar events
        // Each event should have at least 'title', 'start', and 'end' properties
        // Example:
        return response.map(function(event) {
            return {
                title: event.getsubject.name,
                start: event.start,
                end: event.end,
                color:event.color,
                uid:event.uid,
                // Add other event properties as needed
            };
        });
    }
    });
    var SITEURL = "{{ url('/') }}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function getTextColorForBackground(backgroundColor) {
    // Calculate the brightness of the background color
        var r = parseInt(backgroundColor.slice(1, 3), 16);
        var g = parseInt(backgroundColor.slice(3, 5), 16);
        var b = parseInt(backgroundColor.slice(5, 7), 16);
        var brightness = (r * 299 + g * 587 + b * 114) / 1000;

        // Choose text color based on brightness
        return brightness > 128 ? "#000" : "#fff"; // Use black for light backgrounds, white for dark backgrounds
    }
    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
    function displayError(message) {
        toastr.error(message, 'Event');
    }
        </script>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/dmuy/MDTimePicker@2.0.0/dist/mdtimepicker.css" />
@endpush
