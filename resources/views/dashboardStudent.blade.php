@extends('layouts.app')

@section('content')
 <!-- header -->
 @include("includes/header")
 <div class="container-fluid px-0">

    <div class="row justify-content-center ">
        <div class="col-12 col-md-2 p-0 " id="sbars">
            @include('includes/sidebarStudent')
        </div>
        <div class="col-md-10 col-sm-12 d-flex flex-column h-sm-100 p-0" id="cont">

            <div class="card">
                <div class="card-header">{{ __('Dashboard_student') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="row">

                <!-- stat 1 -->
                <div class="col-md-3">
                    <div class="card widget bg-noc">
                        <div class="widget-sicon widget-primary">
                            <i class="mdi mdi-account-convert"></i>
                        </div>
                        <div class="widget-title">
                            <h1></h1>
                            <p><strong>Number of Courses</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p class="text-primary"><i class="mdi mdi-menu-up"></i> %</p>
                        </div>
                    </div>
                </div>

                <!-- stat 2 -->
                <div class="col-md-3">
                    <div class="card widget bg-tma">
                        <div class="widget-icon widget-warning">
                            <i class="mdi mdi-cash"></i>
                        </div>
                        <div class="widget-title">
                            <h1> %</h1>
                            <p><strong>This Month Attendance</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p class="text-warning"><i class="mdi mdi-menu-up"></i> %</p>
                        </div>
                    </div>
                </div>

                <!-- stat 3 -->
                <div class="col-md-3">
                    <div class="card widget bg-lp">
                        <div class="widget-icon widget-danger">
                            <i class="mdi mdi-cash-usd"></i>
                        </div>
                        <div class="widget-title">
                            <h1> %</h1>
                            <p><strong>Lesson Progress</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p class="text-danger"><i class="mdi mdi-menu-up"></i> %</p>
                        </div>
                    </div>
                </div>

                <!-- stat 4 -->
                <div class="col-md-3">
                    <div class="card widget bg-pp">
                        <div class="widget-icon widget-success">
                            <i class="mdi mdi-calendar-clock"></i>
                        </div>
                        <div class="widget-title">
                            <h1></h1>
                            <p><strong>Pending Payment</strong></p>
                        </div>
                        <div class="widget-trend">
                            <p class="text-success"><i class="mdi mdi-menu-up"></i> %</p>
                        </div>
                    </div>
                </div>

                <div>
                <br>
                </div> 

                <!-- Table -->
                <div class="col-md-12">
                    <div class="card">
                         <div class="card-header bg-att">
                             <p><strong>Public Notifications</strong></p>
                         </div>
                         <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                     <th>Messege</th>
                                     <th>Received Date</th>
                                     <th>Sender</th>
                                    </tr>
                                 </thead>
                                <tbody>
                                    <!-- foreach(recentApplicants as applicant -->
                                        <tr>
                                            <td>Test Messege</td>
                                            <td>Today</td>
                                            <td>Ruvinda</td>
                                        </tr>
                                    <!-- endforeach-->
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
</div>
@endsection
