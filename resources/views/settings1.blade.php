@extends('layouts.app2')

@push('styles')
@endpush

@section('row_content')

    {{-- <div class="row">
        <div class="card col-" style="border: 3px solid red; height: 90vh; margin-bottom: 16px;">
            <!--begin::Body-->
         <div class="card-body p-lg-17">
            <!--begin::Phone-->
            <div class="bg-light card-rounded d-flex flex-column flex-center flex-center p-10 h-100">
                <!--begin::Subtitle-->
                <h1 class="text-dark fw-bold my-5">Under Serious Construction</h1>
                <!--end::Subtitle-->
                <!--begin::Number-->
                <img src="{{ asset('giphy.gif') }}" alt="working">
                <!--end::Number-->

            </div>
            <!--end::Phone-->
        </div>
            <!--end::Body-->

            <div class="container m-6" >
            <div class=" card two-thirds" style="border: 3px solid red; margin: 4px;">
                <!-- Content for two-thirds section -->
            </div>
            <div class="card one-third" style="border: 3px solid red; margin: 4px;">
                <!-- Content for one-third section -->
            </div>
        </div> 
        </div>
        <div class="card" style="border: 3px solid red; height: 90vh; margin-bottom: 16px;">
            <!--begin::Body-->
            <div class="card-body p-lg-17">
            <!--begin::Phone-->
            <div class="bg-light card-rounded d-flex flex-column flex-center flex-center p-10 h-100">
                <!--begin::Subtitle-->
                <h1 class="text-dark fw-bold my-5">Under Serious Construction</h1>
                <!--end::Subtitle-->
                <!--begin::Number-->
                <img src="{{ asset('giphy.gif') }}" alt="working">
                <!--end::Number-->

            </div>
            <!--end::Phone-->
        </div>
            <!--end::Body-->

             <div class="container m-6" >
            <div class=" card two-thirds" style="border: 3px solid red; margin: 4px;">
                <!-- Content for two-thirds section -->
            </div>
            <div class="card one-third" style="border: 3px solid red; margin: 4px;">
                <!-- Content for one-third section -->
            </div>
        </div>
        </div>
    </div>  --}}

    <!--begin::Col-->
    <div class="col-xxl-8 col-md-8 mb-xxl-10">
        <!--begin::Mixed Widget 5-->
        <div class="card card-bordered">
            <div class="card-body">
                <div style="height: 800px;"></div>
            </div>
        </div>
        <!--end::Mixed Widget 5-->
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-xxl-4 col-md-4 mb-xxl-10">
        <!--begin::Mixed Widget 5-->
        <div class="card card-bordered">
            <div class="card-body">
                <div style="height: 800px;"></div>
            </div>
        </div>
        <!--end::Mixed Widget 5-->
    </div>
    <!--end::Col-->

@endsection
