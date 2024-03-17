@extends('layouts.app')

@section('content')
 <!-- header -->
 @include("includes/header")
 <div class="container-fluid px-0">

    <div class="row justify-content-center ">
        <div class="col-12 col-md-2 p-0 " id="sbars">
            @include('includes/sidebarAdmin')
        </div>
        <div class="col-md-10 col-sm-12 d-flex flex-column h-sm-100 p-0" id="cont">

            <div class="card">
                <div class="card-header">{{ __('Dashboard_admin') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      <div class="row">

                <!-- stat 1 -->
                <div class="col-md-3">
                    <div class="card widget bg-stu">
                        <div class="widget-title">
                            <h1>{{$nos}}</h1>
                        </div>
                        <div class="widget-title d-flex align-items-center">
                               <p><strong>Total Students</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p><i class="fa-solid fa-user-group fa-lg"></i>&nbsp;&nbsp;<a href="/loadstudent"><strong>Go to Students</strong></a></p>
                        </div>
                    </div>
                </div>

                <!-- stat 2 -->
                <div class="col-md-3">
                    <div class="card widget bg-batch">
                        <div class="widget-icon widget-warning">
                            <i class="mdi mdi-cash"></i>
                        </div>
                        <div class="widget-title">
                            <h1>{{$Nob}}</h1>
                            <p><strong>Total Active Batches</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p><i class="fa-solid fa-chalkboard-user fa-lg"></i>&nbsp;&nbsp;<a href="/batch"><strong>Go to Batches</strong></a></p>
                        </div>
                    </div>
                </div>

                <!-- stat 3 -->
                <div class="col-md-3">
                    <div class="card widget bg-crs">
                        <div class="widget-icon widget-danger">
                            <i class="mdi mdi-cash-usd"></i>
                        </div>
                        <div class="widget-title">
                            <h1>{{$Noc}}</h1>
                            <p><strong>Active Courses</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p><i class="fa-solid fa-book-open fa-lg"></i></i>&nbsp;&nbsp;<a href="/course"><strong>Go to Courses</strong></a></p>
                        </div>
                    </div>
                </div>

                <!-- stat 4 -->
                <div class="col-md-3">
                    <div class="card widget bg-stff">
                        <div class="widget-icon widget-success">
                            <i class="mdi mdi-calendar-clock"></i>
                        </div>
                        <div class="widget-title">
                            <h1>{{$Not}}</h1>
                            <p><strong>Total Staff</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p><i class="fa-solid fa-person-chalkboard fa-lg"></i>&nbsp;&nbsp;<a href="/academic"><strong>Go to Academic Staff</strong></a></p>
                        </div>
                    </div>
                </div>

                <div>
                <br>
                </div>   

                <!-- stat 5 -->
                <div class="col-md-3">
                    <div class="card widget bg-mtincm">
                        <div class="widget-icon widget-primary">
                            <i class="mdi mdi-account-convert"></i>
                        </div>
                        <div class="widget-title">
                            <h1></h1>
                            <p><strong>This Month Total Income</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p><i class="fa-solid fa-chalkboard-user fa-lg"></i>&nbsp;&nbsp;<a href="//income"><strong>Go to Income</strong></a></p>
                        </div>
                    </div>
                </div>

                <!-- stat 6 -->
                <div class="col-md-3">
                    <div class="card widget bg-mtinv">
                        <div class="widget-icon widget-warning">
                            <i class="mdi mdi-cash"></i>
                        </div>
                        <div class="widget-title">
                            <h1></h1>
                            <p><strong>This Month Total Invoice Paid</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p><i class="fa-solid fa-chalkboard-user fa-lg"></i>&nbsp;&nbsp;<a href="//income"><strong>Go to Income</strong></a></p>
                        </div>
                    </div>
                </div>

                <!-- stat 7 -->
                <div class="col-md-3">
                    <div class="card widget bg-munpinv">
                        <div class="widget-icon widget-danger">
                            <i class="mdi mdi-cash-usd"></i>
                        </div>
                        <div class="widget-title">
                            <h1></h1>
                            <p><strong>Unpaid Invoices in</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p><i class="fa-solid fa-chalkboard-user fa-lg"></i>&nbsp;&nbsp;<a href="//income"><strong>Go to Income</strong></a></p>
                        </div>
                    </div>
                </div>

                <!-- stat 8 -->
                <div class="col-md-3">
                    <div class="card widget bg-penin">
                        <div class="widget-icon widget-success">
                            <i class="mdi mdi-calendar-clock"></i>
                        </div>
                        <div class="widget-title">
                            <h1></h1>
                            <p><strong>Pending Income</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p><i class="fa-solid fa-chalkboard-user fa-lg"></i>&nbsp;&nbsp;<a href="//income"><strong>Go to Income</strong></a></p>
                        </div>
                    </div>
                </div>


                <div>
                <br>
                </div> 

                <div class="col-md-4">
                    <div class="card widget">
                        <div class="card-header bg-pp">
                            <p><strong>Active Batches</strong></p>
                        </div>
                        <div class="card-body">
                            <canvas id="activeBatchChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                         <div class="card-header bg-lp">
                             <p><strong>Recent Applicant Entries</strong> </p>
                         </div>
                         <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                     <th>Full Name</th>
                                     <th>Gender</th>
                                     <th>Contact</th>
                                     <th>Email</th>
                                     <th>Batch</th>
                                     <th>Applied On</th>
                                    </tr>
                                 </thead>
                                <tbody>
                                    @foreach($recentApplicants as $applicant)
                                        <tr>
                                            <td>{{ $applicant->fullname }}</td>
                                            <td>{{ $applicant->gender }}</td>
                                            <td>{{ $applicant->mphone }}</td>
                                            <td>{{ $applicant->email }}</td>
                                            <td>{{ $applicant->batch->batchname ?? 'NA' }}</td>  
                                            <td>{{ $applicant->created_at->format('d-M-Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                     </div>
                </div>

           </div>
        </div>
    </div>
        </div>
</div>



<script>
var ctx = document.getElementById('activeBatchChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {!! json_encode($CharData) !!},
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});

</script>


@endsection

