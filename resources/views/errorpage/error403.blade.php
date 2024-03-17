@extends('layouts.app')

@section('content')
    <!-- header -->
    @include('includes/header')
     <div class="container-fluid px-0 bg-dark">

        <div class="row justify-content-center bg-dark">

            <div class="col-md-12 col-sm-12 d-flex flex-column h-sm-100 p-0" id="cont">
                <div id="appi">
                    <div>403</div>
                    <div class="txt">
                        Forbidden<span class="blink">_</span>
                    </div>
                </div>
             </div>
        </div>
    </div>


@endsection
