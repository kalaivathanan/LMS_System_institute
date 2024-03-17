@extends('layouts.app')

@section('content')
    <!-- header -->
    @include('includes/header')
    <div class="modal fade" id="eventModel" tabindex="-1" role="dialog" aria-labelledby="eventModelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-success text-light">
                <div class="modal-header bg-success text-light ">
                    <h5 class="modal-title " id="eventModelLabel">Create Events</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-success text-light">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="eventTitle">Event Title</label>
                                    <input type="text" class="form-control" id="eventTitle">
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
                @include('includes/sidebar')
            </div>
            <div class="col-md-10 col-sm-12 d-flex flex-column h-sm-100 p-0" id="cont">

                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Trial Details') }}</h3>
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
        $(document).ready(function () {
            
                var SITEURL = "{{ url('/') }}";
    
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                const calendarEl=document.getElementById('full_calendar_events')    
                var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',  headerToolbar: {
        left: "prevYear prev today next nextYear",
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },

//       eventSources: [

//             // your event source
//             {
//             url: SITEURL + "/load",
//             method: 'get',
            
//             failure: function() {
//                 alert('there was an error while fetching events!');
//             },
            
//             }

// // any other sources...

// ]       ,       
events: SITEURL + "/load",    selectable:true,
                                                eventClick:function (event) {
                            if(event.uid!={{auth()->user()->id}})
                      {
                        displayError("This event not belogns to you");
                        return;
                      }          
                        },select: function (event_start, event_end, allDay) {
                            var  start=moment(event_start).format("YYYY-MM-DD");
                            var curentt=moment().format("hh:mm A");                            
                            var end=moment(event_start).format("YYYY-MM-DD");  
                          //  var end=moment(event_start).add(1,'days').format("YYYY-MM-DD");                           
                            $('#eventDete').val(start);
                            $('#pickerstart').val(curentt);
                            $('#pickerend').val(curentt);
                            $('#eventDeteend').val(end);
                            $('#userid').val({{auth()->user()->id}});

                       $("#eventModel").modal('toggle');
                       $("#btnAdd").click(function(){
                           var start= $('#eventDete').val();
                          var  startTime =  moment($('#pickerstart').val(), 'hh:mm A').format('HH:mm:ss');
                          start=start+" "+startTime;
                            var endTime = moment($('#pickerend').val(), 'hh:mm A').format('HH:mm:ss');
                          var  ends =$('#eventDeteend').val() + " "+endTime;
                            var user= {{auth()->user()->id}};
                            var color= $('#ccolor').val();
                           var title=$('#eventTitle').val();
                           var type="Trial";
                            $.ajax({
                                url: SITEURL + "/calendar/create-event",
                                
                                data: {
                                    title,
                                    start,
                                    ends,
                                    type ,
                                   color,
                                   user,
                                },
                                type: "POST",
                                 success: function (response) {
                                    displayMessage("Event created.");
                                    calendar.fullCalendar('renderEvent', {
                                        id: response.id,
                                        title: response.title,
                                        start: response.start,
                                        end: response.end,
                                        color:response.color,
                                        allDay:1,
                                        user:response.user,
                                    }, true);
                                   
                                 },
                                 error: function (error) {

                                    
                                     if(error.responseJSON.errors)
                                    {
                                       // console.log(error)
                                    displayError(error.responseJSON.errors.title);
                                }
                                   
                                 }
                                
                            });
                            $("#eventModel").modal('close');
                       });
                    
                    },displayEventEnd:true,
                    editable:true, eventDrop: function (info) {
                     console.log(info);
                      if(info.event.extendedProps.uid!={{auth()->user()->id}})
                      {
                       
                        displayError("This event not belogns to you ");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/dmuy/MDTimePicker@2.0.0/dist/mdtimepicker.css" />
@endpush
