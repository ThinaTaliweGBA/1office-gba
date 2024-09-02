@extends('layouts.app2')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .inner-card {
            margin-bottom: 15px;
        }
    </style>

    <style>
        .action-buttons {
            text-align: right;
            padding-top: 10px;
            /* Space between record info and buttons */
        }
    </style>

    <style>
        .json-key {
            color: #a52a2a;
            /* Brown */
        }

        .json-value {
            color: #008000;
            /* Green */
        }

        .json-string {
            color: #d14;
            /* Red */
        }

        .special-link {
            display: inline-block;
            background-color: #007bff;
            /* Bootstrap primary color */
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .special-link:hover,
        .special-link:focus {
            background-color: #white;
            /* Darker blue */
            color: white;
            text-decoration: none;
        }
    </style>

    <style>
        input::placeholder,
        textarea::placeholder {
            color: #fefefe;
            /* Change the color as needed */
        }
    </style>

    <style>
        /* Custom CSS classes for SweetAlert */
        .swal2-title {
            color: black !important;
            /* Change title text color */
        }

        .swal2-content {
            color: black !important;
            /* Change content text color */
        }
    </style>

    {{-- This is for accordion -- SIYA --}}

    <style>
        /* Adjusting the accordion header/button background color */
        .accordion-button {
            background-color: #448C74 !important;
            /* #b7cebe Your specified green color */
            color: white !important;
            /* #343a40 Ensuring text color is readable against the green background */
        }

        /* Style for accordion button when accordion is open */
        .accordion-button:not(.collapsed) {
            background-color: #448C74 !important;
            /* #9fb3aa A slightly darker shade of green for contrast */
            color: white !important;
            /* #343a40 Keeping text color consistent; change as desired */
        }

        /* Hover effect for accordion button */
        .accordion-button:hover {
            background-color: #a5c1b2 !important;
            /* A lighter/different shade for hover effect */
            color: #343a40 !important;
            /* Ensuring text color is readable on hover; adjust as needed */
        }

        /* Adjusting icon colors */
        .accordion-button .fas,
        .accordion-button .far,
        .accordion-button .arrow-indicator::before {
            /* Targeting the arrow indicator if it's a pseudo-element */
            color: #FFFFFF !important;
            /* White */
        }

        /* Style for accordion button when input is missing */
        .accordion-button.missing-input {
            background-color: #c71f3f !important;
            /*#e57373 #f20d20b7 A nice, complementing red */
            color: #FFFFFF !important;
            /* White text for readability */
        }
    </style>

    <style>
        input:required,
        select:required {
            border: 2px solid #ced4da;
            /* Bootstrap's default border color for form inputs */
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            /* Smooth transition for visual feedback */
        }

        input:invalid,
        select:invalid {
            border-color: #e57373 !important;
            /* A complementing red for missing required inputs */
            box-shadow: 0 0 0 .2rem rgba(229, 115, 115, .25);
            /* Optional: add a subtle shadow to further highlight the field */
        }

        /* Uncomment if you want to use green borders for valid inputs */
        /* input:valid, select:valid {
                                            border-color: #28a745 !important; /* Change to green when the input becomes valid */


        */
    </style>

    <style>
        .form-control {
            background-color: white !important;
        }
    </style>

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            overflow-y: auto;
            /* Add vertical scroll */
        }

        #main-container {
            height: 100%;
        }

        .card-column,
        .drawer-column {
            transition: all 0.3s ease;
        }

        .drawer-column {
            max-width: 400px;
        }

        .hide-drawer {
            display: none;
        }

        .show-button {
            display: none;
        }

        .show-drawer .show-button {
            display: block;
        }
    </style>
@endpush

@section('row_content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

                @if ($errors->has('custom_error'))
                    @foreach ($errors->get('custom_error') as $customErrors)
                        @foreach ($customErrors as $customError)
                            <li>{{ $customError }}</li>
                        @endforeach
                    @endforeach
                @endif
            </ul>
        </div>
    @endif

    @php
        $relationshipMappings = [
            1 => 1, //Spouse
            2 => 4, //Child
            3 => 4, //Disabled Child (Should be change, currently same as Child)
            4 => 2, //Parent
        ];
        // Extract keys to use for checking if an ID is remapped
        $remappedIds = array_keys($relationshipMappings);

        // Create a lookup array for relationship names based on their IDs
        $relationshipNames = $relationships->pluck('name', 'id')->all();

        // Create a lookup array for gender names based on their IDs
        $genderNames = $genders->pluck('name', 'id')->all();
    @endphp

    <div class="col-9 card-column position-relative mb-10">
        {{-- <div class="card rounded shadow h-100"> --}}
        <!-- Card Content Here -->

        {{-- <button id="show-button" class="btn btn-primary show-button">Show</button> --}}
        <div class="card rounded shadow">
            <h1 class="my-4" style="margin-left: auto; margin-right: auto; width: fit-content;">Resolution Hub</h1>
            {{-- <h2>Grouped Records by Membership ID</h2> --}}
            <div class="card inner-card"></div>
            <div class="card-header ">
                
                    <form action="{{ route('resolutionhub') }}" method="GET" class="form-inline">
                        <div class="form-group mb-2">
                            <label for="search" class="sr-only">Membership ID:</label>
                            <input type="text" class="form-control mt-2" id="search" name="search"
                                placeholder="Enter Membership ID" value="{{ $search ?? '' }}">
                        </div>



                        <button type="submit" class="btn btn-sm my-2 ml-2 btn-success">Search</button>
                        <a href="{{ route('resolutionhub') }}" class="btn btn-sm mb-2 ml-2 my-2 btn-danger">Reset</a>

                        <div class="form-group mx-sm-3 mb-2 mt-2">
                            <label for="sort" class="sr-only">Sort By:</label>
                            <select name="sort" id="sort" class="form-select form-select-sm" style="height: 50%;"
                                onchange="this.form.submit()">
                                <option
                                    value="membership_id_asc"{{ request('sort') == 'membership_id_asc' ? ' selected' : '' }}>
                                    Membership ID Ascending</option>
                                <option
                                    value="membership_id_desc"{{ request('sort') == 'membership_id_desc' ? ' selected' : '' }}>
                                    Membership ID Descending</option>
                                <option value="join_date_asc"{{ request('sort') == 'join_date_asc' ? ' selected' : '' }}>
                                    Date Joined
                                    Ascending</option>
                                <option value="join_date_desc"{{ request('sort') == 'join_date_desc' ? ' selected' : '' }}>
                                    Date
                                    Joined Descending</option>
                            </select>
                        </div>
                    </form>

                    <h4><button id="show-button" class="btn btn-sm btn-info show-button mt-4">Show Details</button></h4>


            </div>
            <div class="card-body">
            @if ($paginatedItems->count() > 0)
                @foreach ($paginatedItems as $item)
                    <form id="mainForm" method="POST" action="{{ route('handleMainRecordAction') }}">
                        @csrf {{-- CSRF token for form submission --}}
                        <div class="mb-2">
                            <div class="">
                                <h3 class="text-center">Main Record ID: {{ $item['membershipId'] }}</h3>
                            </div>
                            <div class="mx-2">
                                <!--begin::Accordion-->
                                <div class="accordion mb-3" id="kt_accordion_{{ $loop->index }}">
                                    <!-- First Accordion Item for Membership Details -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="kt_accordion_{{ $loop->index }}_header_1">
                                            <button
                                                class="accordion-button fs-4 fw-semibold{{ $loop->first ? '' : ' collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#kt_accordion_{{ $loop->index }}_body_1"
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                aria-controls="kt_accordion_{{ $loop->index }}_body_1">
                                                Membership Details
                                            </button>

                                        </h2>
                                        <div id="kt_accordion_{{ $loop->index }}_body_1"
                                            class="accordion-collapse collapse{{ $loop->first ? ' show' : '' }}"
                                            aria-labelledby="kt_accordion_{{ $loop->index }}_header_1"
                                            data-bs-parent="#kt_accordion_{{ $loop->index }}">
                                            <div class="accordion-body">
                                                <!-- Accordion content for Membership Details -->
                                                <!-- Main Record Card as Form -->
                                                @if ($item['main'])
                                                    <input type="hidden" id="main_original_json_{{ $item['main']->id }}"
                                                        name="main_original_json_{{ $item['main']->id }}"
                                                        value="{{ $item['main']->complete_original_record }}">

                                                    <div class="row mb-4">
                                                        <!--begin::Trigger button-->
                                                        {{-- <button id="kt_drawer_main_member_button" class="btn btn-light-primary">See
                                                    Original Record</button> --}}
                                                        <!--end::Trigger button-->
                                                    </div>
                                                    <!--begin::Drawer-->
                                                    <div id="kt_drawer_main_member" class="bg-white" data-kt-drawer="true"
                                                        data-kt-drawer-activate="true"
                                                        data-kt-drawer-toggle="#kt_drawer_main_member_button"
                                                        data-kt-drawer-close="#kt_drawer_main_member_close"
                                                        data-kt-drawer-width="{default:'300px', 'md': '400px'}">

                                                        <!--begin::Card-->
                                                        <div class="card w-100 rounded-0">
                                                            <!--begin::Card header-->
                                                            <div class="card-header pe-5">
                                                                <!--begin::Title-->
                                                                <div class="card-title">
                                                                    <!--begin::User-->
                                                                    <div
                                                                        class="d-flex justify-content-center flex-column me-3">
                                                                        <a href="#"
                                                                            class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 lh-1">Main
                                                                            Membership Original Details</a>
                                                                    </div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Title-->


                                                            </div>
                                                            <!--end::Card header-->

                                                            <!--begin::Card body-->
                                                            <div class="card-body hover-scroll-overlay-y">
                                                                @php
                                                                    $originalRecord = json_decode(
                                                                        $item['main']->complete_original_record,
                                                                        true,
                                                                    );
                                                                @endphp
                                                                @if ($originalRecord)
                                                                    @foreach ($originalRecord as $key => $value)
                                                                        <div
                                                                            class="d-flex align-items-center flex-wrap mb-2">
                                                                            <div id="kt_clipboard_{{ $loop->index }}"
                                                                                class="me-5">
                                                                                <strong>{{ $key }}:</strong>
                                                                                <span
                                                                                    class="copy-value">{{ $value }}</span>
                                                                            </div>
                                                                            @if (strlen($value) > 0)
                                                                                <button
                                                                                    class="btn btn-icon btn-sm btn-light"
                                                                                    data-clipboard-target="#kt_clipboard_{{ $loop->index }}">
                                                                                    <i
                                                                                        class="ki-duotone ki-copy fs-2 text-muted"></i>
                                                                                </button>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <p>No original record found.</p>
                                                                @endif
                                                            </div>
                                                            <!--end::Card body-->
                                                        </div>
                                                        <!--end::Card-->
                                                    </div>
                                                    <!--end::Drawer-->


                                                    <div class="row">
                                                        <!-- Membership ID and Membership Type -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="membership_id">Membership ID</label>
                                                                <input type="text" class="form-control"
                                                                    id="membership_id" name="membership_id" readonly
                                                                    value="{{ $item['main']->membership_id }}">
                                                            </div>
                                                        </div>



                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="bu_membership_type_id">Membership
                                                                    Type</label>
                                                                <select class="form-control" id="bu_membership_type_id"
                                                                    name="bu_membership_type_id" style="height: 50%;"
                                                                    required>
                                                                    <!-- Empty option for no selection/default -->
                                                                    <option disabled value="" selected>Select
                                                                        Membership
                                                                        Type</option>
                                                                    @foreach ($dropdownBuMemTyp as $type)
                                                                        <option value="{{ $type->id }}"
                                                                            {{ old('bu_membership_type_id', $item['main']->membership_type ?? '') == $type->name ? 'selected' : '' }}>
                                                                            {{ $type->name }} -
                                                                            {{ $type->description }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <!-- First Name, Initials, and Last Name -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="first_name">First Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="first_name" name="first_name"
                                                                    value="{{ $item['main']->first_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="initials">Initials</label>
                                                                <input type="text" class="form-control" id="initials"
                                                                    name="initials"
                                                                    value="{{ $item['main']->initials }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="last_name">Last Name</label>
                                                                <input type="text" class="form-control" id="last_name"
                                                                    name="last_name"
                                                                    value="{{ $item['main']->last_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="screen_name">Screen Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="screen_name" name="screen_name"
                                                                    value="{{ $item['main']->screen_name }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="id_number">ID Number</label>
                                                                <input type="text" class="form-control" id="id_number"
                                                                    name="id_number"
                                                                    value="{{ $item['main']->id_number }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="birth_date">Birth Date</label>
                                                                <input type="date" class="form-control"
                                                                    id="birth_date" name="birth_date"
                                                                    value="{{ !empty($item['main']->birth_date) ? \Carbon\Carbon::parse($item['main']->birth_date)->format('Y-m-d') : '' }}">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="join_date">Join Date</label>
                                                                <input type="date" class="form-control" id="join_date"
                                                                    name="join_date"
                                                                    value="{{ !empty($item['main']->join_date) ? \Carbon\Carbon::parse($item['main']->join_date)->format('Y-m-d') : '' }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="end_date">End Date</label>
                                                                <input type="date" class="form-control" id="end_date"
                                                                    name="end_date"
                                                                    value="{{ !empty($item['main']->end_date) ? \Carbon\Carbon::parse($item['main']->end_date)->format('Y-m-d') : '' }}">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <!-- primary_contact_number, secondary_contact_number, and tertiary_contact_number -->
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="primary_contact_number">Primary Contact
                                                                    Number</label>
                                                                <input type="text" class="form-control"
                                                                    id="primary_contact_number"
                                                                    name="primary_contact_number"
                                                                    value="{{ $item['main']->primary_contact_number }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="secondary_contact_number">Secondary Contact
                                                                    Number</label>
                                                                <input type="text" class="form-control"
                                                                    id="secondary_contact_number"
                                                                    name="secondary_contact_number"
                                                                    value="{{ $item['main']->secondary_contact_number }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="tertiary_contact_number">Tertiary Contact
                                                                    Number</label>
                                                                <input type="text" class="form-control"
                                                                    id="tertiary_contact_number"
                                                                    name="tertiary_contact_number"
                                                                    value="{{ $item['main']->tertiary_contact_number }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="primary_e_mail_address">Email
                                                                    Address</label>
                                                                <input type="text" class="form-control"
                                                                    id="primary_e_mail_address"
                                                                    name="primary_e_mail_address"
                                                                    value="{{ $item['main']->primary_e_mail_address }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="secondary_e_mail_address">Email Address 2
                                                                    (optional)
                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    id="secondary_e_mail_address"
                                                                    name="secondary_e_mail_address"
                                                                    value="{{ $item['main']->secondary_e_mail_address }}">
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="row">




                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="marriage_status_id">Marriage Status</label>
                                                                <select class="form-control" id="marriage_status_id"
                                                                    name="marriage_status_id" style="height: 50%;">
                                                                    @foreach ($marriageStatuses as $marriage_status)
                                                                        <option value="{{ $marriage_status->id }}"
                                                                            {{ $item['main']->married_status == $marriage_status->id ? 'selected' : '' }}>
                                                                            {{ $marriage_status->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="gender_id">Gender</label>
                                                                <select class="form-control" id="gender_id"
                                                                    name="gender_id" style="height: 50%;">
                                                                    @foreach ($genders as $gender)
                                                                        <option value="{{ $gender->id }}"
                                                                            {{ $item['main']->gender_id == $gender->id ? 'selected' : '' }}>
                                                                            {{ $gender->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>



                                                        <!-- Dropdown for Membership Status -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="bu_membership_status_id">Membership
                                                                    Status</label>
                                                                <select class="form-control" id="bu_membership_status_id"
                                                                    name="bu_membership_status_id" style="height: 50%;"
                                                                    required>
                                                                    <!-- Empty option for no selection/default -->
                                                                    <option disabled value="" selected>Select
                                                                        Membership
                                                                        Status</option>
                                                                    @foreach ($dropdownBuMemSta as $status)
                                                                        <option value="{{ $status->id }}">
                                                                            {{ $status->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>



                                                        <!-- Dropdown for Membership Region -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="bu_membership_region_id">Membership
                                                                    Region</label>
                                                                <select class="form-control" id="bu_membership_region_id"
                                                                    name="bu_membership_region_id" style="height: 50%;">
                                                                    <!-- Empty option for no selection/default -->
                                                                    <option disabled value="">Select Membership
                                                                        Region
                                                                    </option>
                                                                    @foreach ($dropdownBuMemReg as $index => $region)
                                                                        <option value="{{ $region->id }}"
                                                                            {{ $index == 0 ? 'selected' : '' }}>
                                                                            {{ $region->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>



                                                    </div>


                                                    <div class="row">
                                                        <!-- last_payment_date and paid_till_date -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="last_payment_date">Last Payment
                                                                    Date</label>
                                                                <input type="date" class="form-control"
                                                                    id="last_payment_date" name="last_payment_date"
                                                                    value="{{ !empty($item['main']->last_payment_date) ? \Carbon\Carbon::parse($item['main']->last_payment_date)->format('Y-m-d') : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paid_till_date">Paid Till Date</label>
                                                                <input type="date" class="form-control"
                                                                    id="paid_till_date" name="paid_till_date"
                                                                    value="{{ !empty($item['main']->paid_till_date) ? \Carbon\Carbon::parse($item['main']->paid_till_date)->format('Y-m-d') : '' }}">
                                                            </div>
                                                        </div>

                                                    </div>
                                                @else
                                                    <div class="card-header">Duplicate Records</div>
                                                    <div class="card-body">
                                                        <p>No main records found for this Membership ID.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Second Accordion Item for Physical Address -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="kt_accordion_{{ $loop->index }}_header_2">
                                            <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#kt_accordion_{{ $loop->index }}_body_2"
                                                aria-expanded="false"
                                                aria-controls="kt_accordion_{{ $loop->index }}_body_2">
                                                Physical Address
                                            </button>
                                        </h2>
                                        <div id="kt_accordion_{{ $loop->index }}_body_2"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="kt_accordion_{{ $loop->index }}_header_2"
                                            data-bs-parent="#kt_accordion_{{ $loop->index }}">
                                            <div class="accordion-body">
                                                <!-- Accordion content for Physical Address -->

                                                <div class=" mb-4 pb-4">
                                                    <div class="card-body pt-4 p-3">
                                                        <div class="row mt-3">
                                                            <div class="col">
                                                                <div
                                                                    class="input-group input-group-outline  @error('Line1') is-invalid focused is-focused  @enderror  mb-0">
                                                                    <input type="text" class="form-control"
                                                                        name="Line1" id="Line1"
                                                                        value="{{ old('Line1') }}" required>
                                                                </div>
                                                                @error('Line1')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-6 col-sm-6">
                                                                <div
                                                                    class="input-group input-group-outline  @error('Line2') is-invalid focused is-focused  @enderror  mb-0">

                                                                    <input type="text" class="form-control"
                                                                        name="Line2" id="Line2"
                                                                        value="{{ old('Line2') }}"
                                                                        placeholder="Address Line 2">
                                                                </div>
                                                                @error('Line2')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-6 col-sm-6">
                                                                <div
                                                                    class="input-group input-group-outline  @error('TownSuburb') is-invalid focused is-focused  @enderror  mb-0">

                                                                    <input type="text" class="form-control"
                                                                        name="TownSuburb" id="TownSuburb"
                                                                        value="{{ old('TownSuburb') }}"
                                                                        placeholder="Town/Suburb">
                                                                </div>
                                                                @error('TownSuburb')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-12 col-sm-6">
                                                                <div
                                                                    class="input-group input-group-outline  @error('City') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                    <input type="text" class="form-control"
                                                                        name="City" id="City"
                                                                        value="{{ old('City') }}" placeholder="City">
                                                                </div>
                                                                @error('City')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                                <div
                                                                    class="input-group input-group-outline  @error('Province') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                    <input type="text" class="form-control"
                                                                        name="Province" id="Province"
                                                                        value="{{ old('Province') }}"
                                                                        placeholder="Province">
                                                                </div>
                                                                @error('Province')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-6 col-sm-2 mt-3 mt-sm-0">
                                                                <div
                                                                    class="input-group input-group-outline  @error('PostalCode') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                    <input type="text" class="form-control"
                                                                        name="PostalCode" id="PostalCode"
                                                                        value="{{ old('PostalCode') }}"
                                                                        placeholder="Postal Code">
                                                                </div>
                                                                @error('PostalCode')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">

                                                            <div class="col-6 col-sm-4 mt-3 mt-sm-0 mx-auto">
                                                                <div
                                                                    class="input-group input-group-outline  @error('Country') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                    <input type="text" class="form-control"
                                                                        name="Country" id="Country"
                                                                        value="{{ old('Province') }}"
                                                                        placeholder="Country">
                                                                </div>
                                                                @error('Country')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>


                                                        </div>

                                                    </div>


                                                    <div
                                                        style="text-align: center; display: flex; justify-content: center; align-items: center; ">
                                                        <span style="color: white; margin-right: 10px;">Powered
                                                            by</span>
                                                        <img src="{{ asset('img/google.png') }}" alt="Google Logo"
                                                            style="width: 50px; height: auto;">
                                                    </div>
                                                </div>




                                            </div>
                                        </div>
                                    </div>
                                    <!--END: Second Accordion Item for Physical Address -->

                                    <!-- Third Accordion Item for Payment Details -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="kt_accordion_{{ $loop->index }}_header_3">
                                            <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#kt_accordion_{{ $loop->index }}_body_3"
                                                aria-expanded="false"
                                                aria-controls="kt_accordion_{{ $loop->index }}_body_3">
                                                Payment Details
                                            </button>
                                        </h2>
                                        <div id="kt_accordion_{{ $loop->index }}_body_3"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="kt_accordion_{{ $loop->index }}_header_3"
                                            data-bs-parent="#kt_accordion_{{ $loop->index }}">
                                            <div class="accordion-body">
                                                <!-- Accordion content for Payment Details -->




                                                {{-- Start Payment Method --}}
                                                    <h4 class="text-center mb-4">Select Default Payment Method</h4>
                                                    <div class="d-flex align-items-center mb-3 px-4">
                                                        <select class="form-select" id="paymentMethod"
                                                            name="payment_method_id"
                                                            style="background-color: white !important" required>
                                                            <option selected disabled value="">Select Payment
                                                                Method
                                                            </option>
                                                            @foreach ($paymentmethods as $paymentmethod)
                                                                <option value="{{ $paymentmethod->id }}">
                                                                    {{ $paymentmethod->historic_ref }}.{{ $paymentmethod->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                {{-- End Payment Metod --}}








                                                {{-- Start Payment List --}}
                                                <div class="card my-4">
                                                    <!-- EFT Section -->
                                                    <div id="eftSection" class="payment-section card"
                                                        style="display: none;">
                                                        <h2 class="m-4 text-center">EFT Payment Details</h2>

                                                        <div class="container-fluid">
                                                            <!-- Row 1 for Account Holder and Bank Name -->
                                                            <div class="row">
                                                                <!-- Account Holder -->
                                                                <div class="col-md-5 fv-row">
                                                                    <label
                                                                        class="required fs-6 fw-semibold form-label mb-2">Account
                                                                        Holder</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-solid"
                                                                        placeholder="Enter Account Holder"
                                                                        name="accountHolder" value="" />
                                                                </div>

                                                                <!-- Bank Name -->
                                                                <div class="col-md-4 fv-row">
                                                                    <label
                                                                        class="required fs-6 fw-semibold form-label mb-2">Bank
                                                                        Name</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-solid"
                                                                        placeholder="Enter Bank Name" name="bankName"
                                                                        value="" />
                                                                </div>

                                                                <!-- Branch Code -->
                                                                <div class="col-md-3 fv-row">
                                                                    <label
                                                                        class="required fs-6 fw-semibold form-label mb-2">Branch
                                                                        Code</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-solid"
                                                                        placeholder="Enter Branch Code" name="branchCode"
                                                                        value="" />
                                                                </div>
                                                            </div>

                                                            <!-- Row 2 for Account Number and Branch Code -->
                                                            <div class="row mb-4">
                                                                <!-- Account Number -->
                                                                <div class="col-md-6 fv-row">
                                                                    <label
                                                                        class="required fs-6 fw-semibold form-label mb-2">Account
                                                                        Number</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-solid"
                                                                        placeholder="Enter Account Number"
                                                                        name="accountNumber" value="" />
                                                                </div>

                                                                <div class="col-md-4 fv-row">
                                                                    <label
                                                                        class="required fs-6 fw-semibold form-label mb-2">Account
                                                                        Type</label>
                                                                    <select class="form-select form-select-solid"
                                                                        name="accountType" data-control="select2"
                                                                        data-hide-search="true">
                                                                        <option value="">Select Account Type
                                                                        </option>
                                                                        <option value="checking">Checking</option>
                                                                        <option value="savings">Savings</option>
                                                                        <!-- Add more options as necessary -->
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>




                                                    <!-- Debit Order Section -->
                                                    {{-- <div id="3Section" class="payment-section card p-4"
                                                                            style="display: none;">

                                                                            <h2 class="m-4 text-center">Debit Order Payment Details</h2>


                                                                            <!-- Bank Name Dropdown -->
                                                                            <div class="mb-3">
                                                                                <label for="eftBankName" class="form-label">Bank Name</label>
                                                                                <select class="form-control" id="BankName" style="height: 50%"
                                                                                    name="bank_id" required>
                                                                                    <option value="">Select Bank</option>
                                                                                    @foreach ($banks as $bank)
                                                                                        <option value="{{ $bank->id }}">{{ $bank->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <!-- Account Type Dropdown -->
                                                                            <div class="mb-3">
                                                                                <label for="eftAccountType" class="form-label">Account
                                                                                    Type</label>
                                                                                <select class="form-control" id="AccountType" style="height: 50%"
                                                                                    name="account_type_id" required>
                                                                                    <option value="">Select Account Type</option>
                                                                                    @foreach ($accountTypes as $type)
                                                                                        <option value="{{ $type->id }}">{{ $type->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <!-- Branch Code Dropdown (if applicable) or Input -->
                                                                            <div class="mb-3">
                                                                                <label for="eftBranchCode" class="form-label">Branch Code</label>
                                                                                <select class="form-control" id="BranchCode" style="height: 50%"
                                                                                    name="branch_code" required>
                                                                                    <option value="">Select Branch Code</option>
                                                                                    @foreach ($branchCodes as $code)
                                                                                        <option value="{{ $code->id }}">
                                                                                            {{ $code->branch_code . ' - ' . $code->bank_short_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <!-- You can convert this to an input field if branch code is not directly selectable -->
                                                                            </div>

                                                                            <!--begin::Input group-->
                                                                            <div class="d-flex flex-column mb-7 fv-row">
                                                                                <!--begin::Label-->
                                                                                <label class="required fs-6 fw-semibold form-label mb-2">Account
                                                                                    Holder</label>
                                                                                <!--end::Label-->
                                                                                <!--begin::Input wrapper-->
                                                                                <div class="position-relative">
                                                                                    <!--begin::Input-->
                                                                                    <input type="text" class="form-control form-control-solid"
                                                                                        placeholder="Enter Account Holder" name="Account Holder"
                                                                                        value="" />
                                                                                    <!--end::Input-->
                                                                                </div>
                                                                                <!--end::Input wrapper-->
                                                                            </div>
                                                                            <!--end::Input group-->

                                                                            <!-- Account Number -->
                                                                            <div class="mb-3">
                                                                                <label for="debitOrderAccountNumber" class="form-label">Account
                                                                                    Number</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="debitOrderAccountNumber" name="account_number"
                                                                                    placeholder="Enter Account Number" required>
                                                                            </div>

                                                                            <!-- Debit Order Amount -->
                                                                            <div class="mb-3">
                                                                                <label for="debitOrderAmount" class="form-label">Debit Order
                                                                                    Amount</label>
                                                                                <input type="number" class="form-control" id="debitOrderAmount"
                                                                                    name="amount" placeholder="Enter Amount" min="0"
                                                                                    required>
                                                                            </div>

                                                                            <!-- Debit Order Frequency -->
                                                                            <div class="mb-3">
                                                                                <label for="debitOrderFrequency" class="form-label">Debit Order
                                                                                    Frequency</label>
                                                                                <select class="form-control" id="debitOrderFrequency"
                                                                                    style="height: 50%" name="frequency" required>
                                                                                    <option value="">Select Frequency</option>
                                                                                    <option value="monthly">Monthly</option>
                                                                                    <option value="quarterly">Quarterly</option>
                                                                                    <option value="biannually">Bi-annually</option>
                                                                                    <option value="annually">Annually</option>
                                                                                </select>
                                                                            </div>







                                                                        </div> --}}






                                                    <!-- Data Via Section -->
                                                    <div id="dataViaSection" class="payment-section card mx-4 pb-8"
                                                        style="display: none;">
                                                        <h2 class="m-4 text-center">Data Via Payment Details</h2>


                                                        <!-- User ID -->
                                                        <div class="mb-3">
                                                            <label for="dataViaUserID" class="form-label">User
                                                                ID</label>
                                                            <input type="text" class="form-control" id="dataViaUserID"
                                                                name="user_id" placeholder="Enter User ID" required>
                                                        </div>

                                                        <!-- Transaction ID -->
                                                        <div class="mb-3">
                                                            <label for="dataViaTransactionID"
                                                                class="form-label">Transaction
                                                                ID</label>
                                                            <input type="text" class="form-control"
                                                                id="dataViaTransactionID" name="transaction_id"
                                                                placeholder="Enter Transaction ID" required>
                                                        </div>

                                                        <!-- Amount -->
                                                        <div class="mb-3">
                                                            <label for="dataViaAmount" class="form-label">Amount</label>
                                                            <input type="number" class="form-control" id="dataViaAmount"
                                                                name="amount" placeholder="Enter Amount" min="0"
                                                                required>
                                                        </div>

                                                        <!-- Payment Date -->
                                                        <div class="mb-3">
                                                            <label for="dataViaPaymentDate" class="form-label">Payment
                                                                Date</label>
                                                            <input type="date" class="form-control"
                                                                id="dataViaPaymentDate" name="payment_date" required>
                                                        </div>



                                                    </div>






                                                </div>
                                                {{-- End Payment List --}}

















                                            </div>
                                        </div>
                                    </div>
                                    <!--END: Third Accordion Item for Payment Details -->


                                    <!-- Fourth Accordion Item for Deaths -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="kt_accordion_{{ $loop->index }}_header_4">
                                            <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#kt_accordion_{{ $loop->index }}_body_4"
                                                aria-expanded="false"
                                                aria-controls="kt_accordion_{{ $loop->index }}_body_4">
                                                Deaths
                                            </button>
                                        </h2>
                                        <div id="kt_accordion_{{ $loop->index }}_body_4"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="kt_accordion_{{ $loop->index }}_header_4"
                                            data-bs-parent="#kt_accordion_{{ $loop->index }}">
                                            <div class="accordion-body">
                                                <!-- Accordion content for Deaths -->

                                                    <div class="card-body">


                                                        <!-- Deaths Card -->
                                                        @if (!$item['deaths']->isEmpty())
                                                            <div class="card inner-card my-8 bg-light">
                                                                <div class="card-header"
                                                                    style="background-color: #448C74;">
                                                                    <h3 class="card-title" style="color: white">Deaths
                                                                        (Possibly
                                                                        Just Dependants)</h3>
                                                                </div>
                                                                {{-- ordinary deaths --}}
                                                                <div class="card-body">
                                                                    @foreach ($item['deaths'] as $death)
                                                                        <!-- Hidden Inputs for death's Details -->

                                                                        <input type="hidden"
                                                                            id="death_record_id_{{ $death->id }}"
                                                                            name="death_record_id[]"
                                                                            value="{{ $death->id }}">

                                                                        <input type="hidden"
                                                                            id="death_original_json_{{ $death->id }}"
                                                                            name="death_original_json[]"
                                                                            value="{{ $death->complete_original_record }}">

                                                                        <input type="hidden"
                                                                            id="death_membership_id_{{ $death->id }}"
                                                                            name="death_membership_id[]"
                                                                            value="{{ $death->membership_id }}">
                                                                        <input type="hidden"
                                                                            id="death_first_name_{{ $death->id }}"
                                                                            name="death_first_name[]"
                                                                            value="{{ $death->first_name }}">
                                                                        <input type="hidden"
                                                                            id="death_initials_{{ $death->id }}"
                                                                            name="death_initials[]"
                                                                            value="{{ $death->initials }}">
                                                                        <input type="hidden"
                                                                            id="death_last_name_{{ $death->id }}"
                                                                            name="death_last_name[]"
                                                                            value="{{ $death->last_name }}">
                                                                        <input type="hidden"
                                                                            id="death_screen_name_{{ $death->id }}"
                                                                            name="death_screen_name[]"
                                                                            value="{{ $death->screen_name }}">
                                                                        <input type="hidden"
                                                                            id="death_id_number_{{ $death->id }}"
                                                                            name="death_id_number[]"
                                                                            value="{{ $death->id_number }}">
                                                                        <input type="hidden"
                                                                            id="death_birth_date_{{ $death->id }}"
                                                                            name="death_birth_date[]"
                                                                            value="{{ $death->birth_date }}">
                                                                        <input type="hidden"
                                                                            id="death_person_relationship_id_{{ $death->id }}"
                                                                            name="death_person_relationship_id[]"
                                                                            value="{{ $death->person_relationship_id }}">
                                                                        <input type="hidden"
                                                                            id="death_gender_id_{{ $death->id }}"
                                                                            name="death_gender_id[]"
                                                                            value="{{ $death->gender_id }}">
                                                                        <input type="hidden"
                                                                            id="death_join_date_{{ $death->id }}"
                                                                            name="death_join_date[]"
                                                                            value="{{ $death->join_date }}">

                                                                        <input type="hidden"
                                                                            id="death_deceased_date_{{ $death->id }}"
                                                                            name="death_deceased_date[]"
                                                                            value="{{ $death->death_date }}">

                                                                        <input type="hidden"
                                                                            id="death_primary_contact_number_{{ $death->id }}"
                                                                            name="death_primary_contact_number[]"
                                                                            value="{{ $death->primary_contact_number }}">
                                                                        <input type="hidden"
                                                                            id="death_secondary_contact_number_{{ $death->id }}"
                                                                            name="death_secondary_contact_number[]"
                                                                            value="{{ $death->secondary_contact_number }}">
                                                                        <input type="hidden"
                                                                            id="death_primary_e_mail_address_{{ $death->id }}"
                                                                            name="death_primary_e_mail_address[]"
                                                                            value="{{ $death->primary_e_mail_address }}">

                                                                        <input type="hidden" id="death_death_place"
                                                                            name="death_death_place"
                                                                            value="{{ $death->death_place }}">
                                                                        <input type="hidden" id="death_death_date"
                                                                            name="death_death_date"
                                                                            value="{{ $death->death_date }}">

                                                                        <!--END -- Hidden Inputs for death's Details -->

                                                                        <div class="row mb-4">
                                                                            <!--begin::Trigger button-->
                                                                            {{-- <button
                                                                                                id="kt_drawer_death_button_{{ $death->id }}"
                                                                                                class="btn btn-light-primary">See Original
                                                                                                Record</button> --}}
                                                                            <!--end::Trigger button-->
                                                                        </div>
                                                                        <!--begin::Drawer-->
                                                                        <div id="kt_drawer_death" class="bg-white"
                                                                            data-kt-drawer="true"
                                                                            data-kt-drawer-activate="true"
                                                                            data-kt-drawer-toggle="#kt_drawer_death_button_{{ $death->id }}"
                                                                            data-kt-drawer-close="#kt_drawer_death_close"
                                                                            data-kt-drawer-width="{default:'300px', 'md': '400px'}">

                                                                            <!--begin::Card-->
                                                                            <div class="card w-100 rounded-0">
                                                                                <!--begin::Card header-->
                                                                                <div class="card-header pe-5">
                                                                                    <!--begin::Title-->
                                                                                    <div class="card-title">
                                                                                        <!--begin::User-->
                                                                                        <div
                                                                                            class="d-flex justify-content-center flex-column me-3">
                                                                                            <a href="#"
                                                                                                class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 lh-1">Main
                                                                                                Membership Original
                                                                                                Details</a>
                                                                                        </div>
                                                                                        <!--end::User-->
                                                                                    </div>
                                                                                    <!--end::Title-->

                                                                                    <!--begin::Card toolbar-->
                                                                                    <div class="card-toolbar">
                                                                                        <!--begin::Close-->
                                                                                        <div class="btn btn-light-danger btn-sm btn-icon btn-active-danger"
                                                                                            id="kt_drawer_death_close">
                                                                                            <i
                                                                                                class="ki-duotone ki-cross fs-2"><span
                                                                                                    class="path1"></span><span
                                                                                                    class="path2"></span></i>
                                                                                        </div>
                                                                                        <!--end::Close-->
                                                                                    </div>
                                                                                    <!--end::Card toolbar-->
                                                                                </div>
                                                                                <!--end::Card header-->

                                                                                <!--begin::Card body-->
                                                                                <div
                                                                                    class="card-body hover-scroll-overlay-y">
                                                                                    @php
                                                                                        $originalRecord = json_decode(
                                                                                            $death->complete_original_record,
                                                                                            true,
                                                                                        );
                                                                                    @endphp
                                                                                    @if ($originalRecord)
                                                                                        @foreach ($originalRecord as $key => $value)
                                                                                            <div
                                                                                                class="d-flex align-items-center flex-wrap mb-2">
                                                                                                <div id="kt_clipboard_{{ $loop->index }}"
                                                                                                    class="me-5">
                                                                                                    <strong>{{ $key }}:</strong>
                                                                                                    <span
                                                                                                        class="copy-value">{{ $value }}</span>
                                                                                                </div>
                                                                                                @if (strlen($value) > 0)
                                                                                                    <button
                                                                                                        class="btn btn-icon btn-sm btn-light"
                                                                                                        data-clipboard-target="#kt_clipboard_{{ $loop->index }}">
                                                                                                        <i
                                                                                                            class="ki-duotone ki-copy fs-2 text-muted"></i>
                                                                                                    </button>
                                                                                                @endif
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @else
                                                                                        <p>No original record found.</p>
                                                                                    @endif
                                                                                </div>
                                                                                <!--end::Card body-->
                                                                            </div>
                                                                            <!--end::Card-->
                                                                        </div>
                                                                        <!--end::Drawer-->


                                                                        <div class="record-container">
                                                                            @if ($death->record_completed)
                                                                                <span style="color: green;">&#10004;</span>
                                                                            @endif
                                                                            <p>
                                                                                <span
                                                                                    id="record_status_{{ $death->id }}"></span>
                                                                                <b>Summary:</b>
                                                                            </p>
                                                                            <p>
                                                                                <b>Membership ID:</b> <span
                                                                                    id="summary_membership_id_{{ $death->id }}">{{ $death->membership_id ?? 'N/A' }}</span>,
                                                                                <b>First Name:</b> <span
                                                                                    id="summary_first_name_{{ $death->id }}">{{ $death->first_name ?? 'N/A' }}</span>,
                                                                                <b>Initials:</b> <span
                                                                                    id="summary_initials_{{ $death->id }}">{{ $death->initials ?? 'N/A' }}</span>,
                                                                                <b>Last Name:</b> <span
                                                                                    id="summary_last_name_{{ $death->id }}">{{ $death->last_name ?? 'N/A' }}</span>,
                                                                                <b>Screen Name:</b> <span
                                                                                    id="summary_screen_name_{{ $death->id }}">{{ $death->screen_name ?? 'N/A' }}</span>,
                                                                                <b>ID Number:</b> <span
                                                                                    id="summary_id_number_{{ $death->id }}">{{ $death->id_number ?? 'N/A' }}</span>,
                                                                                <b>Birth Date:</b> <span
                                                                                    id="summary_birth_date_{{ $death->id }}">{{ $death->birth_date ?? 'N/A' }}</span>,
                                                                                <b>Death Date:</b> <span
                                                                                    id="summary_death_date_{{ $death->id }}">{{ $death->death_date ?? 'N/A' }}</span>,
                                                                                <b>Relationship:</b> <span
                                                                                    id="summary_person_relationship_id_{{ $death->id }}">
                                                                                    {{ $relationshipNames[$relationshipMappings[$death->relationship_id] ?? $death->relationship_id] ?? 'N/A' }}
                                                                                </span>,

                                                                                <b>Gender:</b> <span
                                                                                    id="summary_gender_id_{{ $death->id }}">
                                                                                    {{ $genderNames[$death->gender_id] ?? 'N/A' }}
                                                                                </span>,

                                                                                <b>Join Date:</b> <span
                                                                                    id="summary_join_date_{{ $death->id }}">{{ $death->join_date ?? 'N/A' }}</span>,
                                                                                <b>Primary Contact Number:</b> <span
                                                                                    id="summary_primary_contact_number_{{ $death->id }}">{{ $death->primary_contact_number ?? 'N/A' }}</span>,
                                                                                <b>Secondary Contact Number:</b> <span
                                                                                    id="summary_secondary_contact_number_{{ $death->id }}">{{ $death->secondary_contact_number ?? 'N/A' }}</span>,<br>
                                                                                <b>Primary Email Address:</b> <span
                                                                                    id="summary_primary_e_mail_address_{{ $death->id }}">{{ $death->primary_e_mail_address ?? 'N/A' }}</span>
                                                                            </p>



                                                                        </div>
                                                                    @endforeach
                                                                </div>


                                                            </div>
                                                        @else
                                                            <div class="card inner-card border border-secondary mt-4">
                                                                <div class="card-header"style="background-color: #448C74;">
                                                                    <h3 class="card-title" style="color: white">Deaths
                                                                    </h3>
                                                                </div>
                                                                <div class="card-body bg-light">
                                                                    <p>No death records found.</p>
                                                                </div>
                                                            </div>
                                                        @endif





                                                        <!-- Deaths (Previous Main Person) Card -->
                                                        @if (!$item['previousdeaths']->isEmpty())
                                                            <div class="card inner-card my-8 bg-light">
                                                                <div class="card-header"
                                                                    style="background-color: #448C74;">
                                                                    <h3 class="card-title" style="color: white">Deaths
                                                                        (Previous
                                                                        Main Person)</h3>
                                                                </div>
                                                                {{-- START: possible previous main member death --}}
                                                                <div class="card-body">
                                                                    @foreach ($item['previousdeaths'] as $pmp_death)
                                                                        <!-- Hidden Inputs for pmp_death's Details -->

                                                                        <input type="hidden"
                                                                            id="pmp_death_record_id_{{ $pmp_death->id }}"
                                                                            name="pmp_death_record_id[]"
                                                                            value="{{ $pmp_death->id }}">

                                                                        <input type="hidden"
                                                                            id="pmp_death_original_json_{{ $pmp_death->id }}"
                                                                            name="pmp_death_original_json[]"
                                                                            value="{{ $pmp_death->complete_original_record }}">


                                                                        <input type="hidden"
                                                                            id="pmp_death_membership_id_{{ $pmp_death->id }}"
                                                                            name="pmp_death_membership_id[]"
                                                                            value="{{ $pmp_death->membership_id }}">
                                                                        <input type="hidden"
                                                                            id="pmp_death_first_name_{{ $pmp_death->id }}"
                                                                            name="pmp_death_first_name[]"
                                                                            value="{{ $pmp_death->first_name }}">
                                                                        <input type="hidden"
                                                                            id="pmp_death_initials_{{ $pmp_death->id }}"
                                                                            name="pmp_death_initials[]"
                                                                            value="{{ $pmp_death->initials }}">
                                                                        <input type="hidden"
                                                                            id="pmp_death_last_name_{{ $pmp_death->id }}"
                                                                            name="pmp_death_last_name[]"
                                                                            value="{{ $pmp_death->last_name }}">
                                                                        <input type="hidden"
                                                                            id="pmp_death_screen_name_{{ $pmp_death->id }}"
                                                                            name="pmp_death_screen_name[]"
                                                                            value="{{ $pmp_death->screen_name }}">
                                                                        <input type="hidden"
                                                                            id="pmp_death_id_number_{{ $pmp_death->id }}"
                                                                            name="pmp_death_id_number[]"
                                                                            value="{{ $pmp_death->id_number }}">
                                                                        <input type="hidden"
                                                                            id="pmp_death_birth_date_{{ $pmp_death->id }}"
                                                                            name="pmp_death_birth_date[]"
                                                                            value="{{ $pmp_death->birth_date }}">
                                                                        <input type="hidden"
                                                                            id="pmp_death_person_relationship_id_{{ $pmp_death->id }}"
                                                                            name="pmp_death_person_relationship_id[]"
                                                                            value="{{ $pmp_death->person_relationship_id }}">
                                                                        <input type="hidden"
                                                                            id="pmp_death_gender_id_{{ $pmp_death->id }}"
                                                                            name="pmp_death_gender_id[]"
                                                                            value="{{ $pmp_death->gender_id }}">
                                                                        <input type="hidden"
                                                                            id="pmp_death_join_date_{{ $pmp_death->id }}"
                                                                            name="pmp_death_join_date[]"
                                                                            value="{{ $pmp_death->join_date }}">

                                                                        <input type="hidden"
                                                                            id="pmp_death_deceased_date_{{ $pmp_death->id }}"
                                                                            name="pmp_death_deceased_date[]"
                                                                            value="{{ $pmp_death->death_date }}">

                                                                        <input type="hidden"
                                                                            id="pmp_death_primary_contact_number_{{ $pmp_death->id }}"
                                                                            name="pmp_death_primary_contact_number[]"
                                                                            value="{{ $pmp_death->primary_contact_number }}">
                                                                        <input type="hidden"
                                                                            id="pmp_death_secondary_contact_number_{{ $pmp_death->id }}"
                                                                            name="pmp_death_secondary_contact_number[]"
                                                                            value="{{ $pmp_death->secondary_contact_number }}">
                                                                        <input type="hidden"
                                                                            id="pmp_death_primary_e_mail_address_{{ $pmp_death->id }}"
                                                                            name="pmp_death_primary_e_mail_address[]"
                                                                            value="{{ $pmp_death->primary_e_mail_address }}">

                                                                        <!--END -- Hidden Inputs for pmp_death's Details -->
                                                                        @if (isset($pmb_death->id))
                                                                            <div class="row mb-4">
                                                                                <!--begin::Trigger button-->
                                                                                {{-- <button
                                                                                                id="kt_drawer_pmb_death_button_{{ $pmb_death->id }}"
                                                                                                class="btn btn-light-primary">See Original
                                                                                                Record</button> --}}
                                                                                <!--end::Trigger button-->
                                                                            </div>
                                                                            <!--begin::Drawer-->
                                                                            <div id="kt_drawer_pmb_death" class="bg-white"
                                                                                data-kt-drawer="true"
                                                                                data-kt-drawer-activate="true"
                                                                                data-kt-drawer-toggle="#kt_drawer_pmb_death_button_{{ $pmb_death->id }}"
                                                                                data-kt-drawer-close="#kt_drawer_pmb_death_close"
                                                                                data-kt-drawer-width="{default:'300px', 'md': '400px'}">

                                                                                <!--begin::Card-->
                                                                                <div class="card w-100 rounded-0">
                                                                                    <!--begin::Card header-->
                                                                                    <div class="card-header pe-5">
                                                                                        <!--begin::Title-->
                                                                                        <div class="card-title">
                                                                                            <!--begin::User-->
                                                                                            <div
                                                                                                class="d-flex justify-content-center flex-column me-3">
                                                                                                <a href="#"
                                                                                                    class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 lh-1">Main
                                                                                                    Membership Original
                                                                                                    Details</a>
                                                                                            </div>
                                                                                            <!--end::User-->
                                                                                        </div>
                                                                                        <!--end::Title-->

                                                                                        <!--begin::Card toolbar-->
                                                                                        <div class="card-toolbar">
                                                                                            <!--begin::Close-->
                                                                                            <div class="btn btn-light-danger btn-sm btn-icon btn-active-danger"
                                                                                                id="kt_drawer_pmb_death_close">
                                                                                                <i
                                                                                                    class="ki-duotone ki-cross fs-2"><span
                                                                                                        class="path1"></span><span
                                                                                                        class="path2"></span></i>
                                                                                            </div>
                                                                                            <!--end::Close-->
                                                                                        </div>
                                                                                        <!--end::Card toolbar-->
                                                                                    </div>
                                                                                    <!--end::Card header-->

                                                                                    <!--begin::Card body-->
                                                                                    <div
                                                                                        class="card-body hover-scroll-overlay-y">
                                                                                        @php
                                                                                            $originalRecord = json_decode(
                                                                                                $pmb_death->complete_original_record,
                                                                                                true,
                                                                                            );
                                                                                        @endphp
                                                                                        @if ($originalRecord)
                                                                                            @foreach ($originalRecord as $key => $value)
                                                                                                <div
                                                                                                    class="d-flex align-items-center flex-wrap mb-2">
                                                                                                    <div id="kt_clipboard_{{ $loop->index }}"
                                                                                                        class="me-5">
                                                                                                        <strong>{{ $key }}:</strong>
                                                                                                        <span
                                                                                                            class="copy-value">{{ $value }}</span>
                                                                                                    </div>
                                                                                                    @if (strlen($value) > 0)
                                                                                                        <button
                                                                                                            class="btn btn-icon btn-sm btn-light"
                                                                                                            data-clipboard-target="#kt_clipboard_{{ $loop->index }}">
                                                                                                            <i
                                                                                                                class="ki-duotone ki-copy fs-2 text-muted"></i>
                                                                                                        </button>
                                                                                                    @endif
                                                                                                </div>
                                                                                            @endforeach
                                                                                        @else
                                                                                            <p>No original record found.
                                                                                            </p>
                                                                                        @endif
                                                                                    </div>
                                                                                    <!--end::Card body-->
                                                                                </div>
                                                                                <!--end::Card-->
                                                                            </div>
                                                                            <!--end::Drawer-->
                                                                        @endif

                                                                        <div class="record-container">
                                                                            <p>
                                                                                <span
                                                                                    id="record_status_{{ $pmp_death->id }}"></span>
                                                                                <b>Summary:</b>
                                                                            </p>
                                                                            <p>
                                                                                <b>Membership ID:</b> <span
                                                                                    id="summary_membership_id_{{ $pmp_death->id }}">{{ $pmp_death->membership_id ?? 'N/A' }}</span>,
                                                                                <b>First Name:</b> <span
                                                                                    id="summary_first_name_{{ $pmp_death->id }}">{{ $pmp_death->first_name ?? 'N/A' }}</span>,
                                                                                <b>Initials:</b> <span
                                                                                    id="summary_initials_{{ $pmp_death->id }}">{{ $pmp_death->initials ?? 'N/A' }}</span>,
                                                                                <b>Last Name:</b> <span
                                                                                    id="summary_last_name_{{ $pmp_death->id }}">{{ $pmp_death->last_name ?? 'N/A' }}</span>,
                                                                                <b>Screen Name:</b> <span
                                                                                    id="summary_screen_name_{{ $pmp_death->id }}">{{ $pmp_death->screen_name ?? 'N/A' }}</span>,
                                                                                <b>ID Number:</b> <span
                                                                                    id="summary_id_number_{{ $pmp_death->id }}">{{ $pmp_death->id_number ?? 'N/A' }}</span>,
                                                                                <b>Birth Date:</b> <span
                                                                                    id="summary_birth_date_{{ $pmp_death->id }}">{{ $pmp_death->birth_date ?? 'N/A' }}</span>,
                                                                                <b>Death Date:</b> <span
                                                                                    id="summary_birth_date_{{ $pmp_death->id }}">{{ $pmp_death->death_date ?? 'N/A' }}</span>,
                                                                                <b>Relationship ID:</b> <span
                                                                                    id="summary_person_relationship_id_{{ $pmp_death->id }}">
                                                                                    {{ $relationshipNames[
                                                                                        $relationshipMappings[$pmp_death->person_relationship_id] ?? $pmp_death->person_relationship_id
                                                                                    ] ?? 'N/A' }}
                                                                                </span>,

                                                                                <b>Gender ID:</b> <span
                                                                                    id="summary_gender_id_{{ $pmp_death->id }}">{{ $pmp_death->gender_id ?? 'N/A' }}</span>,
                                                                                <b>Join Date:</b> <span
                                                                                    id="summary_join_date_{{ $pmp_death->id }}">{{ $pmp_death->join_date ?? 'N/A' }}</span>,
                                                                                <b>Primary Contact Number:</b> <span
                                                                                    id="summary_primary_contact_number_{{ $pmp_death->id }}">{{ $pmp_death->primary_contact_number ?? 'N/A' }}</span>,
                                                                                <b>Secondary Contact Number:</b> <span
                                                                                    id="summary_secondary_contact_number_{{ $pmp_death->id }}">{{ $pmp_death->secondary_contact_number ?? 'N/A' }}</span>,<br>
                                                                                <b>Primary Email Address:</b> <span
                                                                                    id="summary_primary_e_mail_address_{{ $pmp_death->id }}">{{ $pmp_death->primary_e_mail_address ?? 'N/A' }}</span>
                                                                            </p>




                                                                            <!-- Edit pmp_death Details Modal -->
                                                                            {{-- <div class="modal fade" id="editpmp_deathModal" tabindex="-1" role="dialog"
                                                                                                    aria-labelledby="editpmp_deathModalLabel" aria-hidden="true">
                                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                                        <div class="modal-content">
                                                                                                            <div class="modal-header">
                                                                                                                <h5 class="modal-title" id="editpmp_deathModalLabel">Edit
                                                                                                                    pmp_death Details</h5>
                                                                                                                <button type="button" class="close" data-dismiss="modal"
                                                                                                                    aria-label="Close">
                                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                                </button>
                                                                                                            </div>
                                                                                                            <div class="modal-body">
                                                                                                                <!-- Modal Input Fields -->
                                                                                                                <div class="form-group">
                                                                                                                    <label for="modal_membership_id">Membership ID</label>
                                                                                                                    <input type="text" class="form-control"
                                                                                                                        id="modal_membership_id">
                                                                                                                </div>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_first_name">First
                                                                                                                                Name</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_first_name">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_initials">Initials</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_initials">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_last_name">Last Name</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_last_name">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_screen_name">Screen
                                                                                                                                Name</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_screen_name">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_id_number">ID Number</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_id_number">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_birth_date">Birth
                                                                                                                                Date</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_birth_date">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_person_relationship_id">Relationship
                                                                                                                                ID</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_person_relationship_id">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_gender_id">Gender ID</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_gender_id">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_join_date">Join Date</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_join_date">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_primary_contact_number">Primary
                                                                                                                                Contact Number</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_primary_contact_number">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_secondary_contact_number">Secondary
                                                                                                                                Contact Number</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_secondary_contact_number">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-3">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="modal_primary_e_mail_address">Primary
                                                                                                                                Email Address</label>
                                                                                                                            <input type="text" class="form-control"
                                                                                                                                id="modal_primary_e_mail_address">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="modal-footer">
                                                                                                                <button type="button" class="btn btn-secondary"
                                                                                                                    data-dismiss="modal">Close</button>
                                                                                                                <button type="button" class="btn btn-primary"
                                                                                                                    onclick="updatepmp_death()">Save Changes</button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> --}}


                                                                            <!-- Action Buttons -->
                                                                            {{-- <div class="action-buttons">
                                                                                                    <button type="button" class="btn btn-primary btn-sm"
                                                                                                        onclick="editpmp_death('{{ $pmp_death->id }}')">Edit</button>

                                                                                                    @if (!$pmp_death->record_completed)
                                                                                                        <button id="btnMarkAsComplete" type="button"
                                                                                                            class="btn btn-success btn-sm mark-as-complete-btn"
                                                                                                            id="mark_complete_btn_{{ $pmp_death->id }}"
                                                                                                            onclick="markAsComplete('{{ $pmp_death->id }}')">Mark as
                                                                                                            Complete</button>
                                                                                                    @endif
                                                                                                    <button id="removeButton" type="button" class="btn btn-danger btn-sm"
                                                                                                        onclick="removepmp_death('{{ $pmp_death->id }}')">Remove</button>
                                                                                                </div> --}}
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                {{-- END: possible previous main member death --}}

                                                            </div>
                                                        @else
                                                            <div class="card inner-card border border-secondary mt-4">
                                                                <div class="card-header"style="background-color: #448C74;">
                                                                    <h3 class="card-title" style="color: white">Deaths
                                                                        (Previous
                                                                        Main Person)</h3>
                                                                </div>
                                                                <div class="card-body bg-light">
                                                                    <p>No Previous Main Person Death records found.</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>

                                            </div>
                                        </div>
                                    </div>


                                    <!-- Fifth accordion for Dependents -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="kt_accordion_{{ $loop->index }}_header_5">
                                            <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#kt_accordion_{{ $loop->index }}_body_5"
                                                aria-expanded="false"
                                                aria-controls="kt_accordion_{{ $loop->index }}_body_5">
                                                Dependents
                                            </button>
                                        </h2>
                                        <div id="kt_accordion_{{ $loop->index }}_body_5"
                                            class="accordion-collapse collapse p-0 m-0"
                                            aria-labelledby="kt_accordion_{{ $loop->index }}_header_5"
                                            data-bs-parent="#kt_accordion_{{ $loop->index }}">
                                            <div class="accordion-body">
                                                <!-- Accordion content for Dependents -->


                                                <div class="">



                                                    <!-- Dependents Card -->
                                                    @if (!$item['dependents']->isEmpty())
                                                        @foreach ($item['dependents'] as $dependent)
                                                            <div class="card inner-card  bg-light">

                                                                <div class="card-body">

                                                                    <input type="hidden"
                                                                        id="dependent_record_id_{{ $dependent->id }}"
                                                                        name="dependent_record_id[]"
                                                                        value="{{ $dependent->id }}">

                                                                    <input type="hidden"
                                                                        id="dependent_original_json_{{ $dependent->id }}"
                                                                        name="dependent_original_json[]"
                                                                        value="{{ $dependent->complete_original_record }}">

                                                                    <div class="row mb-4">
                                                                        <!--begin::Trigger button-->
                                                                        {{-- <button
                                                                                            id="kt_drawer_dependent_button_{{ $dependent->id }}"
                                                                                            class="btn btn-light-primary">See Original
                                                                                            Record</button> --}}
                                                                        <!--end::Trigger button-->
                                                                    </div>
                                                                    <!--begin::Drawer-->
                                                                    <div id="kt_drawer_dependent" class="bg-white"
                                                                        data-kt-drawer="true"
                                                                        data-kt-drawer-activate="true"
                                                                        data-kt-drawer-toggle="#kt_drawer_dependent_button_{{ $dependent->id }}"
                                                                        data-kt-drawer-close="#kt_drawer_dependent_close"
                                                                        data-kt-drawer-width="{default:'300px', 'md': '400px'}">

                                                                        <!--begin::Card-->
                                                                        <div class="card w-100 rounded-0">
                                                                            <!--begin::Card header-->
                                                                            <div class="card-header pe-5">
                                                                                <!--begin::Title-->
                                                                                <div class="card-title">
                                                                                    <!--begin::User-->
                                                                                    <div
                                                                                        class="d-flex justify-content-center flex-column me-3">
                                                                                        <a href="#"
                                                                                            class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 lh-1">Main
                                                                                            Membership Original
                                                                                            Details</a>
                                                                                    </div>
                                                                                    <!--end::User-->
                                                                                </div>
                                                                                <!--end::Title-->

                                                                                <!--begin::Card toolbar-->
                                                                                <div class="card-toolbar">
                                                                                    <!--begin::Close-->
                                                                                    <div class="btn btn-light-danger btn-sm btn-icon btn-active-danger"
                                                                                        id="kt_drawer_dependent_close">
                                                                                        <i
                                                                                            class="ki-duotone ki-cross fs-2"><span
                                                                                                class="path1"></span><span
                                                                                                class="path2"></span></i>
                                                                                    </div>
                                                                                    <!--end::Close-->
                                                                                </div>
                                                                                <!--end::Card toolbar-->
                                                                            </div>
                                                                            <!--end::Card header-->

                                                                            <!--begin::Card body-->
                                                                            <div class="card-body hover-scroll-overlay-y">
                                                                                @php
                                                                                    $originalRecord = json_decode(
                                                                                        $dependent->complete_original_record,
                                                                                        true,
                                                                                    );
                                                                                @endphp
                                                                                @if ($originalRecord)
                                                                                    @foreach ($originalRecord as $key => $value)
                                                                                        <div
                                                                                            class="d-flex align-items-center flex-wrap mb-2">
                                                                                            <div id="kt_clipboard_{{ $loop->index }}"
                                                                                                class="me-5">
                                                                                                <strong>{{ $key }}:</strong>
                                                                                                <span
                                                                                                    class="copy-value">{{ $value }}</span>
                                                                                            </div>
                                                                                            @if (strlen($value) > 0)
                                                                                                <button
                                                                                                    class="btn btn-icon btn-sm btn-light"
                                                                                                    data-clipboard-target="#kt_clipboard_{{ $loop->index }}">
                                                                                                    <i
                                                                                                        class="ki-duotone ki-copy fs-2 text-muted"></i>
                                                                                                </button>
                                                                                            @endif
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <p>No original record found.</p>
                                                                                @endif
                                                                            </div>
                                                                            <!--end::Card body-->
                                                                        </div>
                                                                        <!--end::Card-->
                                                                    </div>
                                                                    <!--end::Drawer-->

                                                                    <div class="record-container">
                                                                        @if ($dependent->record_completed)
                                                                            <span style="color: green;">&#10004;</span>
                                                                        @endif
                                                                        <div class="form-row">
                                                                            <!-- Membership ID -->
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="membership_id_{{ $dependent->id }}">Membership
                                                                                        ID</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="membership_id_{{ $dependent->id }}"
                                                                                        name="dependent_membership_id[]"
                                                                                        value="{{ $dependent->membership_id }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <!-- First Name -->
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="first_name_{{ $dependent->id }}">First
                                                                                        Name</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="first_name_{{ $dependent->id }}"
                                                                                        name="dependent_first_name[]"
                                                                                        value="{{ $dependent->first_name }}">
                                                                                </div>
                                                                            </div>
                                                                            <!-- Initials -->
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="initials_{{ $dependent->id }}">Initials</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="initials_{{ $dependent->id }}"
                                                                                        name="dependent_initials[]"
                                                                                        value="{{ $dependent->initials }}">
                                                                                </div>
                                                                            </div>
                                                                            <!-- Last Name -->
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="last_name_{{ $dependent->id }}">Last
                                                                                        Name</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="last_name_{{ $dependent->id }}"
                                                                                        name="dependent_last_name[]"
                                                                                        value="{{ $dependent->last_name }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <!-- Screen Name -->
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="screen_name_{{ $dependent->id }}">Screen
                                                                                        Name</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="screen_name_{{ $dependent->id }}"
                                                                                        name="dependent_screen_name[]"
                                                                                        value="{{ $dependent->screen_name }}">
                                                                                </div>
                                                                            </div>
                                                                            <!-- ID Number -->
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="id_number_{{ $dependent->id }}">ID
                                                                                        Number</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="id_number_{{ $dependent->id }}"
                                                                                        name="dependent_id_number[]"
                                                                                        value="{{ $dependent->id_number }}">
                                                                                </div>
                                                                            </div>
                                                                            <!-- Birth Date -->
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="birth_date_{{ $dependent->id }}">Birth
                                                                                        Date</label>
                                                                                    <input type="date"
                                                                                        class="form-control"
                                                                                        id="birth_date_{{ $dependent->id }}"
                                                                                        name="dependent_birth_date[]"
                                                                                        value="{{ $dependent->birth_date }}">
                                                                                </div>
                                                                            </div>
                                                                            <!-- Relationship ID -->
                                                                            <div class="col-md-3">



                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="person_relationship_id_{{ $dependent->id }}">Relationship
                                                                                        to Main Member</label>
                                                                                    <select class="form-control"
                                                                                        id="person_relationship_id_{{ $dependent->id }}"
                                                                                        name="dependent_person_relationship_id[]"
                                                                                        style="height: 50%" required>
                                                                                        <!-- Placeholder option indicates that selection is required -->
                                                                                        <option value="" disabled
                                                                                            selected
                                                                                            {{ is_null($dependent->relationship_id) ||
                                                                                            !$relationships->contains('id', $dependent->relationship_id) ||
                                                                                            !in_array($dependent->relationship_id, $remappedIds)
                                                                                                ? 'selected'
                                                                                                : '' }}>
                                                                                            Select relationship
                                                                                        </option>

                                                                                        @foreach ($relationships as $relationship)
                                                                                            <option
                                                                                                value="{{ $relationship->id }}"
                                                                                                {{ (isset($relationshipMappings[$dependent->relationship_id]) &&
                                                                                                    $relationship->id == $relationshipMappings[$dependent->relationship_id]) ||
                                                                                                (!isset($relationshipMappings[$dependent->relationship_id]) && $relationship->id == $dependent->relationship_id)
                                                                                                    ? 'selected'
                                                                                                    : '' }}>
                                                                                                {{ $relationship->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>





                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <!-- Gender ID -->
                                                                            <div class="col-md-3">

                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="gender_id_{{ $dependent->id }}">Gender</label>
                                                                                    <select class="form-control"
                                                                                        id="gender_id_{{ $dependent->id }}"
                                                                                        name="dependent_gender_id[]"
                                                                                        style="height: 1%">
                                                                                        <!-- Placeholder option -->
                                                                                        <option value="" disabled
                                                                                            {{ is_null($dependent->gender_id) ? 'selected' : '' }}>
                                                                                            Select gender</option>

                                                                                        @foreach ($genders as $gender)
                                                                                            <option
                                                                                                value="{{ $gender->id }}"
                                                                                                {{ $dependent->gender_id == $gender->id ? 'selected' : '' }}>
                                                                                                {{ $gender->name }}
                                                                                            </option>
                                                                                        @endforeach

                                                                                    </select>
                                                                                </div>


                                                                            </div>
                                                                            <!-- Join Date -->
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="join_date_{{ $dependent->id }}">Join
                                                                                        Date</label>
                                                                                    <input type="date"
                                                                                        class="form-control"
                                                                                        id="join_date_{{ $dependent->id }}"
                                                                                        name="dependent_join_date[]"
                                                                                        value="{{ $dependent->join_date }}">
                                                                                </div>
                                                                            </div>
                                                                            <!-- Primary Contact Number -->
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="primary_contact_number_{{ $dependent->id }}">Primary
                                                                                        Contact Number</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="primary_contact_number_{{ $dependent->id }}"
                                                                                        name="dependent_primary_contact_number[]"
                                                                                        value="{{ $dependent->primary_contact_number }}">
                                                                                </div>
                                                                            </div>
                                                                            <!-- Secondary Contact Number -->
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="secondary_contact_number_{{ $dependent->id }}">Secondary
                                                                                        Contact Number</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="secondary_contact_number_{{ $dependent->id }}"
                                                                                        name="dependent_secondary_contact_number[]"
                                                                                        value="{{ $dependent->secondary_contact_number }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <!-- Primary Email Address -->
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="primary_e_mail_address_{{ $dependent->id }}">Primary
                                                                                        Email Address</label>
                                                                                    <input type="email"
                                                                                        class="form-control"
                                                                                        id="primary_e_mail_address_{{ $dependent->id }}"
                                                                                        name="dependent_primary_e_mail_address[]"
                                                                                        value="{{ $dependent->primary_e_mail_address }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Action Buttons -->
                                                                        <div class="action-buttons">
                                                                            {{-- <button type="button" class="btn btn-primary btn-sm"
                                                                                                                                onclick="updateDependent('{{ $dependent->id }}')">Save Changes</button> --}}
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm"
                                                                                onclick="removeDependent('{{ $dependent->id }}')">Remove</button>
                                                                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                                                                                                                                Launch remove reason modal
                                                                                                                            </button> --}}
                                                                        </div>
                                                                    </div>



                                                                    <div class="modal fade" tabindex="-1"
                                                                        id="kt_modal_1">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h3 class="modal-title">Modal title
                                                                                    </h3>

                                                                                    <!--begin::Close-->
                                                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <i
                                                                                            class="ki-duotone ki-cross fs-1"><span
                                                                                                class="path1"></span><span
                                                                                                class="path2"></span></i>
                                                                                    </div>
                                                                                    <!--end::Close-->
                                                                                </div>

                                                                                <div class="modal-body">
                                                                                    <div
                                                                                        class="form-check form-check-custom form-check-success form-check-solid">
                                                                                        <input class="form-check-input"
                                                                                            type="radio" value=""
                                                                                            checked id="flexCheckboxLg" />
                                                                                        <label class="form-check-label"
                                                                                            for="flexCheckboxLg">
                                                                                            Success
                                                                                        </label>
                                                                                    </div>

                                                                                    <div
                                                                                        class="form-check form-check-custom form-check-danger form-check-solid">
                                                                                        <input class="form-check-input"
                                                                                            type="radio" value=""
                                                                                            checked id="flexCheckboxSm" />
                                                                                        <label class="form-check-label"
                                                                                            for="flexCheckboxSm">
                                                                                            Danger
                                                                                        </label>
                                                                                    </div>

                                                                                    <div
                                                                                        class="form-check form-check-custom form-check-warning form-check-solid">
                                                                                        <input class="form-check-input"
                                                                                            type="radio" value=""
                                                                                            checked id="flexRadioLg" />
                                                                                        <label class="form-check-label"
                                                                                            for="flexRadioLg">
                                                                                            Warning
                                                                                        </label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-light"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                    <button type="button"
                                                                                        class="btn btn-primary">Save
                                                                                        changes</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="card inner-card border border-secondary mt-4">
                                                            <div class="card-header"style="background-color: #448C74;">
                                                                <h3 class="card-title" style="color: white">Dependents
                                                                </h3>
                                                            </div>
                                                            <div class="card-body bg-light">
                                                                <p>No dependent records found.</p>
                                                            </div>
                                                        </div>
                                                    @endif


                                                </div>




                                            </div>
                                        </div>
                                    </div>
                                    <!--END: Fifth accordion for Dependents -->
                                </div>
                                <!--end::Accordion-->






                            </div>
                            <!-- Add more accordion cards as needed following the structure above -->
                        </div>

                        <!-- Hidden Button for Submit Action 1 -->
                        <button type="submit" name="action" value="submitActionOne" style="display:none;">Save
                            Membership</button>
                        <!-- Hidden Button for Submit Action 2 -->
                        <button type="submit" name="action" value="submitActionTwo" style="display:none;">Test
                            Output</button>
                    </form>

                    <!--begin::Alert (initially hidden)-->
                    <div id="requiredAlert"
                        class="alert alert-danger bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10"
                        style="display: none !important;">
                        <!--begin::Icon-->
                        <i class="ki-duotone ki-information-5 fs-2hx text-danger me-4 mb-5 mb-sm-0"><span
                                class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <!--begin::Title-->
                            <h4 class="fw-semibold  text-danger">Incomplete Form</h4>
                            <!--end::Title-->

                            <!--begin::Content-->
                            <span>All Tabs Need to be completed ('Green') before you can save.</span>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->

                    </div>
                    <!--end::Alert-->

                    <!-- Duplicate Records Card -->
                    @if (!$item['duplicates']->isEmpty())
                        <div class="card inner-card bg-light mt-8">
                            <div class="card-header" style="background-color: #448C74;">
                                <h3 class="card-title" style="color: white">Duplicate Records</h3>
                            </div>
                            <div class="card-body">
                                @foreach ($item['duplicates'] as $index => $duplicate)
                                    <div class="record-container">
                                        @php
                                            // Decode the JSON into an array
                                            $details = json_decode($duplicate->duplicate_details, true);
                                            $summary = [];

                                            foreach ($details as $key => $value) {
                                                // Make key bold and concatenate with value
                                                // Ensure HTML special characters are escaped appropriately
                                                $summary[] = '<strong>' . e($key) . '</strong>: ' . e($value);
                                            }

                                            // Join all parts into one string
                                            $summaryString = implode(', ', $summary);

                                            // Optionally, limit the total length of the summary string
                                            // if (strlen($summaryString) > 100) { // Example limit
                                            //     $summaryString = substr($summaryString, 0, 100) . '...';
                                            // }

                                        @endphp


                                        <p>Duplicate Details: {!! $summaryString !!}</p>
                                        <div class="action-buttons pb-4">
                                            <!-- Trigger Modal Button -->
                                            <button type="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                                data-target="#duplicateModal{{ $index }}">
                                                View Details
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                data-source-table="{{ $duplicate->target_table_name }}"
                                                data-record-id="{{ $duplicate->id }}"
                                                data-membership-id="{{ $duplicate->membership_id }}"
                                                onclick="handleRecordAction(this, 'discardDuplicate')">Remove</button>
                                        </div>
                                    </div>

                                    <!-- Modal Structure -->
                                    <div class="modal fade" id="duplicateModal{{ $index }}" tabindex="-1"
                                        role="dialog" aria-labelledby="duplicateModalLabel{{ $index }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #448C74;">
                                                    <h5 class="modal-title" style="color: white;">Duplicate Record
                                                        Details
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true" style="color: white;">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="background-color: #E9F0EC;">
                                                    @php
                                                        $duplicateDetails = json_decode(
                                                            $duplicate->duplicate_details,
                                                            true,
                                                        );
                                                    @endphp

                                                    @if ($duplicateDetails)
                                                        @foreach ($duplicateDetails as $key => $value)
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-2">
                                                                <span
                                                                    class="mr-2"><strong>{{ $key }}:</strong></span>
                                                                <input type="text" style="background-color: #ffffff;"
                                                                    id="copy_{{ $duplicate->id }}_{{ $loop->index }}"
                                                                    value="{{ $value }}" readonly
                                                                    class="form-control d-inline-block"
                                                                    style="width: auto; background-color: #adc2b4 !important; border-color: #849e8d; color: #495057;"
                                                                    onclick="this.select(); ">
                                                                <button class="btn btn-light btn-sm ml-2 copy-btn"
                                                                    onclick="copyToClipboard('copy_{{ $duplicate->id }}_{{ $loop->index }}')"><i
                                                                        class="fas fa-copy"></i></button>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <p>No details available.</p>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        {{-- <div class="card inner-card border border-secondary" >
                                                            <div class="card-header" style="background-color: #448C74;">
                                                                <h3 class="card-title" style="color: white">Duplicate Records</h3>
                                                            </div>
                                                            <div class="card-body bg-light ">
                                                                <p>No duplicate records found.</p>
                                                            </div>
                                                        </div> --}}
                    @endif

                    <!-- Error Records Card -->
                    @if (!$item['errors']->isEmpty())
                        <div class="card inner-card bg-light">
                            <div class="card-header" style="background-color: #448C74;">
                                <h3 class="card-title" style="color: white">Potential Dependents</h3>
                            </div>
                            <div class="card-body">
                                {{-- Default by Mnguni --}}
                                @foreach ($item['errors'] as $error)
                                    <div class="record-container">
                                        @php
                                            $details = json_decode($error->source_details, true);
                                            $summary = [];

                                            if ($details) {
                                                foreach ($details as $key => $value) {
                                                    // Make key bold and concatenate with value, ensuring HTML special characters are escaped
                                                    $summary[] = '<strong>' . e($key) . '</strong>: ' . e($value);
                                                }

                                                // Join all parts into one string
                                                $summaryString = implode(', ', $summary);
                                            } else {
                                                $summaryString = 'N/A';
                                            }
                                        @endphp
                                        <p>Source Details: {!! $summaryString !!}</p>
                                        <!-- Hidden inputs generated from source_details -->
                                        @if ($error->source_details)
                                            @php
                                                $details = json_decode($error->source_details, true);
                                            @endphp
                                            @foreach ($details as $key => $value)
                                                <input type="hidden" id="{{ 'error_' . $error->id . '_' . $key }}"
                                                    name="{{ 'error_' . $error->id . '_' . $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                        @endif

                                        <div class="action-buttons">
                                            <button id="makeDependantBtn" type="button"
                                                class="btn btn-sm btn-success"
                                                data-source-table="{{ $error->target_table_name }}"
                                                data-record-id="{{ $error->id }}"
                                                data-membership-id="{{ $error->membership_id }}"
                                                onclick="handleRecordAction(this, 'makeDependentError')">
                                                Make Dependant
                                            </button>

                                            <button id="makeDependantBtn" type="button"
                                                class="btn btn-sm btn-warning"
                                                data-source-table="{{ $error->target_table_name }}"
                                                data-record-id="{{ $error->id }}"
                                                data-membership-id="{{ $error->membership_id }}"
                                                onclick="handleRecordAction(this, 'makeDeceasedError')">

                                                Mark As Deceased
                                            </button>

                                            <button id="removeDependantBtn" type="button"
                                                class="btn btn-sm btn-danger"
                                                data-source-table="{{ $error->target_table_name }}"
                                                data-record-id="{{ $error->id }}"
                                                data-membership-id="{{ $error->membership_id }}"
                                                onclick="handleRecordAction(this, 'discardError')">

                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- Default by Mnguni --}}

                                {{-- 29/02/2024 Interface --}}
                                {{-- @foreach ($item['errors'] as $error)
                                                                    <div class="record-container">
                                                                        @if ($error->source_details)
                                                                            @php
                                                                                $details = json_decode($error->source_details, true);
                                                                            @endphp
                                                                            <div>
                                                                                <ul>
                                                                                    <li>
                                                                                        <p>Membership {{ $details['membership_id'] ?? 'N/A' }} from
                                                                                            {{ $details['initials'] ?? 'N/A' }},
                                                                                            {{ $details['last_name'] ?? 'N/A' }}
                                                                                            <a href="javascript:void(0);" class="special-link"
                                                                                                onclick="toggleDetails('#details{{ $error->id }}')">Raw
                                                                                                Details</a>
                                                                                        </p>
                                                                                    </li>
                                                                                </ul>

                                                                                <div class="details" id="details{{ $error->id }}"
                                                                                    style="display:none;">
                                                                                    <div class="card card-body" style="background-color: gray;">
                                                                                        <pre>{{ json_encode($details, JSON_PRETTY_PRINT) }}</pre>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <p>Source Details: N/A</p>
                                                                        @endif

                                                                        <div class="action-buttons">
                                                                            <button type="button" class="btn btn-sm btn-success"
                                                                                data-source-table="{{ $error->target_table_name }}"
                                                                                data-record-id="{{ $error->id }}"
                                                                                data-membership-id="{{ $error->membership_id }}"
                                                                                onclick="handleRecordAction(this, 'makeDependentError')">Make
                                                                                Dependant</button>

                                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                                data-source-table="{{ $error->target_table_name }}"
                                                                                data-record-id="{{ $error->id }}"
                                                                                data-membership-id="{{ $error->membership_id }}"
                                                                                onclick="handleRecordAction(this, 'discardError')">Remove</button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach --}}

                            </div>
                        </div>
                    @else
                        {{-- <div class="card inner-card border border-secondary">
                                                            <div class="card-header" style="background-color: #448C74;">
                                                                <h3 class="card-title" style="color: white">Potential Dependents Records</h3>
                                                            </div>
                                                            <div class="card-body bg-light">
                                                                <p>No error records found.</p>
                                                            </div>
                                                        </div> --}}
                    @endif

                    <div class="card-footer p-0">
                        {{-- Action Buttons for Main Record --}}
                        <div class="text-center mt-4">
                            <!-- External Button for Submit Action 1 -->
                            <button id="externalSubmitActionOne" class="btn btn-success mx-2">Save Membership</button>
                            <!-- External Button for Submit Action 2 -->
                            <button id="externalSubmitActionTwo" class="btn btn-secondary mx-2">Test Output</button>


                            {{-- <!-- JavaScript actions -->
                                                                                <button type="button" class="btn btn-info" onclick="otherActionOne()">Other Action 1 (JS)</button>
                                                                                <button type="button" class="btn btn-warning" onclick="otherActionTwo()">Other Action 2 (JS)</button>
                                                        --}}
                        </div>



                        <!-- Custom Bootstrap Pagination Links -->
                        <nav aria-label="Page navigation example" class="my-3">
                            <ul class="pagination justify-content-center">
                                @if ($paginatedItems->onFirstPage())
                                    <li class="page-item disabled"><span
                                            class="page-link border border-secondary">Previous</span></li>
                                @else
                                    <li class="page-item"><a class="page-link border border-secondary"
                                            href="{{ $paginatedItems->previousPageUrl() }}">Previous</a></li>
                                @endif

                                <!-- Display current page of total pages (e.g., "1 of 52025") -->
                                <li class="page-item disabled"><span
                                        class="page-link bg-light border border-secondary">{{ $paginatedItems->currentPage() }}
                                        of
                                        {{ $paginatedItems->lastPage() }}</span></li>

                                @if ($paginatedItems->hasMorePages())
                                    <li class="page-item"><a class="page-link border border-secondary"
                                            href="{{ $paginatedItems->nextPageUrl() }}">Next</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span
                                            class="page-link border border-secondary">Next</span></li>
                                @endif
                            </ul>
                        </nav>
                    </div>




                    </form>
                @endforeach
            @else
                <p>No records found.</p>
            @endif
            </div>

        </div>
        {{-- </div> --}}
    </div>

    <div class="accordion col-3 card-coloumn rounded bg-body drawer-column position-relative mb-10 shadow overflow-y-auto"
        id="kt_drawer_death" style="height: auto !important; max-height: 1150px;">

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Close-->
            {{-- <div class="btn btn-light-danger btn-sm btn-icon btn-active-danger position-absolute top-0 end-0" id="hide-button">
                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
            </div> --}}
            <!--end::Close-->
            {{-- <div class="accordion mx-0 px-0" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    Main Membership Original Details
                </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    Dependants Details
                </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
                </div>
            </div>

            </div> --}}
            <div class="btn-sm bg-danger m-4 text-center rounded p-3 text-white fs-4" id="hide-button">
                Close Details
            </div>




            <div class="accordion-item">

                {{-- <div class="accordion mx-0 px-0" id="accordionPanelsStayOpen"> --}}
                @if ($paginatedItems->count() > 0)
                    @foreach ($paginatedItems as $item)
                        <!--begin::Accordion-->

                        <div id="kt_accordion_{{ $loop->index }}">
                            <!-- First Accordion Item for Membership Details -->
                            {{-- <h3 class="card-title">Main Record ID: {{ $item['membershipId'] }}</h3> --}}

                            <h2 class="accordion-header" id="kt_accordion_{{ $loop->index }}_header_side1">
                                <button class="accordion-button fs-4 fw-semibold{{ $loop->first ? '' : ' collapsed' }}"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#kt_accordion_{{ $loop->index }}_body_side1"
                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                    aria-controls="kt_accordion_{{ $loop->index }}_body_side1">
                                    Membership Details
                                </button>

                            </h2>
                            <div id="kt_accordion_{{ $loop->index }}_body_side1"
                                class="accordion-collapse collapse{{ $loop->first ? ' show' : '' }}"
                                aria-labelledby="kt_accordion_{{ $loop->index }}_header_side1"
                                data-bs-parent="#kt_accordion_{{ $loop->index }}">
                                <div class="accordion-body">
                                    <!-- Accordion content for Membership Details -->
                                    <!-- Main Record Card as Form -->
                                    @if ($item['main'])
                                        <input type="hidden" id="main_original_json_{{ $item['main']->id }}"
                                            name="main_original_json_{{ $item['main']->id }}"
                                            value="{{ $item['main']->complete_original_record }}">


                                        <!--begin::Card body-->
                                        <div class="card-body hover-scroll-overlay-y">
                                            @php
                                                $originalRecord = json_decode(
                                                    $item['main']->complete_original_record,
                                                    true,
                                                );
                                            @endphp
                                            @if ($originalRecord)
                                                @foreach ($originalRecord as $key => $value)
                                                    <div class="d-flex align-items-center flex-wrap mb-2">
                                                        <div id="kt_clipboard_{{ $loop->index }}" class="me-5">
                                                            <strong>{{ $key }}:</strong> <span
                                                                class="copy-value">{{ $value }}</span>
                                                        </div>
                                                        @if (strlen($value) > 0)
                                                            <button class="btn btn-icon btn-sm btn-light"
                                                                data-clipboard-target="#kt_clipboard_{{ $loop->index }}">
                                                                <i class="ki-duotone ki-copy fs-2 text-muted"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>No original record found.</p>
                                            @endif
                                        </div>
                                        <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            @else
                                <div class="card-header">Duplicate Records</div>
                                <div class="card-body">
                                    <p>No main records found for this Membership ID.</p>
                                </div>
                    @endif
            </div>


            <!-- Fifth accordion for Dependents -->
            {{-- <h2 class="accordion-header p-4" id="kt_accordion_{{ $loop->index }}_header_5"> --}}
                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_accordion_{{ $loop->index }}_body_5" aria-expanded="false"
                    aria-controls="kt_accordion_{{ $loop->index }}_body_5" id="kt_accordion_{{ $loop->index }}_header_5">
                    {{-- Dependentss Details --}}
                    Dependants Details
                </button>
            {{-- </h2> --}}
            <div id="kt_accordion_{{ $loop->index }}_body_5" class="accordion-collapse collapse"
                aria-labelledby="kt_accordion_{{ $loop->index }}_header_5"
                data-bs-parent="#kt_accordion_{{ $loop->index }}">
                <div class="accordion-body">
                    <!-- Accordion content for Dependents -->


                    <!-- Dependents Card -->
                    @if (!$item['dependents']->isEmpty())
                        @foreach ($item['dependents'] as $dependent)
                            <input type="hidden" id="dependent_record_id_{{ $dependent->id }}"
                                name="dependent_record_id[]" value="{{ $dependent->id }}">

                            <input type="hidden" id="dependent_original_json_{{ $dependent->id }}"
                                name="dependent_original_json[]" value="{{ $dependent->complete_original_record }}">

                            <!--begin::Card-->
                            <div class="w-100 rounded-0">

                                <!--begin::Card body-->
                                <div class="hover-scroll-overlay-y">
                                    @php
                                        $originalRecord = json_decode($dependent->complete_original_record, true);
                                    @endphp
                                    @if ($originalRecord)
                                        @foreach ($originalRecord as $key => $value)
                                            <div class="d-flex align-items-center flex-wrap mb-2">
                                                <div id="kt_clipboard_{{ $loop->index }}" class="me-5">
                                                    <strong>{{ $key }}:</strong>
                                                    <span class="copy-value">{{ $value }}</span>
                                                </div>
                                                @if (strlen($value) > 0)
                                                    <button class="btn btn-icon btn-sm btn-light"
                                                        data-clipboard-target="#kt_clipboard_{{ $loop->index }}">
                                                        <i class="ki-duotone ki-copy fs-2 text-muted"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No original record found.</p>
                                    @endif
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Drawer-->

                            <div class="record-container">
                                @if ($dependent->record_completed)
                                    <span style="color: green;">&#10004;</span>
                                @endif

                            </div>



                            <div class="modal fade" tabindex="-1" id="kt_modal_1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Modal title</h3>

                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                            </div>
                                            <!--end::Close-->
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-check form-check-custom form-check-success form-check-solid">
                                                <input class="form-check-input" type="radio" value="" checked
                                                    id="flexCheckboxLg" />
                                                <label class="form-check-label" for="flexCheckboxLg">
                                                    Success
                                                </label>
                                            </div>

                                            <div class="form-check form-check-custom form-check-danger form-check-solid">
                                                <input class="form-check-input" type="radio" value="" checked
                                                    id="flexCheckboxSm" />
                                                <label class="form-check-label" for="flexCheckboxSm">
                                                    Danger
                                                </label>
                                            </div>

                                            <div class="form-check form-check-custom form-check-warning form-check-solid">
                                                <input class="form-check-input" type="radio" value="" checked
                                                    id="flexRadioLg" />
                                                <label class="form-check-label" for="flexRadioLg">
                                                    Warning
                                                </label>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save
                                                changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="bg-warning rounded mx-auto my-auto m-0 p-0">
                            <p class="text-center m-0 p-4">No dependents records found.</p>
                        </div>
                    @endif

                </div>
            </div>
            <!--END: Fifth accordion for Dependents -->


        </div>
    </div>
    <!--end::Accordion-->


    <!-- Hidden Button for Submit Action 1 -->
    <button type="submit" name="action" value="submitActionOne" style="display:none;">Save
        Membership</button>
    <!-- Hidden Button for Submit Action 2 -->
    <button type="submit" name="action" value="submitActionTwo" style="display:none;">Test
        Output</button>


    <!--begin::Alert (initially hidden)-->
    <div id="requiredAlert" class="alert alert-danger bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10"
        style="display: none !important;">
        <!--begin::Icon-->
        <i class="ki-duotone ki-information-5 fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span
                class="path2"></span><span class="path3"></span></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <!--begin::Title-->
            <h4 class="fw-semibold  text-danger">Incomplete Form</h4>
            <!--end::Title-->

            <!--begin::Content-->
            <span>All Tabs Need to be completed ('Green') before you can save.</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->

    </div>
    <!--end::Alert-->

    <!-- Duplicate Records Card -->
    @if (!$item['duplicates']->isEmpty())
        <div class="card inner-card bg-light mt-8">
            <div class="card-header" style="background-color: #448C74;">
                <h3 class="card-title" style="color: white">Duplicate Records</h3>
            </div>
            <div class="card-body">
                @foreach ($item['duplicates'] as $index => $duplicate)
                    <div class="record-container">
                        @php
                            // Decode the JSON into an array
                            $details = json_decode($duplicate->duplicate_details, true);
                            $summary = [];

                            foreach ($details as $key => $value) {
                                // Make key bold and concatenate with value
                                // Ensure HTML special characters are escaped appropriately
                                $summary[] = '<strong>' . e($key) . '</strong>: ' . e($value);
                            }

                            // Join all parts into one string
                            $summaryString = implode(', ', $summary);

                            // Optionally, limit the total length of the summary string
                            // if (strlen($summaryString) > 100) { // Example limit
                            //     $summaryString = substr($summaryString, 0, 100) . '...';
                            // }

                        @endphp


                        <p>Duplicate Details: {!! $summaryString !!}</p>
                        <div class="action-buttons pb-4">
                            <!-- Trigger Modal Button -->
                            <button type="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                data-target="#duplicateModal{{ $index }}">
                                View Details
                            </button>
                            <button type="button" class="btn btn-sm btn-danger"
                                data-source-table="{{ $duplicate->target_table_name }}"
                                data-record-id="{{ $duplicate->id }}"
                                data-membership-id="{{ $duplicate->membership_id }}"
                                onclick="handleRecordAction(this, 'discardDuplicate')">Remove</button>
                        </div>
                    </div>

                    <!-- Modal Structure -->
                    <div class="modal fade" id="duplicateModal{{ $index }}" tabindex="-1" role="dialog"
                        aria-labelledby="duplicateModalLabel{{ $index }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #448C74;">
                                    <h5 class="modal-title" style="color: white;">Duplicate Record
                                        Details
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="color: white;">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="background-color: #E9F0EC;">
                                    @php
                                        $duplicateDetails = json_decode($duplicate->duplicate_details, true);
                                    @endphp

                                    @if ($duplicateDetails)
                                        @foreach ($duplicateDetails as $key => $value)
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="mr-2"><strong>{{ $key }}:</strong></span>
                                                <input type="text" style="background-color: #ffffff;"
                                                    id="copy_{{ $duplicate->id }}_{{ $loop->index }}"
                                                    value="{{ $value }}" readonly
                                                    class="form-control d-inline-block"
                                                    style="width: auto; background-color: #adc2b4 !important; border-color: #849e8d; color: #495057;"
                                                    onclick="this.select(); ">
                                                <button class="btn btn-light btn-sm ml-2 copy-btn"
                                                    onclick="copyToClipboard('copy_{{ $duplicate->id }}_{{ $loop->index }}')"><i
                                                        class="fas fa-copy"></i></button>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No details available.</p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        {{-- <div class="card inner-card border border-secondary" >
                                                            <div class="card-header" style="background-color: #448C74;">
                                                                <h3 class="card-title" style="color: white">Duplicate Records</h3>
                                                            </div>
                                                            <div class="card-body bg-light ">
                                                                <p>No duplicate records found.</p>
                                                            </div>
                                                        </div> --}}
    @endif

    <!-- Error Records Card -->
    @if (!$item['errors']->isEmpty())
        <div class="card inner-card bg-light">
            <div class="card-header" style="background-color: #448C74;">
                <h3 class="card-title" style="color: white">Potential Dependents</h3>
            </div>
            <div class="card-body">
                {{-- Default by Mnguni --}}
                @foreach ($item['errors'] as $error)
                    <div class="record-container">
                        @php
                            $details = json_decode($error->source_details, true);
                            $summary = [];

                            if ($details) {
                                foreach ($details as $key => $value) {
                                    // Make key bold and concatenate with value, ensuring HTML special characters are escaped
                                    $summary[] = '<strong>' . e($key) . '</strong>: ' . e($value);
                                }

                                // Join all parts into one string
                                $summaryString = implode(', ', $summary);
                            } else {
                                $summaryString = 'N/A';
                            }
                        @endphp
                        <p>Source Details: {!! $summaryString !!}</p>
                        <!-- Hidden inputs generated from source_details -->
                        @if ($error->source_details)
                            @php
                                $details = json_decode($error->source_details, true);
                            @endphp
                            @foreach ($details as $key => $value)
                                <input type="hidden" id="{{ 'error_' . $error->id . '_' . $key }}"
                                    name="{{ 'error_' . $error->id . '_' . $key }}" value="{{ $value }}">
                            @endforeach
                        @endif

                        <div class="action-buttons">
                            <button id="makeDependantBtn" type="button" class="btn btn-sm btn-success"
                                data-source-table="{{ $error->target_table_name }}"
                                data-record-id="{{ $error->id }}"
                                data-membership-id="{{ $error->membership_id }}"
                                onclick="handleRecordAction(this, 'makeDependentError')">
                                Make Dependant
                            </button>

                            <button id="makeDependantBtn" type="button" class="btn btn-sm btn-warning"
                                data-source-table="{{ $error->target_table_name }}"
                                data-record-id="{{ $error->id }}"
                                data-membership-id="{{ $error->membership_id }}"
                                onclick="handleRecordAction(this, 'makeDeceasedError')">

                                Mark As Deceased
                            </button>

                            <button id="removeDependantBtn" type="button" class="btn btn-sm btn-danger"
                                data-source-table="{{ $error->target_table_name }}"
                                data-record-id="{{ $error->id }}"
                                data-membership-id="{{ $error->membership_id }}"
                                onclick="handleRecordAction(this, 'discardError')">

                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    @else
        {{-- <div class="card inner-card border border-secondary">
                                                            <div class="card-header" style="background-color: #448C74;">
                                                                <h3 class="card-title" style="color: white">Potential Dependents Records</h3>
                                                            </div>
                                                            <div class="card-body bg-light">
                                                                <p>No error records found.</p>
                                                            </div>
                                                        </div> --}}
    @endif


    </form>
    @endforeach
@else
    <p>No records found.</p>
    @endif
    {{-- </div> --}}
    </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.getElementById('hide-button').addEventListener('click', function() {
            document.getElementById('kt_drawer_death').classList.add('hide-drawer');
            document.querySelector('.card-column').classList.remove('col-md-9');
            document.querySelector('.card-column').classList.add('col-md-12');
            document.querySelector('.card-column').classList.add('show-drawer');
        });

        document.getElementById('show-button').addEventListener('click', function() {
            document.getElementById('kt_drawer_death').classList.remove('hide-drawer');
            document.querySelector('.card-column').classList.remove('col-md-12');
            document.querySelector('.card-column').classList.add('col-md-9');
            document.querySelector('.card-column').classList.remove('show-drawer');
        });
    </script>


    <!-- Include jQuery first -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Then include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Google places setup
            initAutocomplete('Line1', {
                Line1: 'Line1',
                Line2: 'Line2',
                PostalCode: 'PostalCode',
                City: 'City',
                TownSuburb: 'TownSuburb',
                Province: 'Province',
                Country: 'Country',
                PlaceName: 'PlaceName'
            });
        });
    </script>

    <script>
        function toggleDetails(selector) {
            $(selector).slideToggle('slow');
        }
    </script>

    {{-- This is for the submit buttons for MAIN because they are outside the form tags --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to check for empty required fields within a specific form
            function areRequiredFieldsFilled() {
                // Select only required inputs within the specified form
                const requiredInputs = document.querySelectorAll(
                    '#mainForm input[required], #mainForm textarea[required], #mainForm select[required]');
                return Array.from(requiredInputs).every(input => input.value.trim() !== '');
            }

            // Function to display the alert
            function showAlert() {
                const alert = document.getElementById('requiredAlert');
                alert.style.setProperty('display', 'flex', 'important');
                alert.style.setProperty('opacity', '1', 'important'); // Make it fully visible

                setTimeout(() => {
                    alert.style.setProperty('opacity', '0',
                        'important'); // Start fading out after 4 seconds
                    setTimeout(() => {
                        alert.style.setProperty('display', 'none',
                            'important'); // Hide completely after fade-out completes
                    }, 500); // Wait for the transition to finish
                }, 4000);
            }

            function handleClick(actionValue) {
                if (window.updateRequiredAttributes) {
                    window.updateRequiredAttributes();
                }
                if (!areRequiredFieldsFilled()) {
                    showAlert();
                    return; // Stop the action if required fields are not filled
                }
                // Trigger the corresponding hidden submit button
                document.querySelector(`button[name="action"][value="${actionValue}"]`).click();
            }

            document.getElementById('externalSubmitActionOne').addEventListener('click', function() {
                handleClick('submitActionOne');
            });

            document.getElementById('externalSubmitActionTwo').addEventListener('click', function() {
                handleClick('submitActionTwo');
            });
        });
    </script>

    {{-- This is for the duplicates modal --}}
    <script>
        function copyToClipboard(id) {
            var copyText = document.getElementById(id);
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand('copy');

            // Find the button that triggered the function
            var button = document.querySelector('button[onclick="copyToClipboard(\'' + id + '\')"]');

            // Save the original HTML of the button to revert back to it later
            var originalHTML = button.innerHTML;

            // Change the button's color to green and update its content to show a check mark or similar to indicate success
            button.style.backgroundColor = '#28a745';
            button.style.color = 'white';
            button.innerHTML = 'Copied! <i class="fa fa-check"></i>'; // Change this line as needed to match your icon

            // Revert the button's style and HTML after 1 second
            setTimeout(function() {
                button.style.backgroundColor =
                    ''; // Revert to original background color or set to any specific color
                button.innerHTML = originalHTML; // Revert to original HTML
            }, 1000);
        }
    </script>








    {{-- This is NOT for main record --}}
    <script>
        function handleRecordAction(button, actionType) {
            const sourceTable = button.getAttribute('data-source-table');
            const recordId = button.getAttribute('data-record-id');
            const membershipId = button.getAttribute('data-membership-id'); // Capture the membership ID
            let formData = {
                sourceTable: sourceTable,
                recordId: recordId,
                membershipId: membershipId, // Include membershipId in the formData
                actionType: actionType, // Make sure this aligns with the backend expectations
            };

            // Collect hidden inputs for 'makeDependentError' action type only
            if (actionType === 'makeDependentError') {
                formData.details = {};
                document.querySelectorAll(`input[id^='error_${recordId}_']`).forEach(input => {
                    // Extract the original key name by removing the 'error_' prefix and the record ID
                    let originalKeyName = input.name.replace(`error_${recordId}_`, '');
                    formData.details[originalKeyName] = input.value;
                });
            }



            let jsonData = JSON.stringify(formData);

            fetch('/process-record-action', { // Adjust if your app's base URL is different
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: jsonData
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    // Handle non-2xx responses
                    return response.json().then(errorData => {
                        // If there's a known error message structure
                        const errorMessage = errorData.message || "An error occurred, please try again.";
                        console.error('Error:', errorMessage);
                        // Display a user-friendly error message
                        alert(errorMessage);
                        throw new Error(errorMessage);
                    });
                })
                .then(data => {
                    console.log('Success:', data);
                    window.location.reload(); // Refresh to reflect changes
                })
                .catch((error) => {
                    // For unexpected errors, provide a generic message
                    alert("An unexpected error occurred. Please contact support if the problem persists.");
                    console.error('Unexpected Error:', error);
                });
        }
    </script>

    {{-- dependent modal and updating hidden fields --}}
    {{-- <script>
        let currentEditingDependentId;

        function editDependent(dependentId) {
            currentEditingDependentId = dependentId;
            // Populate the modal fields with values from hidden inputs
            document.getElementById('modal_membership_id').value = document.getElementById('dependent_membership_id_' +
                dependentId).value;
            document.getElementById('modal_first_name').value = document.getElementById('dependent_first_name_' +
                dependentId).value;
            document.getElementById('modal_initials').value = document.getElementById('dependent_initials_' + dependentId)
                .value;
            document.getElementById('modal_last_name').value = document.getElementById('dependent_last_name_' + dependentId)
                .value;
            document.getElementById('modal_screen_name').value = document.getElementById('dependent_screen_name_' +
                dependentId).value;
            document.getElementById('modal_id_number').value = document.getElementById('dependent_id_number_' + dependentId)
                .value;
            document.getElementById('modal_birth_date').value = document.getElementById('dependent_birth_date_' +
                dependentId).value;
            document.getElementById('modal_person_relationship_id').value = document.getElementById(
                'dependent_person_relationship_id_' + dependentId).value;
            document.getElementById('modal_gender_id').value = document.getElementById('dependent_gender_id_' + dependentId)
                .value;
            document.getElementById('modal_join_date').value = document.getElementById('dependent_join_date_' + dependentId)
                .value;
            document.getElementById('modal_primary_contact_number').value = document.getElementById(
                'dependent_primary_contact_number_' + dependentId).value;
            document.getElementById('modal_secondary_contact_number').value = document.getElementById(
                'dependent_secondary_contact_number_' + dependentId).value;
            document.getElementById('modal_primary_e_mail_address').value = document.getElementById(
                'dependent_primary_e_mail_address_' + dependentId).value;

            $('#editDependentModal').modal('show');
        }

        function updateDependent() {
            // Update the hidden fields with new values from the modal
            document.getElementById('dependent_membership_id_' + currentEditingDependentId).value = document.getElementById(
                'modal_membership_id').value;
            document.getElementById('dependent_first_name_' + currentEditingDependentId).value = document.getElementById(
                'modal_first_name').value;
            document.getElementById('dependent_initials_' + currentEditingDependentId).value = document.getElementById(
                'modal_initials').value;
            document.getElementById('dependent_last_name_' + currentEditingDependentId).value = document.getElementById(
                'modal_last_name').value;
            document.getElementById('dependent_screen_name_' + currentEditingDependentId).value = document.getElementById(
                'modal_screen_name').value;
            document.getElementById('dependent_id_number_' + currentEditingDependentId).value = document.getElementById(
                'modal_id_number').value;
            document.getElementById('dependent_birth_date_' + currentEditingDependentId).value = document.getElementById(
                'modal_birth_date').value;
            document.getElementById('dependent_person_relationship_id_' + currentEditingDependentId).value = document
                .getElementById('modal_person_relationship_id').value;
            document.getElementById('dependent_gender_id_' + currentEditingDependentId).value = document.getElementById(
                'modal_gender_id').value;
            document.getElementById('dependent_join_date_' + currentEditingDependentId).value = document.getElementById(
                'modal_join_date').value;
            document.getElementById('dependent_primary_contact_number_' + currentEditingDependentId).value = document
                .getElementById('modal_primary_contact_number').value;
            document.getElementById('dependent_secondary_contact_number_' + currentEditingDependentId).value = document
                .getElementById('modal_secondary_contact_number').value;
            document.getElementById('dependent_primary_e_mail_address_' + currentEditingDependentId).value = document
                .getElementById('modal_primary_e_mail_address').value;

            // Update the summary with new values from the modal
            document.getElementById('summary_membership_id_' + currentEditingDependentId).innerText = document
                .getElementById('modal_membership_id').value;
            document.getElementById('summary_first_name_' + currentEditingDependentId).innerText = document.getElementById(
                'modal_first_name').value;
            document.getElementById('summary_initials_' + currentEditingDependentId).innerText = document.getElementById(
                'modal_initials').value;
            document.getElementById('summary_last_name_' + currentEditingDependentId).innerText = document.getElementById(
                'modal_last_name').value;
            document.getElementById('summary_screen_name_' + currentEditingDependentId).innerText = document.getElementById(
                'modal_screen_name').value;
            document.getElementById('summary_id_number_' + currentEditingDependentId).innerText = document.getElementById(
                'modal_id_number').value;
            document.getElementById('summary_birth_date_' + currentEditingDependentId).innerText = document.getElementById(
                'modal_birth_date').value;
            document.getElementById('summary_person_relationship_id_' + currentEditingDependentId).innerText = document
                .getElementById('modal_person_relationship_id').value;
            document.getElementById('summary_gender_id_' + currentEditingDependentId).innerText = document.getElementById(
                'modal_gender_id').value;
            document.getElementById('summary_join_date_' + currentEditingDependentId).innerText = document.getElementById(
                'modal_join_date').value;
            document.getElementById('summary_primary_contact_number_' + currentEditingDependentId).innerText = document
                .getElementById('modal_primary_contact_number').value;
            document.getElementById('summary_secondary_contact_number_' + currentEditingDependentId).innerText = document
                .getElementById('modal_secondary_contact_number').value;
            document.getElementById('summary_primary_e_mail_address_' + currentEditingDependentId).innerText = document
                .getElementById('modal_primary_e_mail_address').value;


            $('#editDependentModal').modal('hide');
        }
    </script> --}}

    {{-- Dependent: Mark as completed and remove --}}
    <script>
        // function markAsComplete(dependentId) {
        //     fetch('/mark-dependent-complete/' + dependentId, {
        //             method: 'POST',
        //             headers: {
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        //                 'Content-Type': 'application/json'
        //             },
        //             body: JSON.stringify({}) // Empty body since we're just marking as complete based on ID
        //         })
        //         .then(response => {
        //             if (!response.ok) {
        //                 throw new Error('Network response was not ok');
        //             }
        //             return response.json();
        //         })
        //         .then(data => {
        //             console.log('Success:', data);
        //             // Hide the "Mark as Complete" button for this record
        //             document.getElementById('mark_complete_btn_' + dependentId).style.display = 'none';
        //             // Optionally, add a green checkmark next to the record
        //             document.getElementById('record_status_' + dependentId).innerHTML = '&#10004;'; // Green check mark
        //         })
        //         .catch(error => console.error('Error:', error));
        // }


        function removeDependent(dependentId) {
            // Ask the user if they are sure they want to discard
            if (confirm('Are you sure you want to discard this dependent?')) {
                fetch('/remove-dependent/' + dependentId, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({}) // No need to send data in the body for this request
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Success:', data);
                        // Optionally, refresh the page to reflect changes
                        window.location.reload();
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>

    {{-- This is for accordion header validation colour change --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAccordionButtons = () => {
                document.querySelectorAll('.accordion-item').forEach((accordionItem) => {
                    if (accordionItem.style.display === 'none' || getComputedStyle(accordionItem)
                        .display === 'none') {
                        return; // Skip if the accordion item itself is not visible.
                    }

                    const accordionBody = accordionItem.querySelector('.accordion-collapse');
                    let allFilled = true;

                    accordionBody.querySelectorAll(
                        'input[required], textarea[required], select[required]').forEach((
                        input) => {
                        const paymentSection = input.closest('.payment-section');
                        if (paymentSection && (paymentSection.style.display === 'none' ||
                                getComputedStyle(paymentSection).display === 'none')) {
                            return; // Skip this input as its section is hidden.
                        }
                        if (!input.value.trim()) {
                            allFilled = false;
                        }
                    });

                    const accordionButton = accordionItem.querySelector('.accordion-button');
                    if (allFilled) {
                        accordionButton.classList.remove('missing-input');
                    } else {
                        accordionButton.classList.add('missing-input');
                    }
                });
            };

            window.updateRequiredAttributes = () => {
                document.querySelectorAll('.payment-section').forEach(section => {
                    const isVisible = section.style.display !== 'none' && getComputedStyle(section)
                        .display !== 'none';

                    section.querySelectorAll('input, textarea, select').forEach(input => {
                        // Set inputs as required if their section is visible, not required otherwise.
                        input.required = isVisible;

                        // Disable inputs if their section is not visible, enable them otherwise.
                        input.disabled = !isVisible;
                    });
                });
            };


            // Handling the payment method selection
            const paymentMethodSelect = document.getElementById('paymentMethod');
            paymentMethodSelect.addEventListener('change', () => {
                document.querySelectorAll('.payment-section').forEach(section => {
                    section.style.display = 'none';
                });

                const selectedValue = paymentMethodSelect.value;
                const selectedSectionId = selectedValue + 'Section';
                const selectedSection = document.getElementById(selectedSectionId);
                if (selectedSection) {
                    selectedSection.style.display = '';
                }

                window.updateRequiredAttributes();
                checkAccordionButtons();
            });

            document.querySelectorAll('.accordion').forEach(accordion => {
                accordion.addEventListener('shown.bs.collapse', checkAccordionButtons);
                accordion.addEventListener('hidden.bs.collapse', checkAccordionButtons);
            });

            document.querySelectorAll('.accordion-item .accordion-collapse').forEach(accordionBody => {
                accordionBody.querySelectorAll('input[required], textarea[required], select[required]')
                    .forEach(input => {
                        input.addEventListener('input', checkAccordionButtons);
                    });
            });

            // Initial setup to ensure correct state based on default or previously selected payment method
            if (paymentMethodSelect) {
                paymentMethodSelect.dispatchEvent(new Event('change'));
            } else {
                window.updateRequiredAttributes();
                checkAccordionButtons();
            }
        });
    </script>



    {{-- This is for the submit buttons for MAIN because they are outside the form tags --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure that the required attributes are updated based on the current state
            function handleClick(actionValue) {
                if (window.updateRequiredAttributes) {
                    window.updateRequiredAttributes();
                }
                // Trigger the corresponding hidden submit button
                document.querySelector(`button[name="action"][value="${actionValue}"]`).click();
            }

            // External "Save Membership" button listener
            document.getElementById('externalSubmitActionOne').addEventListener('click', function() {
                handleClick('submitActionOne');
            });

            // External "Test Output" button listener
            document.getElementById('externalSubmitActionTwo').addEventListener('click', function() {
                handleClick('submitActionTwo');
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize ClipboardJS for all buttons with data-clipboard-target
            var clipboard = new ClipboardJS('[data-clipboard-target]', {
                text: function(trigger) {
                    return trigger.parentElement.querySelector('.copy-value').textContent;
                }
            });

            clipboard.on('success', function(e) {
                var button = e.trigger;
                var target = document.querySelector(button.getAttribute('data-clipboard-target'));
                var checkIcon = button.querySelector('.ki-check');
                var copyIcon = button.querySelector('.ki-copy');

                // Exit check icon when already showing
                if (checkIcon) {
                    return;
                }

                // Create check icon
                checkIcon = document.createElement('i');
                checkIcon.classList.add('ki-duotone', 'ki-check', 'fs-2x');

                // Append check icon
                button.appendChild(checkIcon);

                // Highlight target
                const classes = ['text-success', 'fw-boldest'];
                target.classList.add(...classes);

                // Highlight button
                button.classList.add('btn-success');

                // Hide copy icon
                copyIcon.classList.add('d-none');

                // Revert button label after 3 seconds
                setTimeout(function() {
                    // Remove check icon
                    copyIcon.classList.remove('d-none');

                    // Revert icon
                    button.removeChild(checkIcon);

                    // Remove target highlight
                    target.classList.remove(...classes);

                    // Remove button highlight
                    button.classList.remove('btn-success');
                }, 3000);
            });
        });
    </script>





    {{-- THINA --}}
    <script>
        // JavaScript to trigger SweetAlert

        document.getElementById('demoButton').addEventListener('click', function() {
            // Example condition: a simple boolean variable
            // Adjust this condition based on your specific needs
            var conditionMet = true; // Change this to false to prevent the alert from showing

            if (conditionMet) {
                // Condition is met, show the SweetAlert
                Swal.fire({
                    title: 'Hello!',
                    text: 'This is a Sweet Alert!',
                    icon: 'success',
                    confirmButtonText: 'Cool',
                    customClass: {
                        title: 'swal2-title',
                        content: 'swal2-content'
                    }
                });
            } else {
                // Condition is not met, do something else or nothing
                console.log('Condition not met, alert not shown.');
            }
        });
    </script>





    {{-- Payment type selection --}}

    <script>
        document.getElementById('paymentMethod').addEventListener('change', function() {
            // Hide all sections
            document.querySelectorAll('.payment-section').forEach(function(section) {
                section.style.display = 'none';
            });

            // Show the selected section
            const selectedPaymentMethod = this.value;
            if (selectedPaymentMethod) {
                const sectionId = selectedPaymentMethod + 'Section';
                document.getElementById(sectionId).style.display = 'block';
            }
        });

        // Example to handle EFT form submission
        document.getElementById('eftForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Collect data
            const eftData = {
                accountHolder: document.getElementById('eftAccountHolder').value,
                accountNumber: document.getElementById('eftAccountNumber').value,
                bankName: document.getElementById('eftBankName').value,
                branchCode: document.getElementById('eftBranchCode').value,
            };
            console.log(eftData); // For demonstration, replace with AJAX call to server
            // Reset form or provide feedback
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add click event listener to each card
            document.querySelectorAll('.card').forEach(function(card) {
                card.addEventListener('click', function() {
                    // Find the detail div within the clicked card and toggle visibility
                    var detailDiv = card.querySelector('.card-detail');
                    if (detailDiv.style.display === "none") {
                        detailDiv.style.display = "block";
                    } else {
                        detailDiv.style.display = "none";
                    }
                });
            });
        });
    </script>

    {{-- END -- Payment type selection --}}






    <script>
        // JavaScript to trigger SweetAlert
        document.getElementById('removeDependantBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Error Record',
                text: 'Successfully Removed Dependant',
                icon: 'success',
                confirmButtonText: 'Ok',
                customClass: {
                    title: 'swal2-title',
                    content: 'swal2-content'
                }
            });
        });
    </script>

    <script>
        // JavaScript to trigger SweetAlert
        document.getElementById('btnMarkAsComplete').addEventListener('click', function() {
            Swal.fire({
                title: 'Dependents',
                text: 'Successfully Completed',
                icon: 'success',
                confirmButtonText: 'Ok',
                customClass: {
                    title: 'swal2-title',
                    content: 'swal2-content'
                }
            });
        }); <
        /s>

        <
        script >
            document.getElementById('demoButton2').addEventListener('click', function() {
                // Example condition: a simple boolean variable
                // Adjust this condition based on your specific needs
                var conditionMet = true; // Change this to false to prevent the alert from showing

                if (conditionMet) {
                    // Condition is met, show the SweetAlert
                    Swal.fire({
                        title: 'Hello!',
                        text: 'This is a Sweet Alert!',
                        icon: 'success',
                        confirmButtonText: 'Cool',
                        customClass: {
                            title: 'swal2-title',
                            content: 'swal2-content'
                        }
                    });
                } else {
                    // Condition is not met, do something else or nothing
                    console.log('Condition not met, alert not shown.');
                }
            });
    </script>
@endpush
