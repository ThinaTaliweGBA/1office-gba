@extends('layouts.app2')

@push('styles')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> --}}

    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.css" rel="stylesheet">
 --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.bootstrap5.css">
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
    </style>

    <style>
        .form-control {
            background-color: white !important;
        }

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

    <style>
        .menu-sub-dropdown {
            background-color: #ffffff !important;
        }

        .page-link.active,
        .active>.page-link {
            background-color: #131628 !important;
        }
    </style>

    {{-- Styling for the grouping table --}}
    <style>
        #kt_datatable_row_grouping th,
        #kt_datatable_row_grouping td {
            text-align: left;
        }

        #kt_datatable_row_grouping th:last-child,
        #kt_datatable_row_grouping td:last-child {
            text-align: center;
        }

        .group {
            /* background-color: #fafafa !important; */
            /* Slight gray background */
            font-weight: normal !important;
            vertical-align: middle;
            /* Make it not bold */
        }
        .group td {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
    </style>
@endpush
    <!--SIYA:: Block UI if user is not an employee -->
    <x-access-denied-modal />
@section('row_content')
    <div class="card rounded mb-16 shadow">

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

        <div class="card my-2">
            {{-- <div class="card-header">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Funerals</h3>
                </div>
            </div> --}}
            <div class="card-body">

                {{-- <table id="kt_datatable_row_grouping" class="table border rounded table-row-dashed fs-6 g-5 gs-5">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                    <th>Membership ID</th>
                                    <th>Main/Dep</th>
                                    <th>Person Details</th>
                                    <th>Membership Status</th>
                                    <th>Last Payment Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>12345</td>
                                    <td>
                                        <div class="badge py-3 px-4 fs-7 badge-light-primary">
                                            Main Member
                                        </div>
                                    </td>
                                    <td>use Person ID but show name and other details here</td>
                                    <td>
                                        <div class="badge py-3 px-4 fs-7 badge-light-success">
                                            Fully-Paid
                                        </div>
                                    </td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <a href="{{ url('funerals/create', $person->id) }}" class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" title="Begin Funeral Arrangement">
                                            <i class="bi bi-plus-lg fs-4 me-0"></i>
                                        </a>
                                        <a href="{{ route('funerals.edit', $person->id) }}" class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-fill fs-4 me-0"></i>
                                        </a>
                                        <form action="{{ route('funerals.destroy', $person->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" title="Remove">
                                                <i class="bi bi-trash3 fs-4 me-0"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('funerals.index', $person->id) }}" class="btn btn-sm btn-icon btn-dark" data-bs-toggle="tooltip" title="Reburial">
                                            <i class="bi bi-repeat fs-4 me-0"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>67891</td>
                                    <td>
                                        <div class="badge py-3 px-4 fs-7 badge-light-info">
                                            Dependent
                                        </div>
                                    </td>
                                    <td>use Person ID but show name and other details here</td>
                                    <td>
                                        <div class="badge py-3 px-4 fs-7 badge-light-danger">
                                            In-Arrears
                                        </div>
                                    </td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <a href="{{ url('funerals/create', $person->id) }}" class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" title="Begin Funeral Arrangement">
                                            <i class="bi bi-plus-lg fs-4 me-0"></i>
                                        </a>
                                        <a href="{{ route('funerals.edit', $person->id) }}" class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-fill fs-4 me-0"></i>
                                        </a>
                                        <form action="{{ route('funerals.destroy', $person->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" title="Remove">
                                                <i class="bi bi-trash3 fs-4 me-0"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('funerals.index', $person->id) }}" class="btn btn-sm btn-icon btn-dark" data-bs-toggle="tooltip" title="Reburial">
                                            <i class="bi bi-repeat fs-4 me-0"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>G67891</td>
                                    <td>
                                        <div class="badge py-3 px-4 fs-7 badge-light-info">
                                            Dependent
                                        </div>
                                    </td>
                                    <td>Joe Doe - 9802185020254 - 18-02-1998 - 06-07-2068 </td>
                                    <td>
                                        <div class="badge py-3 px-4 fs-7 badge-light-warning">
                                            Outstanding-Balance
                                        </div>
                                    </td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <a href="{{ url('funerals/create', $person->id) }}" class="btn btn-sm btn-sm btn-icon btn-success" data-bs-toggle="tooltip" title="Begin Funeral Arrangement">
                                            <i class="bi bi-plus-lg fs-4 me-0"></i>
                                        </a>
                                        <a href="{{ route('funerals.edit', $person->id) }}" class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-fill fs-4 me-0"></i>
                                        </a>
                                        <form action="{{ route('funerals.destroy', $person->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" title="Remove">
                                                <i class="bi bi-trash3 fs-4 me-0"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('funerals.index', $person->id) }}" class="btn btn-sm btn-icon btn-dark" data-bs-toggle="tooltip" title="Reburial">
                                            <i class="bi bi-repeat fs-4 me-0"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>67891</td>
                                    <td>
                                        <div class="badge py-3 px-4 fs-7 badge-light-info">
                                            Dependent
                                        </div>
                                    </td>
                                    <td>Joe Doe - 9802185020254 - 18-02-1998 - 06-07-2068 </td>
                                    <td>
                                        <div class="badge py-3 px-4 fs-7 badge-light-success">
                                            Fully-Paid
                                        </div>
                                    </td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <a href="{{ url('funerals/create', $person->id) }}" class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" title="Begin Funeral Arrangement">
                                            <i class="bi bi-plus-lg fs-4 me-0"></i>
                                        </a>
                                        <a href="{{ route('funerals.edit', $person->id) }}" class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-fill fs-4 me-0"></i>
                                        </a>
                                        <form action="{{ route('funerals.destroy', $person->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" title="Remove">
                                                <i class="bi bi-trash3 fs-4 me-0"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('funerals.index', $person->id) }}" class="btn btn-sm btn-icon btn-dark" data-bs-toggle="tooltip" title="Reburial">
                                            <i class="bi bi-repeat fs-4 me-0"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table> --}}






                <!--begin::Wrapper for second table-->
                <div class="d-flex flex-stack flex-wrap mb-5">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1 ">
                        <!-- Custom Length Control with Dropdown Arrow -->
                        <div class="position-relative">
                            <select class="form-control form-control-solid w-70px me-2 " id="customLength2">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <!-- Custom Dropdown Arrow with Span Elements -->
                            <div class="ki-duotone ki-arrow-down position-absolute end-0 me-6"
                                style="top: 50%; transform: translateY(-50%); pointer-events: none;">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </div>
                        </div>

                        <!-- Search Input with Magnifier Icon -->
                        <div class="position-relative d-flex align-items-center my-1 mb-2 mb-md-0">
                            <div class="ki-duotone ki-magnifier position-absolute ms-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </div>
                            <input type="text" data-kt-docs-table-filter="search2"
                                class="form-control form-control-solid w-250px ps-15 "
                                placeholder="Search Person/DOB/ID" autocomplete="nope"/>
                        </div>
                    </div>
                    <!--end::Search-->

                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base2">
                        <!--begin::Filter-->
                        <button type="button" class="btn me-3 btn-dark" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span
                                    class="path2"></span></i> Filter
                        </button>
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                            id="kt-toolbar-filter2">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-4 text-dark fw-bold">Filter Options</div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Separator-->

                            <!--begin::Content-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fs-5 fw-semibold mb-3">Membership Status:</label>
                                    <!--end::Label-->

                                    <!--begin::Options-->
                                    <div class="d-flex flex-column flex-wrap fw-semibold"
                                        data-kt-docs-table-filter="membership_status2">
                                        <!--begin::Option-->
                                        <label
                                            class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                            <input class="form-check-input" type="radio" name="membership_status2"
                                                value="all" checked="checked" />
                                            <span class="form-check-label text-gray-600">
                                                All
                                            </span>
                                        </label>
                                        <!--end::Option-->

                                        <!--begin::Option-->
                                        <label
                                            class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                            <input class="form-check-input" type="radio" name="membership_status2"
                                                value="Active" />
                                            <span class="form-check-label text-gray-600">
                                                Active
                                            </span>
                                        </label>
                                        <!--end::Option-->

                                        <!--begin::Option-->
                                        <label
                                            class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                            <input class="form-check-input" type="radio" name="membership_status2"
                                                value="Fully-Paid" />
                                            <span class="form-check-label text-gray-600">
                                                Fully-Paid
                                            </span>
                                        </label>
                                        <!--end::Option-->

                                        <!--begin::Option-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                            <input class="form-check-input" type="radio" name="membership_status2"
                                                value="In-Arrears" />
                                            <span class="form-check-label text-gray-600">
                                                In-Arrears
                                            </span>
                                        </label>
                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-dark me-2" data-kt-menu-dismiss="true"
                                        data-kt-docs-table-filter="reset2">Reset</button>

                                    <button type="submit" class="btn btn-success" data-kt-menu-dismiss="true"
                                        data-kt-docs-table-filter="filter2">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Menu 1-->
                        <!--end::Filter-->

                        <!--begin::Record Death-->
                        <button type="button" class="btn btn-dark"  data-bs-toggle="modal" data-bs-target="#report_death_modal">
                            <i class="ki-duotone ki-plus fs-2"></i> Record New Death
                        </button>
                        <!--end::Record Death-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Wrapper-->

                <table id="kt_datatable_row_grouping2" class="table border table-rounded table-row-dashed fs-6 g-5 gs-5">
                    <thead>
                        <tr class="text-start text-dark  fw-bold fs-7 text-uppercase">
                            <th>Membership Code</th>
                            <th>Main/Dep</th>
                            <th>Person Details</th>
                            <th>Membership Status</th>
                            <th>Last Payment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($funerals as $funeral)
                            @foreach ($funeral->person->allMemberships() as $membership)
                                <tr data-person-id="{{ $funeral->person->id }}"
                                    data-funeral-id="{{ $funeral->id }}"
                                    data-person-details="{{ $funeral->person->first_name ?? 'N/A' }} - {{ $funeral->person->initials ?? 'N/A' }} - {{ $funeral->person->last_name ?? 'N/A' }}">
                                    <td>{{ $membership->membership_code }}</td>
                                    <td>
                                        @php
                                        $relationshipType = 'Main Member';
                                        if ($membership->pivot) {
                                            if ($membership->pivot->secondary_person_id == $funeral->person->id) {
                                                $relationshipType = 'Dependent';
                                            }
                                            if ($membership->pivot->person_relationship_id == 1) {
                                                $relationshipType = 'Spouse';
                                            }
                                        }
                                    @endphp
                                    
                                        <div class="badge py-3 px-4 fs-7 badge-light-{{ $relationshipType == 'Main Member' ? 'primary' : 'info' }}">
                                            {{ $relationshipType }}
                                        </div>
                                    </td>
                                    <td>{{ $funeral->person->first_name ?? 'N/A' }} - {{ $funeral->person->initials ?? 'N/A' }} - {{ $funeral->person->last_name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="badge py-3 px-4 fs-7 badge-light-{{ $membership->status->name == 'Active' ? 'success' : ($membership->status->name == 'Outstanding-Balance' ? 'warning' : 'danger') }}"
                                            data-bs-toggle="tooltip" title="Show details here">
                                            {{ $membership->status->name }}
                                        </div>
                                    </td>
                                    <td>{{ $membership->last_payment_date }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>









<div class="modal fade" tabindex="-1" id="report_death_modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content stepper stepper-pills" id="kt_stepper_example_modal">
            <div class="modal-header px-10">
                <h3 class="modal-title">Report Death</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body px-10">
                <div>
                    <div class="stepper-nav flex-center flex-wrap mb-10">
                        <div class="stepper-item mx-4 my-4 current" data-kt-stepper-element="nav">
                            <div class="stepper-wrapper d-flex align-items-center">
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">1</span>
                                </div>
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Step 1</h3>
                                    <div class="stepper-desc">Search for a Person</div>
                                </div>
                            </div>
                            <div class="stepper-line h-40px"></div>
                        </div>
                        <div class="stepper-item mx-4 my-4" data-kt-stepper-element="nav">
                            <div class="stepper-wrapper d-flex align-items-center">
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">2</span>
                                </div>
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Step 2</h3>
                                    <div class="stepper-desc">Record Death</div>
                                </div>
                            </div>
                            <div class="stepper-line h-40px"></div>
                        </div>
                    </div>
                    <!-- Step 1: Search for a Person -->
                    <div class="flex-column current" data-kt-stepper-element="content">
                        <!--begin::Search-->
                        <div id="kt_modal_users_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="inline">
                            <div class="w-100 position-relative mb-5">
                                <input type="hidden"/>
                                <i class="ki-duotone ki-magnifier fs-2 fs-lg-1 text-gray-500 position-absolute top-50 ms-5 translate-middle-y"><span class="path1"></span><span class="path2"></span></i>
                                <input type="text" class="form-control form-control-lg form-control-solid  ps-14" name="search" value="" placeholder="Search by name or ID number..." data-kt-search-element="input" id="person-search-input" autocomplete="nope"/>
                                <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                                    <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                                </span>
                                <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="clear">
                                    <i class="ki-duotone ki-cross fs-2 fs-lg-1 me-0"><span class="path1"></span><span class="path2"></span></i>
                                </span>
                            </div>
                            <div id="search-image" class="text-center px-4">
                                <img class="mw-100 mh-200px" alt="image" src="{{ asset('img/icons8-search.svg') }}">
                            </div>
                            <div class="py-5" id="search-results">
                                <!-- Suggestions or results will be dynamically injected here -->
                            </div>
                        </div>
                        <!--end::Search-->
                    </div>
                    <!-- Step 2: Record Death -->
                    <div class="flex-column" data-kt-stepper-element="content">
                        <form id="recordDeath" method="POST" action="{{ route('deaths.store') }}">
                            @csrf
                            <input type="hidden" id="deceased_id" name="deceased_id">
                            <!-- Contact Details of Person Reporting Death -->
                            <div class="pt-4 p-3">
                                <h4 class="mb-3">Contact Details of Person Reporting Death:</h4>
                                <div class="row">
                                    <div class="col">
                                        <label for="reporter_name" class="form-label">Name:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="reporter_name" name="reporter_name" autocomplete="nope">
                                    </div>
                                    <div class="col">
                                        <label for="reporter_surname" class="form-label">Surname:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="reporter_surname" name="reporter_surname" autocomplete="nope">
                                    </div>
                                    <div class="col">
                                        <label for="reporter_tel" class="form-label">Tel:</label>
                                        <input type="tel" class="form-control bg-light text-dark" id="reporter_tel" name="reporter_tel" autocomplete="nope">
                                    </div>
                                    <div class="col">
                                        <label for="reporter_whatsapp" class="form-label">WhatsApp yes/no:</label>
                                        <select class="form-control bg-light text-dark" id="reporter_whatsapp" name="reporter_whatsapp">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="reporter_email" class="form-label">E-mail:</label>
                                        <input type="email" class="form-control bg-light text-dark" id="reporter_email" name="reporter_email" autocomplete="nope">
                                    </div>
                                </div>
                                <div class="separator border-light my-8"></div>
                                <div class="row">
                                    <div class="col">
                                        <label for="tracking_number" class="form-label">Tracking Number:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="tracking_number" name="tracking_number" placeholder="20240321/1453" readonly>
                                    </div>
                                </div>
                                <div class="separator border-light my-8"></div>
                                <h4 class="mb-3">Deceased Person's Details:</h4>
                                <div class="row">
                                    <div class="col">
                                        <label for="deceased_name" class="form-label">Name:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="deceased_name" name="deceased_name" autocomplete="nope">
                                    </div>
                                    <div class="col">
                                        <label for="deceased_initials" class="form-label">Initials:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="deceased_initials" name="deceased_initials" autocomplete="nope">
                                    </div>
                                    <div class="col">
                                        <label for="deceased_surname" class="form-label">Surname:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="deceased_surname" name="deceased_surname" autocomplete="nope">
                                    </div>
                                    <div class="col">
                                        <label for="deceased_maiden_name" class="form-label">Maiden Name:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="deceased_maiden_name" name="deceased_maiden_name" autocomplete="nope">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="deceased_address" class="form-label">Address:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="deceased_address" name="deceased_address" autocomplete="nope"> 
                                        <input type="hidden" id="deceased_address_line1" name="deceased_address_line1">
                                        <input type="hidden" id="deceased_address_line2" name="deceased_address_line2">
                                        <input type="hidden" id="deceased_address_postalCode" name="deceased_address_postalCode">
                                        <input type="hidden" id="deceased_address_city" name="deceased_address_city">
                                        <input type="hidden" id="deceased_address_townSuburb" name="deceased_address_townSuburb">
                                        <input type="hidden" id="deceased_address_province" name="deceased_address_province">
                                        <input type="hidden" id="deceased_address_country" name="deceased_address_country">
                                        <input type="hidden" id="deceased_address_placeName" name="deceased_place_of_death_placeName">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col">
                                        <label for="deceased_id_number" class="form-label">ID Number:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="deceased_id_number" name="deceased_id_number" autocomplete="nope">
                                    </div>
                                    <div class="col">
                                        <label for="deceased_birth_date" class="form-label">Birth Date:</label>
                                        <input type="date" class="form-control bg-light text-dark" id="deceased_birth_date" name="deceased_birth_date">
                                        
                                    </div>
                                    <div class="col">
                                        <label for="deceased_age" class="form-label">Age:</label>
                                        <input type="number" class="form-control bg-light text-dark" id="deceased_age" name="deceased_age" autocomplete="nope">
                                    </div>
                                    <div class="col">
                                        <label for="deceased_birth_town" class="form-label">Birth Town:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="deceased_birth_town" name="deceased_birth_town" autocomplete="nope">
                                    </div>
                                    <input type="hidden" id="deceased_birth_town_line1" name="deceased_birth_town_line1">
                                    <input type="hidden" id="deceased_birth_town_line2" name="deceased_birth_town_line2">
                                    <input type="hidden" id="deceased_birth_town_postalCode" name="deceased_birth_town_postalCode">
                                    <input type="hidden" id="deceased_birth_town_city" name="deceased_birth_town_city">
                                    <input type="hidden" id="deceased_birth_town_townSuburb" name="deceased_birth_town_townSuburb">
                                    <input type="hidden" id="deceased_birth_town_province" name="deceased_birth_town_province">
                                    <input type="hidden" id="deceased_birth_town_country" name="deceased_birth_town_country">
                                    <input type="hidden" id="deceased_birth_town_placeName" name="deceased_place_of_death_placeName">
                                </div>
                                <div class="row my-2">
                                    <div class="col">
                                        <label for="deceased_sex" class="form-label">Sex:</label>
                                        <select class="form-control" id="deceased_sex" name="deceased_sex">
                                            <option value="" disabled selected>Select Sex</option>
                                            @foreach ($genders as $gender)
                                                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="deceased_marital_status" class="form-label">Marital Status:</label>
                                        <select class="form-control" id="deceased_marital_status" name="deceased_marital_status">
                                            <option value="" disabled selected>Select Marital Status</option>
                                            @foreach ($maritalStatuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="deceased_language" class="form-label">Language:</label>
                                        <select class="form-control" id="deceased_language" name="deceased_language">
                                            <option value="" disabled selected>Select Language</option>
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="deceased_occupation" class="form-label">Occupation:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="deceased_occupation" name="deceased_occupation" autocomplete="nope">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col">
                                        <label for="deceased_dr_number" class="form-label">DR (BI 1663 NR):</label>
                                        <input type="text" class="form-control bg-light text-dark" id="deceased_dr_number" name="deceased_dr_number" autocomplete="nope">
                                    </div>
                                    <div class="col">
                                        <label for="deceased_date_of_death" class="form-label">Date of Death:</label>
                                        <input type="date" class="form-control bg-light text-dark" id="deceased_date_of_death" name="deceased_date_of_death" >
                                    </div>
                                    <div class="col">
                                        <label for="deceased_place_of_death" class="form-label">Place of Death:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="deceased_place_of_death" name="deceased_place_of_death" autocomplete="nope">
                                    </div>
                                    <input type="hidden" id="deceased_place_of_death_line1" name="deceased_place_of_death_line1">
                                    <input type="hidden" id="deceased_place_of_death_line2" name="deceased_place_of_death_line2">
                                    <input type="hidden" id="deceased_place_of_death_postalCode" name="deceased_place_of_death_postalCode">
                                    <input type="hidden" id="deceased_place_of_death_city" name="deceased_place_of_death_city">
                                    <input type="hidden" id="deceased_place_of_death_townSuburb" name="deceased_place_of_death_townSuburb">
                                    <input type="hidden" id="deceased_place_of_death_province" name="deceased_place_of_death_province">
                                    <input type="hidden" id="deceased_place_of_death_country" name="deceased_place_of_death_country">
                                    <input type="hidden" id="deceased_place_of_death_placeName" name="deceased_place_of_death_placeName">
                                    <div class="col">
                                        <label for="deceased_doctor" class="form-label">Doctor:</label>
                                        <input type="text" class="form-control bg-light text-dark" id="deceased_doctor" name="deceased_doctor" autocomplete="nope">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-10 d-flex flex-stack">
                <div class="me-2">
                    <button type="button" class="btn btn-light btn-active-light-primary" data-kt-stepper-action="previous">
                        Back
                    </button>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" id="btn-next">
                        Continue
                    </button>
                    <button type="button" class="btn btn-success" id="btn-submit" style="display:none;">
                        Record & Begin Funeral
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

















@endsection

@push('scripts')
    {{-- These are for bootstrap 5 datatables --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables -->
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <!-- Include Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Include DataTables Bootstrap 5 integration -->
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>



    <style>
        .search-result-item:hover {
            background-color: #f0f4ff !important; /* Adjust this color to your desired light primary hover color */
        }
    </style>
    


    

  
    <script>
 $(document).ready(function() {
    var stepper = document.querySelector('#kt_stepper_example_modal');
    var stepperObj = KTStepper.getInstance(stepper);
    if (!stepperObj) {
        stepperObj = new KTStepper(stepper);
    }

    // Set the CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Search input event listener
    $('#person-search-input').on('input', function() {
        var query = $(this).val();
        if (query.length >= 2) {
            $('#search-image').hide(); // Hide search image when user starts typing
            $('#search-results').html('<span class="spinner-border"></span>');
            $.ajax({
                url: '{{ route("search.persons") }}',
                method: 'GET',
                data: { search: query },
                success: function(data) {
                    var results = data.results;
                    var html = '';

                    if (results.length > 0) {
                        results.forEach(function(person) {
                            var firstLetter = person.first_name.charAt(0);
                            html += `
                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1 search-result-item" data-id="${person.id}" data-name="${person.first_name} ${person.last_name}">
                                    <div class="symbol symbol-35px symbol-circle me-5">
                                        <span class="symbol-label bg-light-primary text-primary fw-semibold">${firstLetter}</span>
                                    </div>
                                    <div class="fw-semibold">
                                        <span class="fs-6 text-gray-800 me-2">${person.first_name} ${person.last_name}</span>
                                        <span class="badge badge-light">${person.id_number}</span>
                                    </div>
                                </a>
                            `;
                        });
                    } else {
                        html = '<div class="text-center">No results found.</div>';
                    }

                    $('#search-results').html(html);

                    // Attach click event to results
                    $('#search-results a').click(function() {
                        var personId = $(this).data('id');
                        console.log('Person clicked:', { id: personId, name: $(this).data('name') }); // Log person details
                        $('#deceased_id').val(personId);
                        fetchPersonDetails(personId);
                    });
                },
                error: function() {
                    $('#search-results').html('<div class="text-center">An error occurred. Please try again.</div>');
                }
            });
        } else {
            $('#search-image').show();
            $('#search-results').empty();
        }
    });

    function fetchPersonDetails(personId) {
    var url = '{{ route("person.details.ajax", ":id") }}';
    url = url.replace(':id', personId);
    console.log('Fetching details for URL:', url); // Log the URL

    $.ajax({
        url: url,
        method: 'GET',
        success: function(data) {
            console.log('Person details received:', data); // Log the received data
            $('#deceased_id').val(data.id);
            $('#deceased_name').val(data.name);
            $('#deceased_initials').val(data.initials);
            $('#deceased_surname').val(data.surname);
            
           // Ensure `deceased_id_number` exists before setting the value
           var idNumberField = $('#deceased_id_number');
            if (idNumberField.length) {
                idNumberField.val(data.id_number);

                // Automatically set the birthdate based on the ID number
                if (data.id_number && data.id_number.length === 13) {
                    extractBirthDateFromID(data.id_number, 'deceased_birth_date');
                }
            } else {
                console.error("Element with ID 'deceased_id_number' not found.");
            }

            $('#deceased_birth_date').val(data.birth_date);
            $('#deceased_age').val(data.age);
            $('#deceased_sex').val(data.sex);
            $('#deceased_marital_status').val(data.marital_status_id);

            // Move to the next step and update the stepper state
            stepperObj.goNext();
            var currentStep = $('.current[data-kt-stepper-element="content"]');
            currentStep.removeClass('current');
            currentStep.next().addClass('current');
            console.log('Automatically moved to the next step');
            
            var stepIndex = stepperObj.getCurrentStepIndex();
            var totalSteps = stepper.querySelectorAll('[data-kt-stepper-element="content"]').length;
            console.log('Step Index:', stepIndex);
            console.log('Total Steps:', totalSteps);

            if (stepIndex === totalSteps) { // Adjusted for 1-based index
                $('#btn-next').hide();
                $('#btn-submit').show();
                console.log('Submit button shown');
            } else {
                $('#btn-next').show();
                $('#btn-submit').hide();
                console.log('Continue button shown');
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was an error fetching the person details. Please try again.',
            });
        }
    });
}


    $('#btn-next').click(function() {
        console.log('Next button clicked');
        var currentStep = $('.current[data-kt-stepper-element="content"]');
        var valid = true;

        currentStep.find('input[required], select[required]').each(function() {
            if ($(this).val() === '') {
                valid = false;
                return false;
            }
        });

        if (!valid) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all required fields before continuing!',
            });
        } else {
            console.log('Current step before moving next:', stepperObj.getCurrentStepIndex());
            stepperObj.goNext();
            currentStep.removeClass('current');
            currentStep.next().addClass('current');
            console.log('Current step after moving next:', stepperObj.getCurrentStepIndex());

            var stepIndex = stepperObj.getCurrentStepIndex();
            var totalSteps = stepper.querySelectorAll('[data-kt-stepper-element="content"]').length;
            console.log('Step Index:', stepIndex);
            console.log('Total Steps:', totalSteps);

            if (stepIndex === totalSteps) { // Adjusted for 1-based index
                $('#btn-next').hide();
                $('#btn-submit').show();
                console.log('Submit button shown');
            } else {
                $('#btn-next').show();
                $('#btn-submit').hide();
                console.log('Continue button shown');
            }
        }
    });

    $('[data-kt-stepper-action="previous"]').click(function() {
        console.log('Previous button clicked');
        var currentStep = $('.current[data-kt-stepper-element="content"]');
        stepperObj.goPrevious();
        currentStep.removeClass('current');
        currentStep.prev().addClass('current');
        console.log('Current step after moving previous:', stepperObj.getCurrentStepIndex());

        var stepIndex = stepperObj.getCurrentStepIndex();
        console.log('Step Index:', stepIndex);
        $('#btn-submit').hide();
        $('#btn-next').show();
        console.log('Continue button shown');
    });

    // Prevent the modal from closing on button click
    $('#btn-next, #btn-submit').on('click', function(event) {
        event.preventDefault();
    });

    // Handle form submission
    $('#btn-submit').click(function() {
        var formData = {
            deceased_id: $('#deceased_id').val(),
            reporter_name: $('#reporter_name').val(),
            reporter_surname: $('#reporter_surname').val(),
            reporter_tel: $('#reporter_tel').val(),
            reporter_whatsapp: $('#reporter_whatsapp').val(),
            reporter_email: $('#reporter_email').val(),
            tracking_number: $('#tracking_number').val(),
            deceased_name: $('#deceased_name').val(),
            deceased_initials: $('#deceased_initials').val(),
            deceased_surname: $('#deceased_surname').val(),
            deceased_maiden_name: $('#deceased_maiden_name').val(),
            deceased_address: $('#deceased_address').val(),
            deceased_address_line1: $('#deceased_address_line1').val(),
            deceased_address_line2: $('#deceased_address_line2').val(),
            deceased_address_postalCode: $('#deceased_address_postalCode').val(),
            deceased_address_city: $('#deceased_address_city').val(),
            deceased_address_townSuburb: $('#deceased_address_townSuburb').val(),
            deceased_address_province: $('#deceased_address_province').val(),
            deceased_address_country: $('#deceased_address_country').val(),
            deceased_place_of_death_placeName: $('#deceased_place_of_death_placeName').val(),
            deceased_id_number: $('#deceased_id_number').val(),
            deceased_birth_date: $('#deceased_birth_date').val(),
            deceased_age: $('#deceased_age').val(),
            deceased_birth_town: $('#deceased_birth_town').val(),
            deceased_birth_town_line1: $('#deceased_birth_town_line1').val(),
            deceased_birth_town_line2: $('#deceased_birth_town_line2').val(),
            deceased_birth_town_postalCode: $('#deceased_birth_town_postalCode').val(),
            deceased_birth_town_city: $('#deceased_birth_town_city').val(),
            deceased_birth_town_townSuburb: $('#deceased_birth_town_townSuburb').val(),
            deceased_birth_town_province: $('#deceased_birth_town_province').val(),
            deceased_birth_town_country: $('#deceased_birth_town_country').val(),
            deceased_birth_town_placeName: $('#deceased_birth_town_placeName').val(),
            deceased_sex: $('#deceased_sex').val(),
            deceased_marital_status: $('#deceased_marital_status').val(),
            deceased_language: $('#deceased_language').val(),
            deceased_occupation: $('#deceased_occupation').val(),
            deceased_dr_number: $('#deceased_dr_number').val(),
            deceased_date_of_death: $('#deceased_date_of_death').val(),
            deceased_place_of_death: $('#deceased_place_of_death').val(),
            deceased_place_of_death_line1: $('#deceased_place_of_death_line1').val(),
            deceased_place_of_death_line2: $('#deceased_place_of_death_line2').val(),
            deceased_place_of_death_postalCode: $('#deceased_place_of_death_postalCode').val(),
            deceased_place_of_death_city: $('#deceased_place_of_death_city').val(),
            deceased_place_of_death_townSuburb: $('#deceased_place_of_death_townSuburb').val(),
            deceased_place_of_death_province: $('#deceased_place_of_death_province').val(),
            deceased_place_of_death_country: $('#deceased_place_of_death_country').val(),
            deceased_doctor: $('#deceased_doctor').val()
        };
        console.log('Form data:', formData); // Log the form data

        $.ajax({
            url: '{{ route("deaths.store") }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log('Form submitted successfully');
                // Handle success, e.g., close the modal, show a success message, etc.
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'The death record has been successfully submitted.',
                }).then(function() {
                    location.reload(); // Reload the page after success
                });
            },
            error: function(xhr, status, error) {
                console.log('Error submitting form');
                console.log('XHR:', xhr);
                console.log('Status:', status);
                console.log('Error:', error);
                // Handle error, e.g., show an error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error submitting the form. Please try again.',
                });
            }
        });
    });
});

    </script>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // initAutocomplete('deceased_place_of_death', { Line1: 'deceased_place_of_death' }); // Minimal setup with only one field
            
            // Google setup for deceased_address
             initAutocomplete('deceased_address', {
                 Line1: 'deceased_address_line1',
                 Line2: 'deceased_address_line2',
                 PostalCode: 'deceased_address_postalCode',
                 City: 'deceased_address_city',
                 TownSuburb: 'deceased_address_townSuburb',
                 Province: 'deceased_address_province',
                 Country: 'deceased_address_country',
                 PlaceName: 'deceased_address_placeName'
             });

             // Google setup for deceased_birth_town
             initAutocomplete('deceased_birth_town', {
                 Line1: 'deceased_birth_town_line1',
                 Line2: 'deceased_birth_town_line2',
                 PostalCode: 'deceased_birth_town_postalCode',
                 City: 'deceased_birth_town_city',
                 TownSuburb: 'deceased_birth_town_townSuburb',
                 Province: 'deceased_birth_town_province',
                 Country: 'deceased_birth_town_country',
                 PlaceName: 'deceased_birth_town_placeName'
             });

            // Google setup for deceased_place_of_death
             initAutocomplete('deceased_place_of_death', {
                 Line1: 'deceased_place_of_death_line1',
                 Line2: 'deceased_place_of_death_line2',
                 PostalCode: 'deceased_place_of_death_postalCode',
                 City: 'deceased_place_of_death_city',
                 TownSuburb: 'deceased_place_of_death_townSuburb',
                 Province: 'deceased_place_of_death_province',
                 Country: 'deceased_place_of_death_country',
                 PlaceName: 'deceased_place_of_death_placeName'
             });
        });
        </script> 
    
    
    
    
    
    
    

    <script>
function extractBirthDateFromID(IDNumber, birthDateFieldId) {
    console.log("extractBirthDateFromID called with IDNumber:", IDNumber, "and field ID:", birthDateFieldId);

    // Get the birth date field element
    var birthDateField = document.getElementById(birthDateFieldId);

    // Check if the element exists
    if (!birthDateField) {
        console.error("Element with ID '" + birthDateFieldId + "' not found. Cannot proceed with setting the birth date.");
        return;
    }

    // Validate length and numeric
    if (IDNumber.length == 13 && !isNaN(IDNumber)) {
        // Extract date parts
        var year = IDNumber.substring(0, 2);
        var month = IDNumber.substring(2, 4);
        var day = IDNumber.substring(4, 6);

        // Determine century
        var currentYear = new Date().getFullYear() % 100;
        var century = (parseInt(year) > currentYear) ? '19' : '20';
        var fullYear = century + year;

        // Validate date
        var tempDate = new Date(fullYear, parseInt(month) - 1, parseInt(day));

        if (
            tempDate &&
            tempDate.getFullYear() == fullYear &&
            tempDate.getMonth() + 1 == parseInt(month) &&
            tempDate.getDate() == parseInt(day)
        ) {
            // Valid date
            var birthDateStr = fullYear + '-' + month.padStart(2, '0') + '-' + day.padStart(2, '0'); // Format: YYYY-MM-DD
            console.log("Setting birth date field value to:", birthDateStr); // Log the value being set

            // Set the value using the same approach that worked for you
            birthDateField.value = birthDateStr;

          
        } else {
            console.error("Invalid date extracted from ID number.");
        }
    } else {
        console.error("Invalid ID number length or non-numeric ID number.");
    }
}



            </script>
    
    
    
    
    
    
    




    {{-- <script>
        $(document).ready(function() {
            // Initialize the DataTable with custom configuration
            var table = $("#funerals").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_ entries",
                },
                "dom":
                    "<'row mb-2'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
                    ">" +
                    "<'table-responsive'tr>" +
                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });
        
            // Event listener for the status filter
            $('#statusFilter').on('change', function() {
                // Apply search on the status column (assuming status is the 5th column, index 4)
                table.column(4).search(this.value).draw();
            });
        });
        </script> --}}



    {{-- <script>
    "use strict";

// Class definition
var KTDatatablesExample = function () {
    // Shared variables
    var table;
    var datatable;

    // Private functions
    var initDatatable = function () {
        // Set date data order
        const tableRows = table.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            const dateRow = row.querySelectorAll('td');
            const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
            dateRow[3].setAttribute('data-order', realDate);
        });

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
        });
    }

    // Hook export buttons
    var exportButtons = () => {
        const documentTitle = 'Customer Orders Report';
        var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [
                {
                    extend: 'copyHtml5',
                    title: documentTitle
                },
                {
                    extend: 'excelHtml5',
                    title: documentTitle
                },
                {
                    extend: 'csvHtml5',
                    title: documentTitle
                },
                {
                    extend: 'pdfHtml5',
                    title: documentTitle
                }
            ]
        }).container().appendTo($('#kt_datatable_example_buttons'));

        // Hook dropdown menu click event to datatable export buttons
        const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
        exportButtons.forEach(exportButton => {
            exportButton.addEventListener('click', e => {
                e.preventDefault();

                // Get clicked export value
                const exportValue = e.target.getAttribute('data-kt-export');
                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                // Trigger click event on hidden datatable export buttons
                target.click();
            });
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function () {
            table = document.querySelector('#funerals');

            if ( !table ) {
                return;
            }

            initDatatable();
            exportButtons();
            handleSearchDatatable();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesExample.init();
});
</script> --}}












    {{-- <script>
"use strict";

var KTFuneralsDatatables = function () {
    var dt;

    var initDatatable = function () {
        dt = $("#funerals").DataTable({
            searchDelay: 500,
            order: [],
            dom: "<'row'<'col-sm-12'tr>>" + // Only the table and rows
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // Info and pagination
            columnDefs: [
                { targets: 6, orderable: false }
            ]
        });
    };

    var handleSearch = function () {
        var searchInput = document.querySelector('[data-kt-docs-table-filter="search"]');
        searchInput.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    };

    var handleLengthChange = function () {
        var lengthSelect = document.getElementById('customLength');
        lengthSelect.addEventListener('change', function (e) {
            dt.page.len(e.target.value).draw();
        });
    };

    var handleFilter = function () {
        var filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');
        var resetButton = document.querySelector('[data-kt-docs-table-filter="reset"]');
        var statusRadios = document.querySelectorAll('[name="funeral_status"]');

        filterButton.addEventListener('click', function () {
            var filterValue = "";
            statusRadios.forEach(function(radio) {
                if (radio.checked) {
                    filterValue = radio.value;
                }
            });
            if (filterValue === "all") {
                filterValue = ""; // Reset the filter if 'All' is selected
            }
            // Debug log to check what is being set as filter value
            console.log("Filtering by:", filterValue);

            dt.columns(3).search(filterValue).draw(); // Assumes 'Status' is in the 4th column
        });

        resetButton.addEventListener('click', function () {
            statusRadios.forEach(function(radio) {
                radio.checked = radio.value === "all";
            });
            dt.search('').columns().search('').draw();
        });
    };

    return {
        init: function () {
            initDatatable();
            handleSearch();
            handleLengthChange();
            handleFilter();
        }
    };
}();

$(document).ready(function () {
    KTFuneralsDatatables.init();
});
</script> --}}







    {{-- START: This is for the table that groups by person --}}

    <script>
        "use strict";

        var KTMembershipsDatatables2 = function() {
            var dt;

            var initDatatable = function() {
    dt = $("#kt_datatable_row_grouping2").DataTable({
        searchDelay: 500,
        order: [],
        dom: "<'row'<'col-sm-12'tr>>" + // Only the table and rows
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // Info and pagination
        columnDefs: [{
                targets: 5,
                orderable: false
            } // Ensuring the Actions column is not orderable
        ],
        drawCallback: function(settings) {
            var api = this.api();
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;

            api.column(2, {
                page: 'current'
            }).data().each(function(group, i) {
                var row = $(rows).eq(i);
                var personId = row.data('person-id');
                var funeralId = row.data('funeral-id');
                var personDetails = row.data('person-details');

                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr class="group bg-light fs-6 fw-bold">' +
                        '<td colspan="5">' + personDetails + '</td>' +
                        '<td>' +
                        '<!--begin::Toolbar-->' +
                        '<div class="d-flex my-3 ms-9">' +
                        '<!--begin::Edit-->' +
                        '<a href="/funerals/edit/' + funeralId + '" class="btn btn-icon btn-light-primary btn-active-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Edit">' +
                        '<i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>' +
                        '</a>' +
                        '<!--end::Edit-->' +
                        '<!--begin::Delete-->' +
                        '<form action="/funerals/destroy/' + funeralId + '" method="POST" style="display:inline;">' +
                        '@csrf @method('DELETE')' +
                        '<button type="submit" class="btn btn-icon btn-light-danger btn-active-danger w-30px h-30px me-3" data-bs-toggle="tooltip" title="Delete">' +
                        '<i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>' +
                        '</button>' +
                        '</form>' +
                        '<!--end::Delete-->' +
                        '<!--begin::More-->' +
                        '<button type="button" class="btn btn-icon btn-dark btn-active-light-dark w-30px h-30px" data-kt-menu-trigger="click" data-bs-toggle="tooltip" title="More Options" data-kt-menu-placement="bottom-start">' +
                        '<i class="ki-duotone ki-setting-3 fs-3 "><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>' +
                        '</button>' +
                        '<!--begin::Menu-->' +
                        '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">' +
                        '<!--begin::Menu item-->' +
                        '<div class="menu-item px-3">' +
                        '<a href="/funerals/index/' + funeralId + '" class="menu-link px-3" data-kt-payment-method-action="reburial">' +
                        'Reburial' +
                        '</a>' +
                        '</div>' +
                        '<!--end::Menu item-->' +
                        '</div>' +
                        '<!--end::Menu-->' +
                        '<!--end::More-->' +
                        '</div>' +
                        '<!--end::Toolbar-->' +
                        '</td>' +
                        '</tr>'
                    );

                    last = group;
                }
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Initialize KTMenu
            KTMenu.createInstances();
        }
    });

    console.log('DataTables detected columns:', dt.columns().header().length);
};

            var handleSearch = function() {
                var searchInput = document.querySelector('[data-kt-docs-table-filter="search2"]');
                if (searchInput) {
                    searchInput.addEventListener('keyup', function(e) {
                        dt.search(e.target.value).draw();
                    });
                }
            };

            var handleLengthChange = function() {
                var lengthSelect = document.getElementById('customLength2');
                if (lengthSelect) {
                    lengthSelect.addEventListener('change', function(e) {
                        dt.page.len(e.target.value).draw();
                    });
                }
            };

            var handleFilter = function() {
                var filterButton = document.querySelector('[data-kt-docs-table-filter="filter2"]');
                var resetButton = document.querySelector('[data-kt-docs-table-filter="reset2"]');
                var statusRadios = document.querySelectorAll('[name="membership_status2"]');

                if (filterButton) {
                    filterButton.addEventListener('click', function() {
                        var filterValue = "";
                        statusRadios.forEach(function(radio) {
                            if (radio.checked) {
                                filterValue = radio.value;
                            }
                        });
                        if (filterValue === "all") {
                            filterValue = ""; // Reset the filter if 'All' is selected
                        }

                        dt.columns(3).search(filterValue)
                            .draw(); // Assumes 'Membership Status' is in the 4th column
                    });
                }

                if (resetButton) {
                    resetButton.addEventListener('click', function() {
                        statusRadios.forEach(function(radio) {
                            radio.checked = radio.value === "all";
                        });
                        dt.search('').columns().search('').draw();
                    });
                }
            };

            return {
                init: function() {
                    initDatatable();
                    handleSearch();
                    handleLengthChange();
                    handleFilter();
                }
            };
        }();

        $(document).ready(function() {
            KTMembershipsDatatables2.init();
        });
    </script>

    {{-- END: This is for the table that groups by person --}}

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script>
        function toggleDetails(selector) {
            $(selector).slideToggle('slow');
        }
    </script>
@endpush
