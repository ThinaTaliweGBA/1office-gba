@extends('layouts.app2')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}


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
            background-color: white;
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
        /* Style for accordion button when accordion is open */
        /* .accordion-button:not(.collapsed) {
                        background-color: #F2FAFF !important;
                        
                        color: #009ef7 !important;
                        
                    } */

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
            background-color: #FFF5F8 !important;
            /*#e57373 #f20d20b7 A nice, complementing red */
            color: #f1416c !important;
            /* White text for readability */
        }

        /* Hover effect for invalid accordion button */
        .accordion-button.missing-input:hover {
            background-color: #F1416C !important;
            /* A lighter/different shade for hover effect */
            color: #ffffff !important;
            /* Ensuring text color is readable on hover; adjust as needed */
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
            border-color: #f1416c !important;
            /* A complementing red for missing required inputs */
            box-shadow: 0 0 0 .2rem rgba(229, 115, 115, .25);
            /* Optional: add a subtle shadow to further highlight the field */
        }
    </style>

    <style>
        /* .form-control {
                            background-color: white !important;
                        } */

        .select2-container--bootstrap5 .select2-dropdown {
            background-color: white !important;
        }

        .select2-container--bootstrap5 .select2-dropdown .select2-search .select2-search__field {
            background-color: #E7EEEA !important;
        }

        .pac-container {
            z-index: 9999 !important;
            /* This is for my Google Maps in modal Bootstrap modals usually have a z-index of 1050 */
        }
    </style>

<script>
    function calculateTotal() {
        const costs = document.querySelectorAll('.cost-input');
        let total = 0;
        costs.forEach((cost) => {
            if (cost.value) total += parseFloat(cost.value);
        });
        document.getElementById('totalCost').innerText = total.toFixed(2);
        document.getElementById('totalCost2').innerText = total.toFixed(2);
        document.getElementById('totalCostHeader').innerText = total.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        calculateTotal();
    });
</script>


    <style>
        /* Center table header (thead) and footer (tfoot) text */
        #kt_datatable_footer_callback th,
        #kt_datatable_benefit_footer_callback th {
            text-align: center;
            /* Horizontally center the text in table headers */
            vertical-align: middle;
            /* Vertically center the text in table headers */
        }

        /* Center table body (tbody) content */
        #kt_datatable_footer_callback td,
        #kt_datatable_benefit_footer_callback td {
            text-align: center;
            /* Horizontally center the text in table cells */
            vertical-align: middle;
            /* Vertically center the text in table cells */
        }

        /* Adjust input fields to be centered if needed, this might depend on your specific design */
        .form-control.cost-input {
            width: auto;
            /* Adjust width as needed */
            margin: 0 auto;
            /* Horizontally center the input fields in their table cells */
            display: block;
        }

        /* Ensure the table itself is centered in its container */
        /* #kt_datatable_footer_callback
                        #kt_datatable_benefit_footer_callback  {
                            margin-left: auto;
                            margin-right: auto;
                        } */
    </style>
    <style>
        #kt_datatable_footer_callback .input-group,
        #kt_datatable_benefit_footer_callback .input-group {
            width: 80% !important;
        }
    </style>
    <style>
        #requiredAlert {
            display: none !important;
            /* Initially hidden */
            opacity: 0 !important;
            /* Start fully transparent */
            transition: opacity 0.5s ease-in-out;
            /* Smooth transition for opacity */
        }

        #requiredAlert.show {
            display: flex !important;
            /* Make sure it’s flex when visible */
            opacity: 1 !important;
            /* Fully visible */
        }
    </style>

    <style>
        .top-align {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            align-content: start;
        }
    </style>
@endpush

@section('row_content')


    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        
        <!--begin::Container-->
        <div class=" container-fluid " id="kt_content_container">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">

                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card body-->
                        <div class="card-body pt-15">
                            <!--begin::Summary-->
                            <div class="d-flex flex-center flex-column mb-5">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-100px  mb-7">
                                    <img src="{{ asset('img/condolences.png') }}" alt="image" />
                                </div>
                                <!--end::Avatar-->

                                <!--begin::Name-->
                                <a href="#" class="fs-3 text-gray-800  fw-bold mb-1">
                                    {{ $deceased_person->first_name . '  ' . $deceased_person->initials . '  ' . $deceased_person->last_name }}
                                </a>
                                <!--end::Name-->

                                <!--begin::Death_Date-->
                                <div class="fs-5 fw-semibold text-muted mb-6">
                                    Death: {{ $deceased_person->deceased_date }} </div>
                                <!--end::Death_Date-->

                                <!--begin::Info-->
                                <div class="d-flex flex-wrap flex-center">
                                    {{-- <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bold text-gray-700 text-center">
                                            <span class="w-75px">69</span>
                                           
                                        </div>
                                        <div class="fw-semibold text-muted">Join-Age</div>
                                    </div>
                                    <!--end::Stats--> --}}

                                    <!--begin::Stats-->
                                    {{-- <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                        <div class="fs-4 fw-bold text-gray-700 text-center">
                                            <span class="w-50px">95</span>
                                           
                                        </div>
                                        <div class="fw-semibold text-muted">Death-Age</div>
                                    </div> --}}
                                    <!--end::Stats-->

                                    <!--begin::Notice-->
                                    <div
                                        class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-design-1 fs-2tx text-primary me-4"></i> <!--end::Icon-->

                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1 ">
                                            <!--begin::Content-->
                                            <div class=" fw-semibold">

                                                <div class="fs-6 text-gray-700 ">Would the deceased like to have a funeral
                                                    arranged by GBA? </br>
                                                    Else, Pay-Out (if applicable)
                                                </div>

                                                <div class="separator separator-dashed my-5"></div>

                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack">
                                                    <div class="d-flex">
                                                        <img src="{{ asset('img/grave.png') }}" class="w-30px me-6"
                                                            alt="" />

                                                        <div class="d-flex flex-column">
                                                            <a href="#" class="fs-5 text-gray-900 fw-bold">Funeral Required</a>

                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <!--begin::Switch-->
                                                        <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                            <!--begin::Input-->
                                                            <input class="form-check-input" name="funeral_required" type="checkbox" value="1" id="funeral_required" 
                                                                   data-funeral-id="{{ $funeral->id }}" {{ $funeral->funeral_required ? 'checked' : '' }} />
                                                            <!--end::Input-->
                                                        </label>
                                                        <!--end::Switch-->
                                                    </div>
                                                </div>
                                                <!--end::Item-->








                                            </div>
                                            <!--end::Content-->

                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice-->

                                    <!--begin::Stats-->
                                    {{-- <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bold text-gray-700">
                                            <span class="w-50px">500</span>
                                            <i class="ki-duotone ki-arrow-up fs-3 text-success"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                        </div>
                                        <div class="fw-semibold text-muted">Hours</div>
                                    </div> --}}
                                    <!--end::Stats-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Summary-->

                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible collapsed" data-bs-toggle="collapse"
                                    href="#kt_person_view_details" role="button" aria-expanded="false"
                                    aria-controls="kt_person_view_details">
                                    Deceased's Details
                                    <span class="ms-2 rotate-180">
                                        <i class="ki-duotone ki-down fs-3"></i> </span>
                                </div>


                            </div>
                            <!--end::Details toggle-->

                            <div class="separator separator-dashed my-3"></div>

                            <!--begin::Details content-->
                            <div id="kt_person_view_details" class="collapse ">
                                <div class="py-5 fs-6">
                                    <!--begin::Badge-->
                                    <div class="badge badge-light-info d-inline">Great member</div>
                                    <!--begin::Badge-->

                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">ID Number</div>
                                    <div class="text-gray-600">{{ $deceased_person->id_number ?? 'Not Provided' }}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Date of birth</div>
                                    <div class="text-gray-600">{{ $deceased_person->birth_date ?? 'Not Provided' }}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Gender</div>
                                    <div class="text-gray-600">Female</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Last Address</div>
                                    @if ($addresses->isEmpty())
                                        <div class="text-gray-600">Unknown</div>
                                    @else
                                        @foreach ($addresses as $address)
                                            <div class="text-gray-600">
                                                {{ $address->line1 }}, <br />
                                                {{ $address->suburb }}<br />
                                                {{ $address->city }}<br />
                                                {{ $address->province }}<br />
                                                {{ $address->ZIP }}<br />
                                            </div>
                                        @endforeach
                                    @endif
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Language</div>
                                    <div class="text-gray-600">{{ $deceased_person->birth_date ?? 'Not Provided' }}</div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Marital Status</div>
                                    <div class="text-gray-600">{{ $deceased_person->married_status ?? 'Not Provided' }}
                                    </div>
                                    <!--begin::Details item-->
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Funeral Checklist-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h3>Funeral Checklist</h3>
                            </div>
                            <!--end::Card title-->

                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Filter-->
                                <button type="button" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal"
                                    data-bs-target="#add_checklist_item_modal">
                                    <i class="ki-duotone ki-plus-square fs-3"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span></i>
                                    Add Item
                                </button>
                                <!--end::Filter-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->

                        <div class="card-body pt-0">
                            <!--begin::Items-->
<div class="py-2">
    @foreach ($checklist_items as $item)
        <div class="d-flex flex-stack">
            <div class="d-flex">
                <div class="d-flex flex-column">
                    <a href="#"
                        class="fs-5 text-gray-900 text-hover-primary fw-bold">{{ $item->name }}</a>
                    <div class="fs-7 fw-semibold text-muted">
                        Completed: <span id="dated_completed_{{ $item->id }}">
                            {{ $item->completed ? $item->completed_date : 'Not completed' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                    <input class="form-check-input checklist-checkbox"
                        id="{{ $item->id }}_checkbox"
                        name="checklist[{{ $item->id }}][completed]" type="checkbox"
                        data-item-id="{{ $item->id }}" {{ $item->completed ? 'checked' : '' }}>
                    <span class="form-check-label fw-semibold text-muted"
                        for="{{ $item->id }}_checkbox"></span>
                </label>
            </div>
        </div>
        <div class="input-group input-group-solid mt-2">
            <span class="fs-7 input-group-text">Notes</span>
            <textarea class="form-control note-textarea" id="{{ $item->id }}_note"
                name="checklist[{{ $item->id }}][note]" aria-label="Notes" rows="1">{{ $item->note }}</textarea>
        </div>
        <div class="separator separator-dashed my-5"></div>
    @endforeach
    @if ($checklist_items->isEmpty())
        <h4>No Checklist items available</h4>
    @endif
</div>
<!--end::Items-->

                        </div>

                    </div>
                    <!--end::Funeral Checklist-->
                </div>
                <!--end::Sidebar-->

                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#funeral_view_overview_tab">Overview & Funeral Details</a>
                        </li>
                        <!--end:::Tab item-->

                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#funeral_costs_tab">Funeral Costs</a>
                        </li>
                        <!--end:::Tab item-->

                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab"
                                href="#shortfalls_and_payouts_tab">Shortfalls & Payouts</a>
                        </li>
                        <!--end:::Tab item-->

                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab"
                                href="#others_tab">Others</a>
                        </li>
                        <!--end:::Tab item-->

                        <!--begin:::Tab item-->
                        <li class="nav-item ms-auto">
                            <!--begin::Action menu-->
                            <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click"
                                data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                Actions
                                <i class="ki-duotone ki-down fs-2 me-0"></i> </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">
                                        Payments
                                    </div>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link px-5">
                                        Create invoice
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link flex-stack px-5">
                                        Create payments

                                        <span class="ms-2" data-bs-toggle="tooltip"
                                            title="Specify a target name for future usage and reference">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i> </span>
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-5" data-kt-menu-trigger="hover"
                                    data-kt-menu-placement="left-start">
                                    <a href="#" class="menu-link px-5">
                                        <span class="menu-title">Subscription</span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <!--begin::Menu sub-->
                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-5">
                                                Apps
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-5">
                                                Billing
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-5">
                                                Statements
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3">
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input w-30px h-20px" type="checkbox"
                                                        value="" name="notifications" checked
                                                        id="kt_user_menu_notifications" />
                                                    <span class="form-check-label text-muted fs-6"
                                                        for="kt_user_menu_notifications">
                                                        Notifications
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu sub-->
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu separator-->
                                <div class="separator my-3"></div>
                                <!--end::Menu separator-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">
                                        Account
                                    </div>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link px-5">
                                        Reports
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-5 my-1">
                                    <a href="#" class="menu-link px-5">
                                        Account Settings
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link text-danger px-5">
                                        Delete customer
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Menu-->
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->

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


                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="funeral_view_overview_tab" role="tabpanel">
                            {{-- <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Payment Records</h2>
                                    </div>
                                    <!--end::Card title-->

                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Filter-->
                                        <button type="button" class="btn btn-sm btn-flex btn-light-primary"
                                            data-bs-toggle="modal" data-bs-target="#add_checklist_item_modal">
                                            <i class="ki-duotone ki-plus-square fs-3"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i>
                                            Add payment
                                        </button>
                                        <!--end::Filter-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed gy-5"
                                        id="kt_table_customers_payment">
                                        <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                            <tr class="text-start text-muted text-uppercase gs-0">
                                                <th class="min-w-100px">Invoice No.</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th class="min-w-100px">Date</th>
                                                <th class="text-end min-w-100px pe-4">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            <tr>
                                                <td>
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary mb-1">7955-9412</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">Successful</span>
                                                </td>
                                                <td>
                                                    $1,200.00 </td>
                                                <td>
                                                    14 Dec 2020, 8:43 pm </td>
                                                <td class="pe-0 text-end">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light image.png btn-active-light-primary"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="/metronic8/demo15/apps/customers/view.html"
                                                                class="menu-link px-3">
                                                                View
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3"
                                                                data-kt-customer-table-filter="delete_row">
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary mb-1">1549-9495</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">Successful</span>
                                                </td>
                                                <td>
                                                    $79.00 </td>
                                                <td>
                                                    01 Dec 2020, 10:12 am </td>
                                                <td class="pe-0 text-end">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light image.png btn-active-light-primary"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="/metronic8/demo15/apps/customers/view.html"
                                                                class="menu-link px-3">
                                                                View
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3"
                                                                data-kt-customer-table-filter="delete_row">
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary mb-1">7429-9020</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">Successful</span>
                                                </td>
                                                <td>
                                                    $5,500.00 </td>
                                                <td>
                                                    12 Nov 2020, 2:01 pm </td>
                                                <td class="pe-0 text-end">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light image.png btn-active-light-primary"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="/metronic8/demo15/apps/customers/view.html"
                                                                class="menu-link px-3">
                                                                View
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3"
                                                                data-kt-customer-table-filter="delete_row">
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary mb-1">5557-1462</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-warning">Pending</span>
                                                </td>
                                                <td>
                                                    $880.00 </td>
                                                <td>
                                                    21 Oct 2020, 5:54 pm </td>
                                                <td class="pe-0 text-end">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light image.png btn-active-light-primary"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="/metronic8/demo15/apps/customers/view.html"
                                                                class="menu-link px-3">
                                                                View
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3"
                                                                data-kt-customer-table-filter="delete_row">
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary mb-1">2285-3125</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">Successful</span>
                                                </td>
                                                <td>
                                                    $7,650.00 </td>
                                                <td>
                                                    19 Oct 2020, 7:32 am </td>
                                                <td class="pe-0 text-end">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light image.png btn-active-light-primary"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="/metronic8/demo15/apps/customers/view.html"
                                                                class="menu-link px-3">
                                                                View
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3"
                                                                data-kt-customer-table-filter="delete_row">
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary mb-1">2644-9602</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">Successful</span>
                                                </td>
                                                <td>
                                                    $375.00 </td>
                                                <td>
                                                    23 Sep 2020, 12:38 am </td>
                                                <td class="pe-0 text-end">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light image.png btn-active-light-primary"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="/metronic8/demo15/apps/customers/view.html"
                                                                class="menu-link px-3">
                                                                View
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3"
                                                                data-kt-customer-table-filter="delete_row">
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary mb-1">5799-6058</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">Successful</span>
                                                </td>
                                                <td>
                                                    $129.00 </td>
                                                <td>
                                                    11 Sep 2020, 3:18 pm </td>
                                                <td class="pe-0 text-end">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light image.png btn-active-light-primary"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="/metronic8/demo15/apps/customers/view.html"
                                                                class="menu-link px-3">
                                                                View
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3"
                                                                data-kt-customer-table-filter="delete_row">
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary mb-1">1774-7945</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-danger">Rejected</span>
                                                </td>
                                                <td>
                                                    $450.00 </td>
                                                <td>
                                                    03 Sep 2020, 1:08 am </td>
                                                <td class="pe-0 text-end">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light image.png btn-active-light-primary"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="/metronic8/demo15/apps/customers/view.html"
                                                                class="menu-link px-3">
                                                                View
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3"
                                                                data-kt-customer-table-filter="delete_row">
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary mb-1">2095-6145</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-warning">Pending</span>
                                                </td>
                                                <td>
                                                    $8,700.00 </td>
                                                <td>
                                                    01 Sep 2020, 4:58 pm </td>
                                                <td class="pe-0 text-end">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light image.png btn-active-light-primary"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="/metronic8/demo15/apps/customers/view.html"
                                                                class="menu-link px-3">
                                                                View
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3"
                                                                data-kt-customer-table-filter="delete_row">
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card--> --}}

                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="fw-bold mb-0">Memberships</h2>
                                    </div>
                                    <!--end::Card title-->

                                    {{-- <!--begin::Card toolbar-->
                                                                <div class="card-toolbar">
                                                                    <a href="#" class="btn btn-sm btn-flex btn-light-primary"
                                                                        data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
                                                                        <i class="ki-duotone ki-plus-square fs-3"><span class="path1"></span><span
                                                                                class="path2"></span><span class="path3"></span></i> Add new method
                                                                    </a>
                                                                </div>
                                                                <!--end::Card toolbar--> --}}
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div id="kt_customer_view_payment_method" class="card-body pt-0">

                                    @foreach ($deceased_person->allMemberships() as $membership)
                                    @php
                                    $relationshipType = 'Main Member';
                                    if ($membership->pivot) {
                                        if ($membership->pivot->secondary_person_id == $deceased_person->id) {
                                            $relationshipType = 'Dependent';
                                        }
                                        if ($membership->pivot->person_relationship_id == 1) {
                                            $relationshipType = 'Spouse';
                                        }
                                    }
                                @endphp
                                
                                        <!--begin::Option-->
                                        <div class="py-0" data-kt-customer-payment-method="row">
                                            <!--begin::Header-->
                                            <div class="py-3 d-flex flex-stack flex-wrap">
                                                <!--begin::Toggle-->
                                                <div class="d-flex align-items-center collapsible collapsed rotate"
                                                    data-bs-toggle="collapse"
                                                    href="#kt_membership_info_{{ $membership->id }}" role="button"
                                                    aria-expanded="false"
                                                    aria-controls="kt_membership_info_{{ $membership->id }}">
                                                    <!--begin::Arrow-->
                                                    <div class="me-3 rotate-90"><i class="ki-duotone ki-right fs-3"></i>
                                                    </div>
                                                    <!--end::Arrow-->

                                                    <!--begin::Logo-->
                                                    <img src="{{ asset('img/grave.png') }}" class="w-40px me-3"
                                                        alt="" />
                                                    <!--end::Logo-->

                                                    <!--begin::Summary-->
                                                    <div class="me-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="text-gray-800 fw-bold">
                                                                Membership ID: {{ $membership->membership_code ?? 'n/a' }}
                                                            </div>

                                                            <div class="badge badge-light-success ms-5">
                                                                {{ $membership->status->name }}</div>
                                                        </div>
                                                        {{-- <div class="text-muted">membership_status</div> --}}
                                                        <div
                                                            class="badge badge-light-{{ $relationshipType == 'Main Member' ? 'primary' : 'info' }}">
                                                            {{ $relationshipType }}</div>
                                                    </div>
                                                    <!--end::Summary-->
                                                </div>
                                                <!--end::Toggle-->

                                                {{-- <!--begin::Toolbar-->
                                                <div class="d-flex my-3 ms-9">
                                                    <!--begin::Edit-->
                                                    <a href="#"
                                                        class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                                        data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
                                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                            title="Edit">
                                                            <i class="ki-duotone ki-pencil fs-3"><span
                                                                    class="path1"></span><span class="path2"></span></i>
                                                        </span>
                                                    </a>
                                                    <!--end::Edit-->

                                                    <!--begin::Delete-->
                                                    <a href="#"
                                                        class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                                        data-bs-toggle="tooltip" title="Delete"
                                                        data-kt-customer-payment-method="delete">
                                                        <i class="ki-duotone ki-trash fs-3"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span><span class="path4"></span><span
                                                                class="path5"></span></i> </a>
                                                    <!--end::Delete-->

                                                    <!--begin::More-->
                                                    <a href="#"
                                                        class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                                        data-bs-toggle="tooltip" title="More Options"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        <i class="ki-duotone ki-setting-3 fs-3"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span><span class="path4"></span><span
                                                                class="path5"></span></i> </a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-150px py-3"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3"
                                                                data-kt-payment-mehtod-action="set_as_primary">
                                                                Set as Primary
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                    <!--end::More-->
                                                </div>
                                                <!--end::Toolbar--> --}}
                                            </div>
                                            <!--end::Header-->

                                            <!--begin::Body-->
                                            <div id="kt_membership_info_{{ $membership->id }}"
                                                class="collapse  fs-6 ps-10"
                                                data-bs-parent="#kt_customer_view_payment_method">
                                                <!--begin::Details-->
                                                <div class="d-flex flex-wrap py-5">
                                                    <!--begin::Col-->
                                                    <div class="flex-equal me-5">
                                                        <table class="table table-flush fw-semibold gy-1">
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Name & Initials
                                                                </td>
                                                                <td class="text-gray-800">
                                                                    {{ $membership->name . ' ' . $membership->initials ?? 'n/a' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Surname</td>
                                                                <td class="text-gray-800">
                                                                    {{ $membership->surname ?? 'n/a' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">ID Number</td>
                                                                <td class="text-gray-800">
                                                                    {{ $membership->id_number ?? 'n/a' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Join Date</td>
                                                                <td class="text-gray-800">
                                                                    {{ \Carbon\Carbon::parse($membership->join_date)->format('Y/m/d') ?? 'n/a' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Membership Type
                                                                </td>
                                                                <td class="text-gray-800">
                                                                    {{ $membership->type->name . ' - (' . $membership->type->description . ') - R' . number_format($membership->type->membership_fee, 2) ?? 'n/a' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Last Payment
                                                                </td>
                                                                <td class="text-gray-800">
                                                                    {{ $membership->last_payment_date ?? 'n/a' }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="flex-equal ">
                                                        <table class="table table-flush fw-semibold gy-1">
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Address</td>
                                                                <td class="text-gray-800">
                                                                    {{ $membership->addressesWithType(1)[0]->line1 ?? 'n/a' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Phone</td>
                                                                <td class="text-gray-800">
                                                                    {{ $membership->primary_contact_number ?? 'n/a' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Phone 2</td>
                                                                <td class="text-gray-800">
                                                                    {{ $membership->secondary_contact_number ?? 'n/a' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Email</td>
                                                                <td class="text-gray-800"><a href="#"
                                                                        class="text-gray-900 text-hover-primary">{{ $membership->primary_e_mail_address ?? 'n/a' }}</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Previous
                                                                    Membership</td>
                                                                <td class="text-gray-800">
                                                                    {{ $membership->previous_membership_id ?? 'n/a' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Paid Till</td>
                                                                <td class="text-gray-800">
                                                                    {{ \Carbon\Carbon::parse($membership->paid_till_date)->format('Y/m/d') ?? 'n/a' }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Option-->

                                        <div class="separator separator-dashed"></div>
                                    @endforeach



                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->

<!-- Begin Funeral Arrangement Card -->
<div id="funeral_card" class="card pt-4 mb-6 mb-xl-9">
    <!-- Begin Card Header -->
    <div class="card-header border-0">
        <!-- Begin Card Title -->
        <div class="card-title">
            <h2 class="fw-bold">Funeral Arrangement</h2>
        </div>
        <!-- End Card Title -->

        <!-- Begin Card Toolbar -->
        <div class="card-toolbar">
            <button id="externalSubmitActionOne" class="btn btn-sm btn-flex btn-light-primary">
                Save Changes
            </button>
        </div>
        <!-- End Card Toolbar -->
    </div>
    <!-- End Card Header -->

    <!-- Begin Card Body -->
    <div class="card-body pt-0">
        <form id="funeralForm" method="POST" action="{{ route('handleFuneralAction') }}">
            @csrf {{-- CSRF token for form submission --}}
            <input type="hidden" id="funeral_id" name="funeral_id" value="{{ $funeral->id ?? '' }}">
            <input type="hidden" id="person_id" name="person_id" value="{{ $deceased_person->id }}">
            <input type="hidden" id="person_name" name="person_name" value="{{ $deceased_person->first_name }}">

            <!-- Begin Accordion -->
            <div class="accordion mb-3" id="kt_accordion_funeral">
                <!-- Accordion Item for Church & Cemetery Details -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="kt_accordion_header_1">
                        <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#kt_accordion_body_1" aria-expanded="true" aria-controls="kt_accordion_body_1">
                            Church & Cemetery Details
                        </button>
                    </h2>
                    <div id="kt_accordion_body_1" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_header_1" data-bs-parent="#kt_accordion_funeral">
                        <div class="accordion-body">
                            <!-- Church Information -->
                            <h5>Church Information</h5>
                            <div class="pt-0" style="display: flex; align-items: center;">
                                <select id="churchSelect" name="churchSelect" class="form-select" data-control="select2"
                                    data-placeholder="Select Church" data-allow-clear="true" style="margin-right: 10px;">
                                    <option></option>
                                    @foreach ($churches as $church)
                                        <option value="{{ $church->id }}" {{ $funeral->church_address_id == $church->id ? 'selected' : '' }}>
                                            {{ $church->name }} ({{ $church->line1 }} - {{ $church->suburb }}, {{ $church->city }}, {{ $church->ZIP }})
                                        </option>
                                    @endforeach
                                    @if ($churches->isEmpty())
                                        <option disabled>No churches available</option>
                                    @endif
                                </select>
                            </div>

                            <div class="separator border-light my-8"></div>

                            <!-- Graveyard Information -->
                            <h5>Graveyard Information</h5>
                            <div style="display: flex; align-items: center;">
                                <select id="graveyardSelect" name="graveyardSelect" class="form-select" data-control="select2"
                                    data-placeholder="Select Cemetery" data-allow-clear="true" style="margin-right: 10px;">
                                    <option></option>
                                    @foreach ($graveyards as $graveyard)
                                        <option value="{{ $graveyard->id }}" {{ $funeral->grave_address_id == $graveyard->id ? 'selected' : '' }}>
                                            {{ $graveyard->name }} ({{ $graveyard->line1 }} - {{ $graveyard->suburb }}, {{ $graveyard->city }}, {{ $graveyard->ZIP }})
                                        </option>
                                    @endforeach
                                    @if ($graveyards->isEmpty())
                                        <option disabled>No graveyards available</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accordion Item for Funeral Details -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="kt_accordion_header_2">
                        <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#kt_accordion_body_2" aria-expanded="false" aria-controls="kt_accordion_body_2">
                            Funeral Details
                        </button>
                    </h2>
                    <div id="kt_accordion_body_2" class="accordion-collapse collapse" aria-labelledby="kt_accordion_header_2"
                        data-bs-parent="#kt_accordion_funeral">
                        <div class="accordion-body">
                            <div class="row">
                                <!-- Graveyard Information Form -->
                                <div class="card-body pt-4 p-3">
                                    <div class="container mt-5">
                                        <h4>Graveyard Information Form</h4>
                                        <!-- Row 1 -->
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="graveyard_section" class="form-label">Graveyard section:</label>
                                                <input type="text" class="form-control" id="graveyard_section" name="graveyard_section"
                                                    value="{{ $funeral->graveyard_section ?? '' }}">
                                            </div>
                                            <div class="col">
                                                <label for="grave_number" class="form-label">Grave number:</label>
                                                <input type="text" class="form-control" id="grave_number" name="grave_number"
                                                    value="{{ $funeral->grave_number ?? '' }}" required>
                                            </div>
                                        </div>

                                        <!-- Row 2 -->
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="burial_date" class="form-label">Burial Date:</label>
                                                <input type="date" class="form-control" id="burial_date" name="burial_date"
                                                    value="{{ $funeral->burial_date ? \Carbon\Carbon::parse($funeral->burial_date)->format('Y-m-d') : '' }}">
                                            </div>
                                            <div class="col">
                                                <label for="burial_time" class="form-label">Burial Time:</label>
                                                <input type="time" class="form-control" id="burial_time" name="burial_time"
                                                    value="{{ $funeral->burial_date ? \Carbon\Carbon::parse($funeral->burial_date)->format('H:i') : '' }}">
                                            </div>
                                            <div class="col">
                                                <label for="coffin" class="form-label">Coffin:</label>
                                                <input type="text" class="form-control" id="coffin" name="coffin"
                                                    value="{{ $funeral->coffin ?? '' }}">
                                            </div>
                                            <div class="col">
                                                <label for="viewing_time" class="form-label">Viewing Time:</label>
                                                <input type="datetime-local" class="form-control" id="viewing_time" name="viewing_time"
                                                    value="{{ $funeral->viewing_time ? \Carbon\Carbon::parse($funeral->viewing_time)->format('Y-m-d\TH:i') : '' }}">
                                            </div>
                                        </div>

                                        <!-- Row 2.5 -->
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="viewing_location" class="form-label">Viewing Location:</label>
                                                <div style="display: flex; align-items: center;">
                                                    <select id="viewing_location" name="viewing_location" class="form-select"
                                                        data-control="select2" data-placeholder="Select Viewing Location"
                                                        data-allow-clear="true" style="margin-right: 10px;">
                                                        <option></option>
                                                        @foreach ($viewinglocations as $viewinglocation)
                                                            <option value="{{ $viewinglocation->id }}"
                                                                {{ $funeral->viewing_address_id == $viewinglocation->id ? 'selected' : '' }}>
                                                                {{ $viewinglocation->name }} ({{ $viewinglocation->line1 }} -
                                                                {{ $viewinglocation->suburb }}, {{ $viewinglocation->city }},
                                                                {{ $viewinglocation->ZIP }})
                                                            </option>
                                                        @endforeach
                                                        @if ($viewinglocations->isEmpty())
                                                            <option disabled>No viewing locations available</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row 3 -->
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="church_office" class="form-label">Church office:</label>
                                                <input type="text" class="form-control" id="church_office" name="church_office"
                                                    value="{{ $funeral->church_office ?? '' }}">
                                            </div>
                                            <div class="col">
                                                <label for="church_caretaker" class="form-label">Church caretaker:</label>
                                                <input type="text" class="form-control" id="church_caretaker" name="church_caretaker"
                                                    value="{{ $funeral->caretaker ?? '' }}">
                                            </div>
                                        </div>

                                        <!-- Row 4 -->
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="burial_person" class="form-label">Burial person (preacher):</label>
                                                <input type="text" class="form-control" id="burial_person" name="burial_person"
                                                    value="{{ $funeral->preacher ?? '' }}">
                                            </div>
                                            <div class="col">
                                                <label for="contact_number" class="form-label">Contact Number:</label>
                                                <input type="tel" class="form-control" id="contact_number" name="contact_number"
                                                    value="{{ $funeral->contact_number ?? '' }}">
                                            </div>
                                            <div class="col">
                                                <label for="organist" class="form-label">Organist:</label>
                                                <input type="text" class="form-control" id="organist" name="organist"
                                                    value="{{ $funeral->organist ?? '' }}">
                                            </div>
                                        </div>

                                        <!-- Row 5 -->
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="funeral_notices" class="form-label">Notices:</label>
                                                <textarea class="form-control" id="funeral_notices" name="funeral_notices" rows="3">{{ $funeral->funeral_notices ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Accordion -->

            <!-- Required Alert (initially hidden) -->
            <div id="requiredAlert" class="alert alert-danger bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10"
                style="display: none !important;">
                <!-- Icon -->
                <i class="ki-duotone ki-information-5 fs-2hx text-danger me-4 mb-5 mb-sm-0">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <!-- Wrapper -->
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <!-- Title -->
                    <h4 class="fw-semibold text-danger">Incomplete Form</h4>
                    <!-- Content -->
                    <span>All Tabs Need to be completed ('Green') before you can save.</span>
                </div>
            </div>
            <!-- End Required Alert -->

            <!-- Hidden Button for Submit Action 1 -->
            <button type="submit" name="action" value="submitActionOne" style="display:none;">Save Funeral</button>
        </form>

        <!-- Action Buttons for Main Record -->
        <div class="form-group text-center d-flex justify-content-around mt-8 mb-8">
            <!-- External Button for Submit Action 1 -->
            <button id="externalSubmitActionOneCopy" class="btn btn-flex btn-light-primary">
                <i class="ki-duotone ki-send fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                Save Funeral Details
            </button>
        </div>
    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->






                        </div>
                        <!--end:::Tab pane-->

                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="funeral_costs_tab" role="tabpanel">


                            <!--begin::Card-->
                            <form id="funeralCostsForm" method="POST" action="{{ route('StoreFuneralCosts') }}">
                                @csrf {{-- CSRF token for form submission --}}

                                <div id="funeral_card" class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2 class="fw-bold">Funeral Costs | R <span
                                                    class="text-danger"id="totalCostHeader">0.00</span> </h2>
                                        </div>
                                        <!--end::Card title-->

                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <button type="submit" class="btn btn-sm btn-flex btn-light-primary">
                                                Save Changes
                                            </button>
                                        </div>
                                        <!--end::Card toolbar-->

                                    </div>
                                    <!--end::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">





                                        {{-- <div class="card-header bg-light" >
                                            <h3 class="card-title" >Main Record ID: </h3>
                                        </div> --}}


                                        <input type="text" id="person_id" name="person_id"
                                            value="{{ $deceased_person->id }}" hidden>
                                        <input type="text" id="person_name" name="person_name"
                                            value="{{ $deceased_person->first_name }}" hidden>
                                        <input type="text" id="funeral_id" name="funeral_id"
                                            value="{{ $funeral->id }}" hidden>




                                        @php
                                            use Illuminate\Support\Str;
                                        @endphp

                                        {{-- Start Cost Calculator --}}
                                        <div class="col-12 ">
                                            <h3 style="text-align: center">Cost Calculator</h3>
                                            <table id="kt_datatable_footer_callback"
                                                class="table table-row-bordered gy-5 gs-7  rounded mx-auto">
                                                <thead>
                                                    <tr class="fw-bold fs-6">
                                                        <th>Product/Service</th>
                                                        <th>Amount ( R <span class="text-danger"
                                                                id="totalCost2">0.00</span> )</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="funeral-costs-table-body">
                                                    @foreach ($funeral_costs as $cost)
                                                    <tr>
                                                        <td>{{ $cost->name }}</td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-text">R</span>
                                                                <input type="number" class="form-control cost-input"
                                                                    id="fc_{{ Str::slug($cost->name, '_') }}"
                                                                    name="costs[{{ $cost->id }}]"
                                                                    value="{{ $cost->transactions->sum('transaction.transaction_local_value') ?? 0 }}"
                                                                    oninput="calculateTotal()">
                                                                <input type="hidden" name="cost_names[{{ $cost->id }}]" value="{{ $cost->name }}">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="2">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal" data-bs-target="#addCostModal">
                                                                <i class="ki-duotone ki-plus-square fs-3"><span class="path1"></span><span
                                                                    class="path2"></span><span class="path3"></span></i>
                                                                Add Another Cost</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot style="background-color: #f7f7f7">
                                                    <tr class="fw-bold fs-6">
                                                        <th colspan="1" class="text-nowrap align-end">Total:</th>
                                                        <th colspan="1" class="text-danger fs-3">R<span
                                                                id="totalCost">0.00</span></th>
                                                    </tr>
                                                   
                                                </tfoot>
                                            </table>
                                        </div>
                                        {{-- End Cost Calculator --}}












                                    </div>
                                    <!--end::Card body-->
                                </div>
                            </form>
                            <!--end::Card-->

                            <!--begin:::Add Costs modal-->

                            <div class="modal fade" id="addCostModal" tabindex="-1" aria-labelledby="addCostModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addCostModalLabel">Add New Cost</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addCostForm">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="newCostName" class="form-label">Cost Name</label>
                                                    <input type="text" class="form-control" id="newCostName" name="name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="newCostDescription" class="form-label">Cost Description</label>
                                                    <input type="text" class="form-control" id="newCostDescription" name="description">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="addCostButton">Add Cost</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <!--end:::Add Costs modal-->


                        </div>
                        <!--end:::Tab pane-->

                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="shortfalls_and_payouts_tab" role="tabpanel">





                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="fw-bold">Available Balance</h2>
                                    </div>
                                    <!--end::Card title-->

                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <a href="#" class="btn btn-sm btn-flex btn-light-primary"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_adjust_balance">
                                            <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span
                                                    class="path2"></span></i> Adjust Balance
                                        </a>
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">

                                    <!--begin::Countup Section-->
                                    {{-- <div class="d-flex flex-wrap flex-center mt-4 mb-5">
                                        <!--begin::Row-->
                                        <div class="d-flex flex-wrap ">
                                            <!--begin::Col-->
                                            <div
                                                class="border border-dashed border-gray-300 w-150px rounded my-3 p-4 me-6">
                                                <span class="fs-1 fw-bold text-gray-800 lh-1">
                                                    <span data-kt-countup="true" data-kt-countup-value="6,840"
                                                        data-kt-countup-prefix="R">0</span>
                                                    <i class="ki-duotone ki-arrow-up fs-1 text-success"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                </span>
                                                <span class="fs-6 fw-semibold text-muted d-block lh-1 pt-2">Membership
                                                    1</span>
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div
                                                class="border border-dashed border-gray-300 w-125px rounded my-3 p-4 me-6">
                                                <span class="fs-1 fw-bold text-gray-800 lh-1">
                                                    <span class="" data-kt-countup="true"
                                                        data-kt-countup-value="16">0</span>%
                                                    <i class="ki-duotone ki-arrow-down fs-1 text-danger"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                </span>
                                                <span class="fs-6 fw-semibold text-muted d-block lh-1 pt-2">Membership
                                                    2</span>
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div
                                                class="border border-dashed border-gray-300 w-150px rounded my-3 p-4 me-6">
                                                <span class="fs-1 fw-bold text-gray-800 lh-1">
                                                    <span data-kt-countup="true" data-kt-countup-value="1,240"
                                                        data-kt-countup-prefix="R">0</span>
                                                    <span class="text-primary">--</span>
                                                </span>
                                                <span class="fs-6 fw-semibold text-muted d-block lh-1 pt-2">Membership
                                                    3</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->


                                    </div> --}}
                                    <!--end::Countup Section-->



                                    <div class="fw-bold fs-2">
                                        R3,487.50 <span class="text-muted fs-4 fw-semibold">ZAR</span>
                                        <div class="fs-7 fw-normal text-muted">The amount of money from all active memberships, allocated to the funeral.</div>
                                    </div>







                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->


<!--begin::Card-->
<div id="shortfall_card" class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title">
            <h2 class="fw-bold">Shortfall Transactions</h2>
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <a href="#" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_payment">
                <i class="ki-duotone ki-plus fs-3"><span class="path1"></span><span class="path2"></span></i> New Payment
            </a>
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

<!--begin::Card body-->
<div class="card-body pt-0">
    <table id="" class="table table-striped table-row-bordered gy-5 gs-7 border rounded mx-auto">
        <thead>
            <tr class="fw-bold fs-6">
                <th>Details</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Time of Payment</th>
                <th>Membership</th>
                <th>Ref. #</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shortfall_transactions as $transaction)
            <tr>
                <td>{{ $transaction->transaction->transaction_description }}</td>
                <td>R{{ $transaction->transaction->transaction_local_value }}</td>
                <td>{{ $transaction->transaction->paymentMethod->name ?? 'N/A' }}</td>
                <td>{{ $transaction->transaction->transaction_date ?? 'N/A' }}</td>
                <td>{{ $transaction->transaction->membership->membership_code ?? 'N/A' }}</td>
                <td>{{ $transaction->transaction->transaction_document_reference ?? 'N/A' }}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-icon btn-dark "
                        data-bs-toggle="modal" data-bs-target="#kt_modal_payment"
                        data-transaction-id="{{ $transaction->transaction->id }}"
                        data-name="{{ $transaction->transaction->transaction_description }}"
                        data-reference="{{ $transaction->transaction->transaction_document_reference }}"
                        data-amount="{{ $transaction->transaction->transaction_local_value }}"
                        data-payment-method-id="{{ $transaction->transaction->payment_method_id }}"
                        data-time-of-payment="{{ $transaction->transaction->transaction_date }}"
                        data-membership-id="{{ $transaction->transaction->membership_id }}">
                        <i class="bi bi-pencil-fill me-0"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-danger "
                        data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                        data-transaction-id="{{ $transaction->transaction->id }}"
                        data-type="shortfall">
                        <i class="bi bi-trash3 fs-4 me-0"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!--end::Card body-->

</div>
<!--end::Card-->





                            <!--begin::Card-->
                            <div id="payouts_card" class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="fw-bold">Payouts</h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <a href="#" class="btn btn-sm btn-flex btn-light-primary"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_beneficiary"
                                            data-location-type="Postal">
                                            <i class="ki-duotone ki-plus fs-3"><span class="path1"></span><span
                                                    class="path2"></span></i> New Beneficiary
                                        </a>
                                    </div>
                                    <!--end::Card toolbar-->

                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">




                                    {{-- @if (!$item['']->isEmpty()) --}}





<!-- Start Payouts -->
<table id="" class="table table-striped table-row-bordered gy-5 gs-7 border rounded mx-auto">
    <thead>
        <tr class="fw-bold fs-6">
            <th>Beneficiary</th>
            <th>Amount</th>
            <th>Beneficiary - Postal Address</th>
            <th>Cash</th>
            <th>Account Number</th>
            <th>Bank</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($funeral_payouts as $payout)
        <tr>
            <td>
                {{ $payout->person->first_name }} {{ $payout->person->last_name }}
            </td>
            <td>
                {{ $payout->transaction_local_value }}
            </td>
            <td>
                {{ $payout->address->line1 }}</br>
                {{ $payout->address->suburb }} </br>
                {{ $payout->address->city }} </br>
                {{ $payout->address->ZIP }}
            </td>
            <td>
                {{ $payout->cash_payout === 1 ? 'Yes' : 'No' }}
            </td>
            <td>
                {{ $payout->person->bankDetails->account_number ?? '' }}
            </td>
            <td>
                {{ $payout->person->bankDetails->bank->name ?? '' }}
            </td>
            <td class="align-middle">
                <button type="button" class="btn btn-sm btn-icon btn-dark "
                    data-bs-toggle="modal" data-bs-target="#kt_modal_beneficiary"
                    data-beneficiary-id="{{ $payout->person->id }}"
                    data-beneficiary-name="{{ $payout->person->first_name }}"
                    data-beneficiary-surname="{{ $payout->person->last_name }}"
                    data-transaction-id="{{ $payout->funeralHasTransactions->transactions_id }}"
                    data-payout-amount="{{ $payout->transaction_local_value }}"
                    data-address-type-id="{{ $payout->address->addressType->id }}"
                    data-line1="{{ $payout->address->line1 }}"
                    data-line2="{{ $payout->address->district }}"
                    data-townsuburb="{{ $payout->address->suburb }}"
                    data-city="{{ $payout->address->city }}"
                    data-province="{{ $payout->address->province }}"
                    data-postalcode="{{ $payout->address->ZIP }}"
                    data-country-name="{{ $payout->address->country->name }}"
                    data-payout-acc-number="{{ $payout->person->bankDetails->account_number ?? '' }}"
                    data-bank-id="{{ $payout->person->bankDetails->bank_id ?? '' }}"
                    data-universal-branch-code="{{ $payout->person->bankDetails->universal_branch_code ?? '' }}"
                    data-bank-account-type-id="{{ $payout->person->bankDetails->bank_account_type_id ?? '' }}">
                    <i class="bi bi-pencil-fill me-0"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-danger "
                    data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                    data-transaction-id="{{ $payout->funeralHasTransactions->transactions_id }}"
                    data-beneficiary-id="{{ $payout->person->id }}"
                    data-funeral-id="{{ $payout->funeral_id }}"
                    data-type="beneficiary">
                    <i class="bi bi-trash3 fs-4 me-0"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- End Payouts -->


                                    {{-- @else
                                                        <div class="card inner-card border border-secondary mt-4">
                                                            <div class="card-header"style="background-color: #448C74;">
                                                                <h3 class="card-title" style="color: white">Title</h3>
                                                            </div>
                                                            <div class="card-body bg-light">
                                                                <p>No records found.</p>
                                                            </div>
                                                        </div>
                                                    @endif --}}





                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->


                        </div>
                        <!--end:::Tab pane-->
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="others_tab" role="tabpanel">

                            <!--begin::Statements-->
                            <div class="card mb-6 mb-xl-9">
                                <!--begin::Header-->
                                <div class="card-header">
                                    <!--begin::Title-->
                                    <div class="card-title">
                                        <h2>Statement</h2>
                                    </div>
                                    <!--end::Title-->

                                    <!--begin::Toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Tab nav-->
                                        <ul class="nav nav-stretch fs-5 fw-semibold nav-line-tabs nav-line-tabs-2x border-transparent"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link text-active-primary active" data-bs-toggle="tab"
                                                    role="tab" href="#kt_customer_view_statement_1">
                                                    This Year
                                                </a>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link text-active-primary ms-3" data-bs-toggle="tab"
                                                    role="tab" href="#kt_customer_view_statement_2">
                                                    2020
                                                </a>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link text-active-primary ms-3" data-bs-toggle="tab"
                                                    role="tab" href="#kt_customer_view_statement_3">
                                                    2019
                                                </a>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link text-active-primary ms-3" data-bs-toggle="tab"
                                                    role="tab" href="#kt_customer_view_statement_4">
                                                    2018
                                                </a>
                                            </li>
                                        </ul>
                                        <!--end::Tab nav-->
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Header-->

                                <!--begin::Card body-->
                                <div class="card-body pb-5">
                                    <!--begin::Tab Content-->
                                    <div id="kt_customer_view_statement_tab_content" class="tab-content">
                                        <!--begin::Tab panel-->
                                        <div id="kt_customer_view_statement_1" class="py-0 tab-pane fade show active"
                                            role="tabpanel">
                                            <!--begin::Table-->
                                            <table id="kt_customer_view_statement_table_1"
                                                class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-4">
                                                <thead class="border-bottom border-gray-200">
                                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="w-125px">Date</th>
                                                        <th class="w-100px">Order ID</th>
                                                        <th class="w-300px">Details</th>
                                                        <th class="w-100px">Amount</th>
                                                        <th class="w-100px text-end pe-7">Invoice</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Nov 01, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">102445788</a>
                                                        </td>
                                                        <td>Darknight transparency 36 Icons Pack</td>
                                                        <td class="text-success">$38.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 24, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">423445721</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-2.60</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 08, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Cartoon Mobile Emoji Phone Pack</td>
                                                        <td class="text-success">$76.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sep 15, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                        <td class="text-success">$5.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>May 30, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">523445943</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-1.30</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Apr 22, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">231445943</a>
                                                        </td>
                                                        <td>Parcel Shipping / Delivery Service App</td>
                                                        <td class="text-success">$204.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Feb 09, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">426445943</a>
                                                        </td>
                                                        <td>Visual Design Illustration</td>
                                                        <td class="text-success">$31.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">984445943</a>
                                                        </td>
                                                        <td>Abstract Vusial Pack</td>
                                                        <td class="text-success">$52.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 04, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">324442313</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-0.80</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">102445788</a>
                                                        </td>
                                                        <td>Darknight transparency 36 Icons Pack</td>
                                                        <td class="text-success">$38.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 24, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">423445721</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-2.60</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 08, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Cartoon Mobile Emoji Phone Pack</td>
                                                        <td class="text-success">$76.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sep 15, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                        <td class="text-success">$5.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>May 30, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">523445943</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-1.30</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Apr 22, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">231445943</a>
                                                        </td>
                                                        <td>Parcel Shipping / Delivery Service App</td>
                                                        <td class="text-success">$204.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Feb 09, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">426445943</a>
                                                        </td>
                                                        <td>Visual Design Illustration</td>
                                                        <td class="text-success">$31.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">984445943</a>
                                                        </td>
                                                        <td>Abstract Vusial Pack</td>
                                                        <td class="text-success">$52.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 04, 2021</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">324442313</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-0.80</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Tab panel-->
                                        <!--begin::Tab panel-->
                                        <div id="kt_customer_view_statement_2" class="py-0 tab-pane fade "
                                            role="tabpanel">
                                            <!--begin::Table-->
                                            <table id="kt_customer_view_statement_table_2"
                                                class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-4">
                                                <thead class="border-bottom border-gray-200">
                                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="w-125px">Date</th>
                                                        <th class="w-100px">Order ID</th>
                                                        <th class="w-300px">Details</th>
                                                        <th class="w-100px">Amount</th>
                                                        <th class="w-100px text-end pe-7">Invoice</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>May 30, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">523445943</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-1.30</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Apr 22, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">231445943</a>
                                                        </td>
                                                        <td>Parcel Shipping / Delivery Service App</td>
                                                        <td class="text-success">$204.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Feb 09, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">426445943</a>
                                                        </td>
                                                        <td>Visual Design Illustration</td>
                                                        <td class="text-success">$31.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">984445943</a>
                                                        </td>
                                                        <td>Abstract Vusial Pack</td>
                                                        <td class="text-success">$52.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 04, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">324442313</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-0.80</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">102445788</a>
                                                        </td>
                                                        <td>Darknight transparency 36 Icons Pack</td>
                                                        <td class="text-success">$38.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 24, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">423445721</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-2.60</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 08, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Cartoon Mobile Emoji Phone Pack</td>
                                                        <td class="text-success">$76.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sep 15, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                        <td class="text-success">$5.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>May 30, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">523445943</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-1.30</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Apr 22, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">231445943</a>
                                                        </td>
                                                        <td>Parcel Shipping / Delivery Service App</td>
                                                        <td class="text-success">$204.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Feb 09, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">426445943</a>
                                                        </td>
                                                        <td>Visual Design Illustration</td>
                                                        <td class="text-success">$31.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">984445943</a>
                                                        </td>
                                                        <td>Abstract Vusial Pack</td>
                                                        <td class="text-success">$52.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 04, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">324442313</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-0.80</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">102445788</a>
                                                        </td>
                                                        <td>Darknight transparency 36 Icons Pack</td>
                                                        <td class="text-success">$38.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 24, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">423445721</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-2.60</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 08, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Cartoon Mobile Emoji Phone Pack</td>
                                                        <td class="text-success">$76.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sep 15, 2020</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                        <td class="text-success">$5.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Tab panel-->
                                        <!--begin::Tab panel-->
                                        <div id="kt_customer_view_statement_3" class="py-0 tab-pane fade "
                                            role="tabpanel">
                                            <!--begin::Table-->
                                            <table id="kt_customer_view_statement_table_3"
                                                class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-4">
                                                <thead class="border-bottom border-gray-200">
                                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="w-125px">Date</th>
                                                        <th class="w-100px">Order ID</th>
                                                        <th class="w-300px">Details</th>
                                                        <th class="w-100px">Amount</th>
                                                        <th class="w-100px text-end pe-7">Invoice</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Feb 09, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">426445943</a>
                                                        </td>
                                                        <td>Visual Design Illustration</td>
                                                        <td class="text-success">$31.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">984445943</a>
                                                        </td>
                                                        <td>Abstract Vusial Pack</td>
                                                        <td class="text-success">$52.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 04, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">324442313</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-0.80</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sep 15, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                        <td class="text-success">$5.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">102445788</a>
                                                        </td>
                                                        <td>Darknight transparency 36 Icons Pack</td>
                                                        <td class="text-success">$38.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 24, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">423445721</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-2.60</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 08, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Cartoon Mobile Emoji Phone Pack</td>
                                                        <td class="text-success">$76.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>May 30, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">523445943</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-1.30</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Apr 22, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">231445943</a>
                                                        </td>
                                                        <td>Parcel Shipping / Delivery Service App</td>
                                                        <td class="text-success">$204.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Feb 09, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">426445943</a>
                                                        </td>
                                                        <td>Visual Design Illustration</td>
                                                        <td class="text-success">$31.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">984445943</a>
                                                        </td>
                                                        <td>Abstract Vusial Pack</td>
                                                        <td class="text-success">$52.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 04, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">324442313</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-0.80</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sep 15, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                        <td class="text-success">$5.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">102445788</a>
                                                        </td>
                                                        <td>Darknight transparency 36 Icons Pack</td>
                                                        <td class="text-success">$38.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 24, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">423445721</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-2.60</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 08, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Cartoon Mobile Emoji Phone Pack</td>
                                                        <td class="text-success">$76.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>May 30, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">523445943</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-1.30</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Apr 22, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">231445943</a>
                                                        </td>
                                                        <td>Parcel Shipping / Delivery Service App</td>
                                                        <td class="text-success">$204.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Tab panel-->
                                        <!--begin::Tab panel-->
                                        <div id="kt_customer_view_statement_4" class="py-0 tab-pane fade "
                                            role="tabpanel">
                                            <!--begin::Table-->
                                            <table id="kt_customer_view_statement_table_4"
                                                class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-4">
                                                <thead class="border-bottom border-gray-200">
                                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="w-125px">Date</th>
                                                        <th class="w-100px">Order ID</th>
                                                        <th class="w-300px">Details</th>
                                                        <th class="w-100px">Amount</th>
                                                        <th class="w-100px text-end pe-7">Invoice</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Nov 01, 2018</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">102445788</a>
                                                        </td>
                                                        <td>Darknight transparency 36 Icons Pack</td>
                                                        <td class="text-success">$38.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 24, 2018</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">423445721</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-2.60</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2018</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">102445788</a>
                                                        </td>
                                                        <td>Darknight transparency 36 Icons Pack</td>
                                                        <td class="text-success">$38.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 24, 2018</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">423445721</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-2.60</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Feb 09, 2018</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">426445943</a>
                                                        </td>
                                                        <td>Visual Design Illustration</td>
                                                        <td class="text-success">$31.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2018</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">984445943</a>
                                                        </td>
                                                        <td>Abstract Vusial Pack</td>
                                                        <td class="text-success">$52.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 04, 2018</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">324442313</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-0.80</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 08, 2018</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Cartoon Mobile Emoji Phone Pack</td>
                                                        <td class="text-success">$76.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 08, 2018</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Cartoon Mobile Emoji Phone Pack</td>
                                                        <td class="text-success">$76.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Feb 09, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">426445943</a>
                                                        </td>
                                                        <td>Visual Design Illustration</td>
                                                        <td class="text-success">$31.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">984445943</a>
                                                        </td>
                                                        <td>Abstract Vusial Pack</td>
                                                        <td class="text-success">$52.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 04, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">324442313</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-0.80</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sep 15, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                        <td class="text-success">$5.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nov 01, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">102445788</a>
                                                        </td>
                                                        <td>Darknight transparency 36 Icons Pack</td>
                                                        <td class="text-success">$38.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 24, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">423445721</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-2.60</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Oct 08, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">312445984</a>
                                                        </td>
                                                        <td>Cartoon Mobile Emoji Phone Pack</td>
                                                        <td class="text-success">$76.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>May 30, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">523445943</a>
                                                        </td>
                                                        <td>Seller Fee</td>
                                                        <td class="text-danger">$-1.30</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Apr 22, 2019</td>
                                                        <td><a href="#"
                                                                class="text-gray-600 text-hover-primary">231445943</a>
                                                        </td>
                                                        <td>Parcel Shipping / Delivery Service App</td>
                                                        <td class="text-success">$204.00</td>
                                                        <td class="text-end"><button
                                                                class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Tab panel-->
                                    </div>
                                    <!--end::Tab Content-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Statements-->

                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Logs</h2>
                                    </div>
                                    <!--end::Card title-->

                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-sm btn-light-primary">
                                            <i class="ki-duotone ki-cloud-download fs-3"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            Download Report
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body py-0">
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table
                                            class="table align-middle table-row-dashed fw-semibold text-gray-600 fs-6 gy-5"
                                            id="kt_table_customers_logs">
                                            <tbody>
                                                <tr>
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-success">200 OK</div>
                                                    </td>
                                                    <td>
                                                        POST /v1/invoices/in_1093_7458/payment </td>
                                                    <td class="pe-0 text-end min-w-200px">
                                                        05 May 2024, 10:10 pm </td>
                                                </tr>
                                                <tr>
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-warning">404 WRN</div>
                                                    </td>
                                                    <td>
                                                        POST /v1/customer/c_6687f5279a9d5/not_found </td>
                                                    <td class="pe-0 text-end min-w-200px">
                                                        05 May 2024, 5:20 pm </td>
                                                </tr>
                                                <tr>
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-success">200 OK</div>
                                                    </td>
                                                    <td>
                                                        POST /v1/invoices/in_1093_7458/payment </td>
                                                    <td class="pe-0 text-end min-w-200px">
                                                        20 Dec 2024, 10:30 am </td>
                                                </tr>
                                                <tr>
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-danger">500 ERR</div>
                                                    </td>
                                                    <td>
                                                        POST /v1/invoice/in_5324_1715/invalid </td>
                                                    <td class="pe-0 text-end min-w-200px">
                                                        10 Nov 2024, 10:30 am </td>
                                                </tr>
                                                <tr>
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-success">200 OK</div>
                                                    </td>
                                                    <td>
                                                        POST /v1/invoices/in_4645_4860/payment </td>
                                                    <td class="pe-0 text-end min-w-200px">
                                                        20 Dec 2024, 6:43 am </td>
                                                </tr>
                                                <tr>
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-success">200 OK</div>
                                                    </td>
                                                    <td>
                                                        POST /v1/invoices/in_7984_6335/payment </td>
                                                    <td class="pe-0 text-end min-w-200px">
                                                        15 Apr 2024, 10:30 am </td>
                                                </tr>
                                                <tr>
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-danger">500 ERR</div>
                                                    </td>
                                                    <td>
                                                        POST /v1/invoice/in_5458_5829/invalid </td>
                                                    <td class="pe-0 text-end min-w-200px">
                                                        19 Aug 2024, 11:30 am </td>
                                                </tr>
                                                <tr>
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-success">200 OK</div>
                                                    </td>
                                                    <td>
                                                        POST /v1/invoices/in_4645_4860/payment </td>
                                                    <td class="pe-0 text-end min-w-200px">
                                                        10 Mar 2024, 8:43 pm </td>
                                                </tr>
                                                <tr>
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-success">200 OK</div>
                                                    </td>
                                                    <td>
                                                        POST /v1/invoices/in_7984_6335/payment </td>
                                                    <td class="pe-0 text-end min-w-200px">
                                                        25 Jul 2024, 11:30 am </td>
                                                </tr>
                                                <tr>
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-danger">500 ERR</div>
                                                    </td>
                                                    <td>
                                                        POST /v1/invoice/in_5037_4076/invalid </td>
                                                    <td class="pe-0 text-end min-w-200px">
                                                        20 Jun 2024, 5:20 pm </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->



                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Events</h2>
                                    </div>
                                    <!--end::Card title-->

                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-sm btn-light-primary">
                                            <i class="ki-duotone ki-cloud-download fs-3"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            Download Report
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body py-0">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-5"
                                        id="kt_table_customers_events">
                                        <tbody>
                                            <tr>
                                                <td class="min-w-400px">
                                                    <a href="#" class="text-gray-600 text-hover-primary me-1">Sean
                                                        Bean</a> has made payment to <a href="#"
                                                        class="fw-bold text-gray-900 text-hover-primary">#XRS-45670</a>
                                                </td>
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">
                                                    25 Jul 2024, 9:23 pm </td>
                                            </tr>
                                            <tr>
                                                <td class="min-w-400px">
                                                    <a href="#" class="text-gray-600 text-hover-primary me-1">Sean
                                                        Bean</a> has made payment to <a href="#"
                                                        class="fw-bold text-gray-900 text-hover-primary">#XRS-45670</a>
                                                </td>
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">
                                                    22 Sep 2024, 8:43 pm </td>
                                            </tr>
                                            <tr>
                                                <td class="min-w-400px">
                                                    <a href="#" class="text-gray-600 text-hover-primary me-1">Max
                                                        Smith</a> has made payment to <a href="#"
                                                        class="fw-bold text-gray-900 text-hover-primary">#SDK-45670</a>
                                                </td>
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">
                                                    19 Aug 2024, 10:30 am </td>
                                            </tr>
                                            <tr>
                                                <td class="min-w-400px">
                                                    Invoice <a href="#"
                                                        class="fw-bold text-gray-900 text-hover-primary me-1">#DER-45645</a>
                                                    status has changed from <span class="badge badge-light-info me-1">In
                                                        Progress</span> to <span class="badge badge-light-primary">In
                                                        Transit</span>
                                                </td>
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">
                                                    10 Mar 2024, 6:05 pm </td>
                                            </tr>
                                            <tr>
                                                <td class="min-w-400px">
                                                    <a href="#" class="text-gray-600 text-hover-primary me-1">Sean
                                                        Bean</a> has made payment to <a href="#"
                                                        class="fw-bold text-gray-900 text-hover-primary">#XRS-45670</a>
                                                </td>
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">
                                                    24 Jun 2024, 2:40 pm </td>
                                            </tr>
                                            <tr>
                                                <td class="min-w-400px">
                                                    <a href="#" class="text-gray-600 text-hover-primary me-1">Emma
                                                        Smith</a> has made payment to <a href="#"
                                                        class="fw-bold text-gray-900 text-hover-primary">#XRS-45670</a>
                                                </td>
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">
                                                    19 Aug 2024, 6:05 pm </td>
                                            </tr>
                                            <tr>
                                                <td class="min-w-400px">
                                                    <a href="#" class="text-gray-600 text-hover-primary me-1">Max
                                                        Smith</a> has made payment to <a href="#"
                                                        class="fw-bold text-gray-900 text-hover-primary">#SDK-45670</a>
                                                </td>
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">
                                                    15 Apr 2024, 6:05 pm </td>
                                            </tr>
                                            <tr>
                                                <td class="min-w-400px">
                                                    Invoice <a href="#"
                                                        class="fw-bold text-gray-900 text-hover-primary me-1">#WER-45670</a>
                                                    is <span class="badge badge-light-info">In Progress</span>
                                                </td>
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">
                                                    20 Jun 2024, 6:05 pm </td>
                                            </tr>
                                            <tr>
                                                <td class="min-w-400px">
                                                    Invoice <a href="#"
                                                        class="fw-bold text-gray-900 text-hover-primary me-1">#SEP-45656</a>
                                                    status has changed from <span
                                                        class="badge badge-light-warning me-1">Pending</span> to <span
                                                        class="badge badge-light-info">In Progress</span>
                                                </td>
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">
                                                    20 Dec 2024, 6:05 pm </td>
                                            </tr>
                                            <tr>
                                                <td class="min-w-400px">
                                                    <a href="#" class="text-gray-600 text-hover-primary me-1">Max
                                                        Smith</a> has made payment to <a href="#"
                                                        class="fw-bold text-gray-900 text-hover-primary">#SDK-45670</a>
                                                </td>
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">
                                                    15 Apr 2024, 10:30 am </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->


                        </div>
                        <!--end:::Tab pane-->
                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->

            <!--begin::Modals-->
            <!--begin::Modal - Add Checklist-->
            <div class="modal fade" id="add_checklist_item_modal" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Add Checklist Item</h2>
                            <!--end::Modal title-->

                            <!--begin::Close-->
                            <div id="add_checklist_item_modal_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->

                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Form-->
                            <form id="add_checklist_item_modal_form" class="form" action="#">
                                @csrf
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Item Name</span>

                                        <span class="ms-2" data-bs-toggle="tooltip"
                                            title="The name must be unique">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i> </span>
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="name" name="name"
                                        value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-semibold form-label mb-2">Required/Optional</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <select class="form-select form-select-solid fw-bold" id="required" name="required"
                                        data-control="select2" data-placeholder="Select an option"
                                        data-hide-search="true">
                                        <option></option>
                                        <option value="0">Optional</option>
                                        <option value="1">Required</option>
                                 
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                     

                                <!--begin::Input group-->
                                <div class="fv-row mb-15">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Additional Information</span>

                                        <span class="ms-2" data-bs-toggle="tooltip"
                                            title="Information such as description.">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i> </span>
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-solid rounded-3" id="description" name="description"></textarea>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="reset" id="add_checklist_item_modal_cancel"
                                        class="btn btn-light me-3">
                                        Discard
                                    </button>

                                    <button type="submit" id="add_checklist_item_modal_submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - New Card-->
            
            
            <!--begin::Modal - Adjust Balance-->
            <div class="modal fade" id="kt_modal_adjust_balance" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Adjust Balance</h2>
                            <!--end::Modal title-->

                            <!--begin::Close-->
                            <div id="kt_modal_adjust_balance_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->

                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Balance preview-->
                            <div class="d-flex text-center mb-9">
                                <div class="w-50 border border-dashed border-gray-300 rounded mx-2 p-4">
                                    <div class="fs-6 fw-semibold mb-2 text-muted">Current Balance</div>
                                    <div class="fs-2 fw-bold" kt-modal-adjust-balance="current_balance">US$ 32,487.57
                                    </div>
                                </div>
                                <div class="w-50 border border-dashed border-gray-300 rounded mx-2 p-4">
                                    <div class="fs-6 fw-semibold mb-2 text-muted">
                                        New Balance

                                        <span class="ms-2" data-bs-toggle="tooltip"
                                            title="Enter an amount to preview the new balance.">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i> </span>
                                    </div>
                                    <div class="fs-2 fw-bold" kt-modal-adjust-balance="new_balance">--</div>
                                </div>
                            </div>
                            <!--end::Balance preview-->

                            <!--begin::Form-->
                            <form id="kt_modal_adjust_balance_form" class="form" action="#">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-semibold form-label mb-2">Adjustment type</label>
                                    <!--end::Label-->

                                    <!--begin::Dropdown-->
                                    <select class="form-select form-select-solid fw-bold" name="adjustment"
                                        aria-label="Select an option" data-control="select2"
                                        data-dropdown-parent="#kt_modal_adjust_balance"
                                        data-placeholder="Select an option" data-hide-search="true">
                                        <option></option>
                                        <option value="1">Credit</option>
                                        <option value="2">Debit</option>
                                    </select>
                                    <!--end::Dropdown-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-semibold form-label mb-2">Amount</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input id="kt_modal_inputmask" type="text"
                                        class="form-control form-control-solid" name="amount" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">Add adjustment note</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-solid rounded-3 mb-5"></textarea>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Disclaimer-->
                                <div class="fs-7 text-muted mb-15">
                                    Please be aware that all manual balance changes will be audited by the financial team
                                    every fortnight. Please maintain your invoices and receipts until then. Thank you.
                                </div>
                                <!--end::Disclaimer-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="reset" id="kt_modal_adjust_balance_cancel"
                                        class="btn btn-light me-3">
                                        Discard
                                    </button>

                                    <button type="submit" id="kt_modal_adjust_balance_submit"
                                        class="btn btn-primary">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - New Card-->

            <!--begin::Modal - New Address-->
            <div class="modal fade" id="kt_modal_update_customer" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Form-->
                        <form class="form" action="#" id="kt_modal_update_customer_form">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_update_customer_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Update Customer</h2>
                                <!--end::Modal title-->

                                <!--begin::Close-->
                                <div id="kt_modal_update_customer_close"
                                    class="btn btn-icon btn-sm btn-active-icon-primary">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->

                            <!--begin::Modal body-->
                            <div class="modal-body py-10 px-lg-17">
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_customer_scroll"
                                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                    data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_modal_update_customer_header"
                                    data-kt-scroll-wrappers="#kt_modal_update_customer_scroll"
                                    data-kt-scroll-offset="300px">
                                    <!--begin::Notice-->

                                    <!--begin::Notice-->
                                    <div
                                        class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-information fs-2tx text-primary me-4"><span
                                                class="path1"></span><span class="path2"></span><span
                                                class="path3"></span></i> <!--end::Icon-->

                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1 ">
                                            <!--begin::Content-->
                                            <div class=" fw-semibold">

                                                <div class="fs-6 text-gray-700 ">Updating customer details will receive a
                                                    privacy audit. For more info, please read our <a
                                                        href="#">Privacy Policy</a></div>
                                            </div>
                                            <!--end::Content-->

                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice-->
                                    <!--end::Notice-->

                                    <!--begin::User toggle-->
                                    <div class="fw-bold fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                                        href="#kt_modal_update_customer_user_info" role="button"
                                        aria-expanded="false" aria-controls="kt_modal_update_customer_user_info">
                                        User Information
                                        <span class="ms-2 rotate-180">
                                            <i class="ki-duotone ki-down fs-3"></i> </span>
                                    </div>
                                    <!--end::User toggle-->

                                    <!--begin::User form-->
                                    <div id="kt_modal_update_customer_user_info" class="collapse show">
                                        <!--begin::Input group-->
                                        <div class="mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">
                                                <span>Update Avatar</span>

                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Allowed file types: png, jpg, jpeg.">
                                                    <i class="ki-duotone ki-information fs-7"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span></i> </span>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Image input wrapper-->
                                            <div class="mt-1">
                                                <!--begin::Image input-->
                                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                                    style="background-image: url('/metronic8/demo15/assets/media/svg/avatars/blank.svg')">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-125px h-125px"
                                                        style="background-image: url(/metronic8/demo15/assets/media/avatars/300-1.jpg)">
                                                    </div>
                                                    <!--end::Preview existing avatar-->

                                                    <!--begin::Edit-->
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change avatar">
                                                        <i class="ki-duotone ki-pencil fs-7"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="avatar"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="avatar_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Edit-->

                                                    <!--begin::Cancel-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="ki-duotone ki-cross fs-2"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </span>
                                                    <!--end::Cancel-->

                                                    <!--begin::Remove-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <i class="ki-duotone ki-cross fs-2"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->
                                            </div>
                                            <!--end::Image input wrapper-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Name</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="" name="name" value="Sean Bean" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">
                                                <span>Email</span>

                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Email address must be active">
                                                    <i class="ki-duotone ki-information fs-7"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span></i> </span>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="email" class="form-control form-control-solid"
                                                placeholder="" name="email" value="sean@dellito.com" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-15">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Description</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="" name="description" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::User form-->

                                    <!--begin::Billing toggle-->
                                    <div class="fw-bold fs-3 rotate collapsible collapsed mb-7"
                                        data-bs-toggle="collapse" href="#kt_modal_update_customer_billing_info"
                                        role="button" aria-expanded="false"
                                        aria-controls="kt_modal_update_customer_billing_info">
                                        Shipping Information
                                        <span class="ms-2 rotate-180">
                                            <i class="ki-duotone ki-down fs-3"></i> </span>
                                    </div>
                                    <!--end::Billing toggle-->

                                    <!--begin::Billing form-->
                                    <div id="kt_modal_update_customer_billing_info" class="collapse">
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Address Line 1</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder=""
                                                name="address1" value="101, Collins Street" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Address Line 2</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder=""
                                                name="address2" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Town</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder=""
                                                name="city" value="Melbourne" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row g-9 mb-7">
                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">State / Province</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="state" value="Victoria" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Post Code</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="postcode" value="3000" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">
                                                <span>Country</span>

                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Country of origination">
                                                    <i class="ki-duotone ki-information fs-7"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span></i> </span>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <select name="country" aria-label="Select a Country"
                                                data-control="select2" data-placeholder="Select a Country..."
                                                data-dropdown-parent="#kt_modal_update_customer"
                                                class="form-select form-select-solid fw-bold">
                                                <option value="">Select a Country...</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AX">Aland Islands</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia, Plurinational State of</option>
                                                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="BN">Brunei Darussalam</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="CI">Côte d'Ivoire</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CW">Curaçao</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="FK">Falkland Islands (Malvinas)</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GU">Guam</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GG">Guernsey</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="HT">Haiti</option>
                                                <option value="VA">Holy See (Vatican City State)</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IR">Iran, Islamic Republic of</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IM">Isle of Man</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JE">Jersey</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KP">Korea, Democratic People's Republic of</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LA">Lao People's Democratic Republic</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MO">Macao</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia, Federated States of</option>
                                                <option value="MD">Moldova, Republic of</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="ME">Montenegro</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="MP">Northern Mariana Islands</option>
                                                <option value="NO">Norway</option>
                                                <option value="OM">Oman</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="PW">Palau</option>
                                                <option value="PS">Palestinian Territory, Occupied</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="QA">Qatar</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russian Federation</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="BL">Saint Barthélemy</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint Lucia</option>
                                                <option value="MF">Saint Martin (French part)</option>
                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                <option value="WS">Samoa</option>
                                                <option value="SM">San Marino</option>
                                                <option value="ST">Sao Tome and Principe</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="RS">Serbia</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SX">Sint Maarten (Dutch part)</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="KR">South Korea</option>
                                                <option value="SS">South Sudan</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syrian Arab Republic</option>
                                                <option value="TW">Taiwan, Province of China</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania, United Republic of</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TG">Togo</option>
                                                <option value="TK">Tokelau</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="US">United States</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                <option value="VN">Vietnam</option>
                                                <option value="VI">Virgin Islands</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold">Use as a billing adderess?</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <div class="fs-7 fw-semibold text-muted">If you need more info, please
                                                        check budget planning</div>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Label-->

                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <!--begin::Input-->
                                                    <input class="form-check-input" name="billing" type="checkbox"
                                                        value="1" id="kt_modal_update_customer_billing"
                                                        checked="checked" />
                                                    <!--end::Input-->

                                                    <!--begin::Label-->
                                                    <span class="form-check-label fw-semibold text-muted"
                                                        for="kt_modal_update_customer_billing">
                                                        Yes
                                                    </span>
                                                    <!--end::Label-->
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                            <!--begin::Wrapper-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Billing form-->
                                </div>
                                <!--end::Scroll-->
                            </div>
                            <!--end::Modal body-->

                            <!--begin::Modal footer-->
                            <div class="modal-footer flex-center">
                                <!--begin::Button-->
                                <button type="reset" id="kt_modal_update_customer_cancel"
                                    class="btn btn-light me-3">
                                    Discard
                                </button>
                                <!--end::Button-->

                                <!--begin::Button-->
                                <button type="submit" id="kt_modal_update_customer_submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Submit
                                    </span>
                                    <span class="indicator-progress">
                                        Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Modal footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
            <!--end::Modal - New Address--><!--begin::Modal - New Card-->
            <div class="modal fade" id="kt_modal_new_card" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2>Add New Card</h2>
                            <!--end::Modal title-->

                            <!--begin::Close-->
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->

                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Form-->
                            <form id="kt_modal_new_card_form" class="form" action="#">
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Name On Card</span>


                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Specify a card holder's name">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i></span> </label>
                                    <!--end::Label-->

                                    <input type="text" class="form-control form-control-solid" placeholder=""
                                        name="card_name" value="Max Doe" />
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-semibold form-label mb-2">Card Number</label>
                                    <!--end::Label-->

                                    <!--begin::Input wrapper-->
                                    <div class="position-relative">
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Enter card number" name="card_number"
                                            value="4111 1111 1111 1111" />
                                        <!--end::Input-->

                                        <!--begin::Card logos-->
                                        <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                            <img src="/metronic8/demo15/assets/media/svg/card-logos/visa.svg"
                                                alt="" class="h-25px" />
                                            <img src="/metronic8/demo15/assets/media/svg/card-logos/mastercard.svg"
                                                alt="" class="h-25px" />
                                            <img src="/metronic8/demo15/assets/media/svg/card-logos/american-express.svg"
                                                alt="" class="h-25px" />
                                        </div>
                                        <!--end::Card logos-->
                                    </div>
                                    <!--end::Input wrapper-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-10">
                                    <!--begin::Col-->
                                    <div class="col-md-8 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-semibold form-label mb-2">Expiration Date</label>
                                        <!--end::Label-->

                                        <!--begin::Row-->
                                        <div class="row fv-row">
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <select name="card_expiry_month" class="form-select form-select-solid"
                                                    data-control="select2" data-hide-search="true"
                                                    data-placeholder="Month">
                                                    <option></option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <select name="card_expiry_year" class="form-select form-select-solid"
                                                    data-control="select2" data-hide-search="true"
                                                    data-placeholder="Year">
                                                    <option></option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                    <option value="2031">2031</option>
                                                    <option value="2032">2032</option>
                                                    <option value="2033">2033</option>
                                                    <option value="2034">2034</option>
                                                </select>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                            <span class="required">CVV</span>


                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                title="Enter a card CVV code">
                                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i></span> </label>
                                        <!--end::Label-->

                                        <!--begin::Input wrapper-->
                                        <div class="position-relative">
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                minlength="3" maxlength="4" placeholder="CVV" name="card_cvv" />
                                            <!--end::Input-->

                                            <!--begin::CVV icon-->
                                            <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                                <i class="ki-duotone ki-credit-cart fs-2hx"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                            </div>
                                            <!--end::CVV icon-->
                                        </div>
                                        <!--end::Input wrapper-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Label-->
                                    <div class="me-5">
                                        <label class="fs-6 fw-semibold form-label">Save Card for further billing?</label>
                                        <div class="fs-7 fw-semibold text-muted">If you need more info, please check
                                            budget planning</div>
                                    </div>
                                    <!--end::Label-->

                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            checked="checked" />
                                        <span class="form-check-label fw-semibold text-muted">
                                            Save Card
                                        </span>
                                    </label>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->


                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">
                                        Discard
                                    </button>

                                    <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - New Card--><!--end::Modals-->

<!-- start::Modal - Confirm Delete Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                <div class="btn btn-icon btn-sm btn-danger btn-active-light-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body" id="confirmDeleteMessage">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!--end::Modal - Confirm Delete Modal-->

    <!-- Start Beneficiary Modal -->
    <div class="modal fade" tabindex="-1" id="kt_modal_beneficiary">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Beneficiary</h3>
                    <div class="btn btn-icon btn-sm btn-danger btn-active-light-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <form id="BeneficiaryForm" method="POST">
                    @csrf
                    <input type="hidden" id="beneficiary_id" name="beneficiary_id">
                    <input type="hidden" id="funeral_id" name="funeral_id" value="{{ $funeral->id }}">
                    <input type="hidden" id="transaction_id" name="transaction_id">

                    <div class="modal-body">
                        <div class="pt-4 p-3">
                            <div class="row my-3">
                                <div class="col">
                                    <label for="beneficiary_name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="beneficiary_name" name="beneficiary_name">
                                </div>
                                <div class="col">
                                    <label for="beneficiary_surname" class="form-label">Surname:</label>
                                    <input type="text" class="form-control" id="beneficiary_surname" name="beneficiary_surname">
                                </div>
                                <div class="col">
                                    <label for="payout_amount" class="form-label">Amount:</label>
                                    <div class="input-group mx-auto">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">R</span>
                                        </div>
                                        <input type="number" class="form-control" id="payout_amount" name="payout_amount">
                                    </div>
                                </div>
                            </div>

                            <div class="separator my-8"></div>

                            <select id="beneficiary_addresstype" name="addressType" class="form-select" data-control="select2" data-placeholder="Select Location Type" data-hide-search="true">
                                <option value="1">Residential</option>
                                <option value="2">Postal</option>
                            </select>
                            

                            <!-- Address fields -->
                            <div class="row mt-3">
                                <div class="col">
                                    <input type="text" class="form-control" name="Line1" id="Line1_beneficiary" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="Line2" id="Line2_beneficiary" placeholder="Address Line 2">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="TownSuburb" id="TownSuburb_beneficiary" placeholder="Town/Suburb">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="City" id="City_beneficiary" placeholder="City">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="Province" id="Province_beneficiary" placeholder="Province">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="PostalCode" id="PostalCode_beneficiary" placeholder="Postal Code">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="Country" id="Country_beneficiary" placeholder="Country">
                                </div>
                            </div>

                            <div class="separator my-8"></div>

                            <!-- Payout Payment Details -->
                            <div class="row my-3">
                                <div class="col">
                                    <label for="payout_acc_number" class="form-label">Account number:</label>
                                    <input type="number" class="form-control" id="payout_acc_number" name="payout_acc_number">
                                </div>
                                <div class="col">
                                    <label for="bankSelect" class="form-label">Bank:</label>
                                    <select id="bankSelect" name="bankSelect" class="form-select bg-white form-select-solid" data-control="select2" data-placeholder="Select Bank" data-allow-clear="true">
                                        <option></option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}" data-universal-branch-code="{{ $bank->universal_branch_code }}">{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="universal_branch_code" class="form-label">Universal Branch Code:</label>
                                    <input type="text" class="form-control" id="universal_branch_code" name="universal_branch_code">
                                </div>
                                <div class="col">
                                    <label for="bank_account_type_id" class="form-label">Bank Account Type:</label>
                                    <select id="bank_account_type_id" name="bank_account_type_id" class="form-select" data-control="select2" data-placeholder="Select Account type" data-allow-clear="true">
                                        <option></option>
                                        @foreach ($bank_account_types as $account_type)
                                            <option value="{{ $account_type->id }}">{{ $account_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark" id="saveBeneficiaryBtn">Save Beneficiary</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Beneficiary Modal -->


<!-- Start Shortfall Payment Modal -->
<div class="modal fade" tabindex="-1" id="kt_modal_payment">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Payment</h3>
                <div class="btn btn-icon btn-sm btn-active-light-dark ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <form id="shortfallPaymentForm" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="shortfall_id" name="shortfall_id">
                    <input type="hidden" id="funeral_id" name="funeral_id" value="{{ $funeral->id }}">

                    <div class="pt-4 p-3">
                        <!-- Row 1 -->
                        <div class="row my-3">
                            <div class="col">
                                <label for="shortfall_payment_name" class="form-label">Full Name:</label>
                                <input type="text" class="form-control" id="shortfall_payment_name" name="shortfall_payment_name">
                            </div>
                            <div class="col">
                                <label for="shortfall_payment_reference" class="form-label">Reference:</label>
                                <input type="tel" class="form-control" id="shortfall_payment_reference" name="shortfall_payment_reference">
                            </div>
                            <div class="col">
                                <label for="shortfall_amount" class="form-label">Amount:</label>
                                <div class="input-group mx-auto">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R</span>
                                    </div>
                                    <input type="number" class="form-control cost-input" id="shortfall_amount" name="shortfall_amount">
                                </div>
                            </div>
                        </div>

                        <div class="separator border-light my-8"></div>

                        <div class="row my-3">
                            <div class="col">
                                <label for="shortfall_time_of_payment" class="form-label">Time of Payment:</label>
                                <input type="datetime-local" class="form-control" id="shortfall_time_of_payment" name="shortfall_time_of_payment">
                            </div>
                        </div>

                        <div class="separator border-light my-8"></div>

                        <div class="row my-3">
                            <div class="col">
                                <label for="ShortfallPaymentMethodSelect" class="form-label">Payment Method:</label>
                                <select id="ShortfallPaymentMethodSelect" name="ShortfallPaymentMethodSelect" class="form-select bg-white form-select-solid" data-control="select2" data-placeholder="Select Payment Method" data-allow-clear="true">
                                    <option value="2">Cash</option>
                                    <option value="5">EFT/Bank Payment</option>
                                </select>
                            </div>
                        </div>

                        <div class="separator border-light my-8"></div>

                        <div class="row my-3">
                            <div class="col">
                                <label for="membershipSelect" class="form-label">Membership:</label>
                                <select id="membershipSelect" name="membership_id" class="form-select bg-white form-select-solid" data-control="select2" data-placeholder="Select Membership" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($deceased_person->allMemberships() as $membership)
                                        <option value="{{ $membership->id }}">{{ $membership->membership_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark" id="savePaymentBtn">Save Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Shortfall Payment Modal -->










            <!-- Start Location Address Modal -->
            <div class="modal fade" tabindex="-1" id="kt_modal_1" style="z-index: 1057;">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Add Location</h3>

                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <form id="addressForm" method="POST" action="{{ route('StoreFuneralAddress') }}">
                            @csrf
                            <div class="modal-body">






                                <div class="pt-4 p-3">

                                    <select id="addressType" name="addressType" class="form-select "
                                        data-control="select2" data-placeholder="Select Location Type"
                                        data-hide-search="true">
                                        <option></option>
                                        <option value="{{ $churchTypeId }}">Church</option>
                                        <option value="{{ $graveyardTypeId }}">Graveyard</option>
                                        <option value="21">Viewing Location</option>
                                    </select>


                                    <div class="row mt-3">
                                        <div class="col">
                                            <div
                                                class="input-group input-group-outline  @error('Line1') is-invalid focused is-focused  @enderror  mb-0">

                                                <input type="text" class="form-control" id="Line1"
                                                    name="Line1" value="{{ old('Line1') }}">
                                            </div>
                                            @error('Line1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <div
                                                class="input-group input-group-outline  @error('PlaceName') is-invalid focused is-focused  @enderror  mb-0">
                                                <input type="text" class="form-control" name="PlaceName"
                                                    id="PlaceName" value="{{ old('PlaceName') }}"
                                                    placeholder="Location Name">
                                            </div>
                                            @error('PlaceName')
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

                                                <input type="text" class="form-control" name="Line2"
                                                    id="Line2" value="{{ old('Line2') }}"
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

                                                <input type="text" class="form-control" name="TownSuburb"
                                                    id="TownSuburb" value="{{ old('TownSuburb') }}"
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

                                                <input type="text" class="form-control" name="City"
                                                    id="City" value="{{ old('City') }}" placeholder="City">
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

                                                <input type="text" class="form-control" name="Province"
                                                    id="Province" value="{{ old('Province') }}"
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

                                                <input type="text" class="form-control" name="PostalCode"
                                                    id="PostalCode" value="{{ old('PostalCode') }}"
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

                                                <input type="text" class="form-control" name="Country"
                                                    id="Country" value="{{ old('Province') }}"
                                                    placeholder="Country">
                                            </div>
                                            @error('Country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-dark" id="saveLocationBtn">Save
                                    Location</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END Location Address Modal -->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>


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

            // Google places setup for beneficiary
            initAutocomplete('Line1_beneficiary', {
                Line1: 'Line1_beneficiary',
                Line2: 'Line2_beneficiary',
                PostalCode: 'PostalCode_beneficiary',
                City: 'City_beneficiary',
                TownSuburb: 'TownSuburb_beneficiary',
                Province: 'Province_beneficiary',
                Country: 'Country_beneficiary',
            });
        });
    </script>



    {{-- start:: This is for getting the universal branch code from the selected bank --}}
    <script>
        $(document).ready(function() {
            $('#bankSelect').select2();
        
            $('#bankSelect').on('select2:select', function(e) {
                var selectedOption = e.params.data.element;
                var branchCode = $(selectedOption).data('universal-branch-code');
                $('#universal_branch_code').val(branchCode || '');
            });
        });
        </script>
    {{-- end:: This is for getting the universal branch code from the selected bank --}}

    <style>
        #toast-container .toast-success {
            background-color: rgb(0, 0, 0);
        }
    </style>
    

    <div class="d-flex justify-content-end">
        <!--begin::Switch-->
        <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
            <!--begin::Input-->
            <input class="form-check-input" name="funeral_required" type="checkbox" value="1" id="funeral_required" 
                   data-funeral-id="{{ $funeral->id }}" {{ $funeral->funeral_required ? 'checked' : '' }} />
            <!--end::Input-->
        </label>
        <!--end::Switch-->
    </div>
    
    <!-- This is for blocking funeral section if not required -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var button = document.querySelector("#funeral_required");
            var target = document.querySelector("#funeral_card");
            var funeralId = button.getAttribute('data-funeral-id');
    
            var blockUI = new KTBlockUI(target, {
                overlayClass: "bg-danger bg-opacity-25",
                message: '<div class="blockui-message"><span class="fs-2 text-danger">Funeral not required</span></div>',
            });
    
            function updateBlockUI() {
                if (button.checked) {
                    blockUI.release();
                } else {
                    blockUI.block();
                }
            }
    
            // Initialize the block UI based on the initial state of the checkbox
            updateBlockUI();
    
            button.addEventListener("change", function() {
                updateBlockUI();
                
                // Send AJAX request to update funeral required status
                $.ajax({
                    url: '{{ route("updateFuneralRequired") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        funeral_id: funeralId,
                        funeral_required: button.checked ? 1 : 0
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('success', response.message);
                        } else {
                            showToast('error', response.message);
                        }
                    },
                    error: function(response) {
                        showToast('error', 'Error updating funeral required status.');
                        console.error('Error:', response);
                    }
                });
            });
    
            function showToast(type, message) {
                if (type === 'success') {
                    toastr.success(message);
                } else {
                    toastr.error(message);
                }
            }
        });
    </script>
    


    {{-- This is used for the checklist --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.checklist-checkbox');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const itemId = this.getAttribute('data-item-id');
                    const dateSpan = document.getElementById(`dated_completed_${itemId}`);
                    const noteTextarea = document.getElementById(`${itemId}_note`);
                    const hiddenDateCompleted = document.getElementById(
                        `hidden_dated_completed_${itemId}`);
                    const hiddenNote = document.getElementById(`hidden_note_${itemId}`);

                    if (this.checked) {
                        const currentDateTime = new Date().toLocaleString('en-GB', {
                            hour12: false
                        });
                        dateSpan.textContent = currentDateTime;
                        noteTextarea.readOnly = true;
                        hiddenDateCompleted.value = currentDateTime;
                        hiddenNote.value = noteTextarea.value;
                    } else {
                        dateSpan.textContent = 'Not completed';
                        noteTextarea.readOnly = false;
                        hiddenDateCompleted.value = '';
                        hiddenNote.value = '';
                    }
                });

                document.getElementById(`${checkbox.getAttribute('data-item-id')}_note`).addEventListener(
                    'input',
                    function() {
                        const itemId = this.getAttribute('data-item-id');
                        const hiddenNote = document.getElementById(`hidden_note_${itemId}`);
                        hiddenNote.value = this.value;
                    });
            });
        });
    </script>

    <script>
        $("#kt_datatable_footer_callback").DataTable({
            "searching": false, // Disables the search box
            "lengthChange": false, // Hides the 'show entries' dropdown
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === "string" ?
                        i.replace(/[\$,]/g, "") * 1 :
                        typeof i === "number" ?
                        i : 0;
                };

                // Total over all pages
                var total = api
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                var pageTotal = api
                    .column(4, {
                        page: "current"
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(4).footer()).html(
                    "$" + pageTotal + " ( $" + total + " total)"
                );
            }
        });
    </script>


    <script>
        $("#kt_datatable_benefit_footer_callback").DataTable({
            "searching": false, // Disables the search box
            "lengthChange": false, // Hides the 'show entries' dropdown
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === "string" ?
                        i.replace(/[\$,]/g, "") * 1 :
                        typeof i === "number" ?
                        i : 0;
                };

                // Total over all pages
                var total = api
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                var pageTotal = api
                    .column(4, {
                        page: "current"
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(4).footer()).html(
                    "$" + pageTotal + " ( $" + total + " total)"
                );
            }
        });
    </script>


    {{-- <!-- Include jQuery first -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Then include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function toggleDetails(selector) {
            $(selector).slideToggle('slow');
        }
    </script>





    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Listen for the modal showing up
            $('#kt_modal_1').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var locationType = button.data('location-type'); // Extract info from data-* attributes
                var modal = $(this);

                // Determine which option to select based on the clicked button
                if(locationType === 'Church') {
                    modal.find('#addressType').val('{{ $churchTypeId }}').trigger('change');
                } else if(locationType === 'Graveyard') {
                    modal.find('#addressType').val('{{ $graveyardTypeId}}').trigger('change');
                }
            });
        });
    </script> --}}

      {{-- Edit/Create modal for Beneficiary --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#kt_modal_beneficiary').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var modal = $(this);
                var form = modal.find('#BeneficiaryForm');
                var title = modal.find('.modal-title');
    
                var beneficiaryId = button.data('beneficiary-id');
                var beneficiaryName = button.data('beneficiary-name');
                var beneficiarySurname = button.data('beneficiary-surname');
                var transactionId = button.data('transaction-id');
                var payoutAmount = button.data('payout-amount');
                var addressTypeId = button.data('address-type-id');
                var line1 = button.data('line1');
                var line2 = button.data('line2');
                var townSuburb = button.data('townsuburb');
                var city = button.data('city');
                var province = button.data('province');
                var postalCode = button.data('postalcode');
                var countryName = button.data('country-name');
                var payoutAccNumber = button.data('payout-acc-number');
                var bankId = button.data('bank-id');
                var universalBranchCode = button.data('universal-branch-code');
                var bankAccountTypeId = button.data('bank-account-type-id');
    
                if (beneficiaryId) {
                    // Editing existing beneficiary
                    title.text('Edit Beneficiary');
                    form.find('#beneficiary_id').val(beneficiaryId);
                    form.find('#beneficiary_name').val(beneficiaryName);
                    form.find('#beneficiary_surname').val(beneficiarySurname);
                    form.find('#transaction_id').val(transactionId);
                    form.find('#payout_amount').val(payoutAmount);
                    form.find('#beneficiary_addresstype').val(addressTypeId).trigger('change');
                    form.find('#Line1_beneficiary').val(line1);
                    form.find('#Line2_beneficiary').val(line2);
                    form.find('#TownSuburb_beneficiary').val(townSuburb);
                    form.find('#City_beneficiary').val(city);
                    form.find('#Province_beneficiary').val(province);
                    form.find('#PostalCode_beneficiary').val(postalCode);
                    form.find('#Country_beneficiary').val(countryName);
                    form.find('#payout_acc_number').val(payoutAccNumber);
                    form.find('#bankSelect').val(bankId).trigger('change');
                    form.find('#universal_branch_code').val(universalBranchCode);
                    form.find('#bank_account_type_id').val(bankAccountTypeId).trigger('change');
                } else {
                    // Adding new beneficiary
                    title.text('Add Beneficiary');
                    form.trigger('reset');
                    form.find('#beneficiary_id').val(''); // Ensure beneficiary_id is empty
                    form.find('#transaction_id').val(''); // Ensure transaction_id is empty
                }
    
                form.attr('action', '{{ route('StoreFuneralBeneficiary') }}');
            });
        });
    </script>
    
    
    
<!-- Begin Combined Script for Deleting Beneficiaries and Shortfalls, and Handling Shortfall Payment Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteTransactionId;
        var deleteBeneficiaryId;
        var deleteFuneralId;
        var deleteType;

        // Show confirmation modal on remove button click
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            deleteType = button.data('type');

            if (deleteType === 'beneficiary') {
                deleteBeneficiaryId = button.data('beneficiary-id');
                deleteFuneralId = button.data('funeral-id');
                deleteTransactionId = button.data('transaction-id');
                $('#confirmDeleteMessage').text('Are you sure you want to remove this beneficiary?');
            } else if (deleteType === 'shortfall') {
                deleteTransactionId = button.data('transaction-id');
                $('#confirmDeleteMessage').text('Are you sure you want to remove this shortfall payment?');
            }
        });

        // Handle confirmation button click
        $('#confirmDeleteBtn').on('click', function () {
            var url = '';
            var data = {
                _token: '{{ csrf_token() }}'
            };

            if (deleteType === 'beneficiary') {
                url = '{{ route("RemoveFuneralBeneficiary") }}';
                data.beneficiary_id = deleteBeneficiaryId;
                data.funeral_id = deleteFuneralId;
                data.transaction_id = deleteTransactionId;
            } else if (deleteType === 'shortfall') {
                url = '{{ route("RemoveShortfallPayment") }}';
                data.transaction_id = deleteTransactionId;
            }

            console.log("Sending data: ", data); // Log data being sent for debugging

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function (response) {
                    console.log("Success: ", response); // Log success response
                    location.reload(); // Reload the page to reflect changes
                },
                error: function (response) {
                    console.error('Error:', response);
                }
            });
        });

        // Handle modal show for creating and editing shortfall payments
        $('#kt_modal_payment').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var modal = $(this);
            var form = modal.find('#shortfallPaymentForm');
            var title = modal.find('.modal-title');

            var transactionId = button.data('transaction-id');
            var name = button.data('name');
            var reference = button.data('reference');
            var amount = button.data('amount');
            var paymentMethodId = button.data('payment-method-id');
            var timeOfPayment = button.data('time-of-payment');
            var membershipId = button.data('membership-id');

            if (transactionId) {
                // Editing existing payment
                title.text('Edit Payment');
                form.find('#shortfall_id').val(transactionId);
                form.find('#shortfall_payment_name').val(name);
                form.find('#shortfall_payment_reference').val(reference);
                form.find('#shortfall_amount').val(amount);
                form.find('#ShortfallPaymentMethodSelect').val(paymentMethodId).trigger('change');
                form.find('#shortfall_time_of_payment').val(timeOfPayment);
                form.find('#membershipSelect').val(membershipId).trigger('change');
            } else {
                // Adding new payment
                title.text('Add Payment');
                form.trigger('reset');
                form.find('#shortfall_id').val(''); // Ensure shortfall_id is empty
            }

            form.attr('action', '{{ route('StoreFuneralShortfall') }}');
        });
    });
</script>
<!-- End Combined Script for Deleting Beneficiaries and Shortfalls, and Handling Shortfall Payment Modal -->




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Listen for the modal showing up
            $('#kt_modal_payment').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal

                var modal = $(this);
            });
        });
    </script>




{{-- start::script for checklist --}}



{{-- end::script for checklist --}}


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
            // Function to check for empty required fields within a specific form
            function areRequiredFieldsFilled() {
                // Select only required inputs within the specified form
                const requiredInputs = document.querySelectorAll(
                    '#funeralForm input[required], #funeralForm textarea[required], #funeralForm select[required]'
                );
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

            document.getElementById('externalSubmitActionOneCopy').addEventListener('click', function() {
                handleClick('submitActionOne');
            });

            document.getElementById('externalSubmitActionTwo').addEventListener('click', function() {
                handleClick('submitActionTwo');
            });
        });
    </script>


    {{-- This is for address modal submission --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let searchTerm = '';

            function formatNoResults() {
                return 'No results found';
            }

            function initializeSelect2(selector) {
                $(selector).select2({
                    placeholder: $(selector).data('placeholder'),
                    allowClear: true,
                    language: {
                        noResults: formatNoResults
                    },
                    escapeMarkup: function(markup) {
                        return markup;
                    }
                }).on('select2:open', function() {
                    console.log('Select2 dropdown opened');
                    // Append the button to the dropdown
                    if (!document.getElementById('add-new-location-btn')) {
                        let locationType = $(selector).attr('id') === 'churchSelect' ? 'Church' :
                            'Graveyard';
                        if ($(selector).attr('id') === 'viewing_location') {
                            locationType = 'Viewing';
                        }
                        let buttonHtml =
                            '<div class="select2-add-button-container" style="text-align: center; padding: 10px;">' +
                            '<button type="button" class="btn btn-dark btn-sm" id="add-new-location-btn" data-bs-toggle="modal" data-bs-target="#kt_modal_1" data-location-type="' +
                            locationType + '">+ Add ' + locationType + '</button>' +
                            '</div>';
                        $('.select2-results__options').after(buttonHtml);
                    }
                    $('.select2-search__field').on('input', function() {
                        searchTerm = $(this).val();
                    }).focus(); // Ensure search field is focused when opened
                });
            }

            initializeSelect2('#churchSelect');
            initializeSelect2('#graveyardSelect');
            initializeSelect2('#viewing_location');

            $('#saveLocationBtn').on('click', function(event) {
                event.preventDefault();

                var formData = new FormData(document.getElementById('addressForm'));

                $.ajax({
                    url: '{{ route('StoreFuneralAddress') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Address has been saved successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#kt_modal_1').modal('hide');
                                // Append the new option and select it
                                var newOption = new Option(response.name + ' (' +
                                    response.line1 + ' - ' + response.suburb +
                                    ', ' + response.city + ', ' + response.ZIP +
                                    ')', response.id, true, true);
                                if (response.type === 'Church') {
                                    $('#churchSelect').append(newOption).trigger(
                                        'change');
                                } else if (response.type === 'Graveyard') {
                                    $('#graveyardSelect').append(newOption).trigger(
                                        'change');
                                } else if (response.type === 'Viewing') {
                                    $('#viewing_location').append(newOption).trigger(
                                        'change');
                                }

                                // Clear the form
                                $('#addressForm').find(
                                    'input[type=text], input[type=number], textarea, select'
                                    ).val('');

                                setTimeout(function() {
                                    if ($('.modal-backdrop').length) {
                                        $('.modal-backdrop').remove();
                                        $('body').removeClass('modal-open');
                                    }
                                }, 200);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to save the address. Please check the form for errors.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        console.error('Error:', error);
                    }
                });
            });

            $('#kt_modal_1').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var locationType = button.data('location-type');
                var modal = $(this);

                if (locationType === 'Church') {
                    modal.find('#addressType').val('{{ $churchTypeId }}').trigger('change');
                } else if (locationType === 'Graveyard') {
                    modal.find('#addressType').val('{{ $graveyardTypeId }}').trigger('change');
                } else if (locationType === 'Viewing') {
                    modal.find('#addressType').val('{{ $viewingTypeId }}').trigger('change');
                }

                // Set the Line1 field with the search term
                $('#Line1').val(searchTerm);
                setTimeout(function() {
                    $('#Line1').focus();
                }, 500); // Slight delay to ensure modal is fully opened
            });
        });
    </script>



{{-- START::add costs modal script --}}
<script>
document.getElementById('addCostButton').addEventListener('click', function () {
    var form = document.getElementById('addCostForm');
    var formData = new FormData(form);

    fetch('{{ route('AddFuneralCost') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            var tableBody = document.getElementById('funeral-costs-table-body');
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${data.cost.name}</td>
                <td>
                    <div class="input-group">
                        <span class="input-group-text">R</span>
                        <input type="number" class="form-control cost-input" id="fc_${slugify(data.cost.name)}" name="fc_${slugify(data.cost.name)}" oninput="calculateTotal()">
                    </div>
                </td>
            `;

            tableBody.appendChild(newRow);

            // Reset modal fields
            form.reset();

            // Close the modal using Bootstrap's modal method
            var addCostModal = bootstrap.Modal.getInstance(document.getElementById('addCostModal'));
            addCostModal.hide();
        } else {
            alert('Error adding cost');
        }
    })
    .catch(error => console.error('Error:', error));
});

function slugify(text) {
    return text.toString().toLowerCase().replace(/\s+/g, '_').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '_').replace(/^-+/, '').replace(/-+$/, '');
}


</script>
{{-- END::add costs modal script --}}

    <script>
        $(document).ready(function() {
            $('#churchSelect').select2({
                placeholder: "Select Church",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#graveyardSelect').select2({
                placeholder: "Select Cemetery",
                allowClear: true
            });
        });
    </script>
@endpush
