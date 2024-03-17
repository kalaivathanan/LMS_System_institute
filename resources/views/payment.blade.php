@extends('layouts.app')

@section('content')
    <!-- header -->
    @include('includes/header')
    <div class="container-fluid px-0">

        <div class="row justify-content-center ">
            <div class="col-12 col-md-2 p-0 " id="sbars">
                @include('includes/sidebarStudent')
            </div>
            <div class="col-md-10 col-sm-12 d-flex flex-column h-sm-100 p-0" id="cont">

                <div class="card">
                    <div class="card-header">

                        <h4 class="titleheader_"> Student Payment Details <span class='text-danger'> _
                                </span>
                        </h4>
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
                                        <th class="text-capitalize">Payment Type</th>
                                        <th class="text-capitalize" width="100">Amount</th>
                                        <th class="text-capitalize" width="50">Invoice</th>
                                        <th width="100">Paid Date</th>
                                        <th width="100">Due Date</th>
                                        <th class="text-capitalize" width="100">Status</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studentPaymentDetails as $key => $paymentDetail)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$paymentDetail->type}}</td>
                                        <td>{{$paymentDetail->amount}}</td>
                                        <td>{{$paymentDetail->invoice}}</td>
                                        <td>{{$paymentDetail->paidDate}}</td>
                                        <td>{{$paymentDetail->duedate}}</td>
                                        <td> <span style="{{$paymentDetail->status == "pending" ? 'background:red;' : ($paymentDetail->status == "request" ? 'background:blue; color:white;' : 'background:green; color:white;')  }} padding:2px;  border-radius: 5px;" >{{$paymentDetail->status}}</span></td>
                                        <td>
                                        @if($paymentDetail->status === "paid")
                                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                                        @else
                                        <div class="btn-group"> 
                                            <a href="${url}" class="btn btn-warning btn-sm viewApplicants" data-toggle="modal" data-target="#registerStudentModal{{$paymentDetail->id}}" data-row="${row.id}">
                                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <!-- Modal  Register applicant -->
                                        <div class="modal" id="registerStudentModal{{$paymentDetail->id}}"  role="dialog"
                                            aria-labelledby="registerStudentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content bg-success text-light">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="registerStudentModalLabel">Student Payment</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('student.payment', $paymentDetail->id)}}" method="post" >
                                                        @csrf
                                                        @method('post')
                                                        <div class="modal-body">
                                                            <input type="hidden" id="appid" name="appid" value="{{$applicant->id}}">
                                                            <div class="form-group pb-2">
                                                                <label for="stname">Student Name</label>
                                                                <input type="text" value="{{$applicant->fullname}}" class="form-control" id="stname" name="stname" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="regdate">Request Date</label>
                                                                <input type="date" value="{{date('Y-m-d')}}" class="form-control  @error('regdate') is-invalid @enderror" id="regdate" name="regdate" required>
                                                            <div class="invalid-feedback text-warning">
                                                                @error('regdate') {{ $message }} @enderror 
                                                                
                                                                </div>
                                                            </div>
                                                            <div class="form-group row align-items-center pt-4">
                                                                <label for="payment" class="col-sm-4 col-form-label">{{$paymentDetail->type}}</label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" value="{{$paymentDetail->amount}}" class="form-control" id="amount" name="amount" disabled>
                                                                </div>
                                                                
                                                                <div class="col-sm-4">
                                                                    <input type="text" value="{{isset($paymentDetail->invoice) ? $paymentDetail->invoice : '' }}" class="form-control @error('invoice') is-invalid @enderror" id="invoice" name="invoice"
                                                                        placeholder="Invoice_No" >
                                                                        <div class="invalid-feedback text-warning">
                                                                @error('invoice') {{ $message }} @enderror 
                                                                
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" id="closeBtn" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" >Request</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        </td>

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
    
    @endsection