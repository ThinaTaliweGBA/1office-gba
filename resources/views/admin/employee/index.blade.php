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

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 CSS and JS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>





    <style>
        .menu-sub-dropdown {
            background-color: #ffffff !important;
        }

        .page-link.active,
        .active>.page-link {
            background-color: #131628 !important;
        }
    </style>


    {{-- chekbox style --}}
    <style>
        .styled-checkbox {
            display: none;
            /* Hide default checkbox */
        }

        .styled-checkbox+.styled-checkbox-label {
            display: inline-block;
            background-color: #ff0000;
            /* Red background color */
            color: #fff;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            text-align: center;
            border: 2px solid transparent;
            /* Add a border */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Add a shadow */
            margin-top: 5px;
            /* Add margin to separate from the label above */
        }

        /* Change background and border color on hover to make it obvious it's clickable */
        .styled-checkbox+.styled-checkbox-label:hover {
            background-color: #ff4d4d;
            /* Lighter red for hover effect */
            border-color: #ff0000;
            /* Red border color on hover */
        }

        /* Style for when the checkbox is checked */
        .styled-checkbox:checked+.styled-checkbox-label {
            background-color: #28a745;
            /* Green background when checked */
            border-color: #28a745;
            /* Green border when checked */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            /* Slightly stronger shadow */
        }

        /* Hover effect for checked state */
        .styled-checkbox:checked+.styled-checkbox-label:hover {
            background-color: #5cb85c;
            /* Lighter green for hover effect when checked */
            border-color: #28a745;
            /* Green border color */
        }
    </style>
@endpush

@section('row_content')



    <div class="card my-10 shadow">
        <div class="card-header">
            <h2 class="card-title text-dark fs-3 mx-auto">Employees</h2>
        </div>

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

        <div class="card-body">

            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-wrap mb-5">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!-- Custom Length Control with Dropdown Arrow -->
                    <div class="position-relative">
                        <select class="form-control form-control-solid w-70px me-2 bg-secondary" id="customLength">
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
                        <input type="text" data-kt-docs-table-filter="search"
                            class="form-control form-control-solid w-250px ps-15 bg-secondary"
                            placeholder="Search Employees" />
                    </div>
                </div>

                <!--end::Search-->

                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                    <!--begin::Filter-->
                    <button type="button" class="btn btn-light me-3 bg-secondary" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                        Filter
                    </button>
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                        id="kt-toolbar-filter">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-4 text-gray-900 fw-bold">Filter Options</div>
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
                                <label class="form-label fs-5 fw-semibold mb-3">Employee Status:</label>
                                <!--end::Label-->

                                <!--begin::Options-->
                                <div class="d-flex flex-column flex-wrap fw-semibold"
                                    data-kt-docs-table-filter="funeral_status">
                                    <!--begin::Option-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                        <input class="form-check-input" type="radio" name="funeral_status" value="all"
                                            checked="checked" />
                                        <span class="form-check-label text-gray-600">
                                            All
                                        </span>
                                    </label>
                                    <!--end::Option-->

                                    <!--begin::Option-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                        <input class="form-check-input" type="radio" name="funeral_status"
                                            value="Pending" />
                                        <span class="form-check-label text-gray-600">
                                            Pending
                                        </span>
                                    </label>
                                    <!--end::Option-->

                                    <!--begin::Option-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                        <input class="form-check-input" type="radio" name="funeral_status"
                                            value="Completed" />
                                        <span class="form-check-label text-gray-600">
                                            Completed
                                        </span>
                                    </label>
                                    <!--end::Option-->

                                </div>
                                <!--end::Options-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-light btn-active-light-dark me-2"
                                    data-kt-menu-dismiss="true" data-kt-docs-table-filter="reset">Reset</button>

                                <button type="submit" class="btn btn-dark" data-kt-menu-dismiss="true"
                                    data-kt-docs-table-filter="filter">Apply</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Menu 1--> <!--end::Filter-->

                    <!--begin::Add customer-->
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#record_employee_modal">
                        <i class="ki-duotone ki-plus fs-2"></i> Add Employee
                    </button>
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->

            </div>
            <!--end::Wrapper-->
            <table id="employees" class="table table-rounded fs-6 g-5 gs-5">
                <thead>
                    <tr class="text-start text-dark fw-normal fs-8 text-uppercase bg-gray-200">
                        <th>Actions</th>
                        <th>Full Name</th>
                        <th>Call Name</th>
                        <th>Employee Number</th>
                        <th>BU</th>
                        <th>Employement Type</th>
                        <th>Employement Start-Date</th>
                        <th>Employement End-Date</th>
                        <th>Job Description</th>
                        <th>Role</th>
                        <th>Company</th>
                        <th>Shiftwork</th>
                        <th>Standard Start Time</th>
                        <th>Standard End Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td class="d-flex align-items-center">
                                <button class="btn btn-sm btn-icon btn-primary btn-edit me-2"
                                    data-employee-id="{{ $employee->id }}">
                                    <i class="bi bi-pencil-fill fs-4 me-0"></i>
                                </button>
                                <form action="{{ route('employee.destroy', $employee->id) }}" method="POST"
                                    style="display:inline-block; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-sm btn-danger">
                                        <i class="bi bi-trash3 fs-4 me-0"></i>
                                    </button>
                                </form>
                            </td>
                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                            <td>{{ $employee->call_name }}</td>
                            <td>{{ $employee->emp_number }}</td>
                            <td>{{ $employee->businessUnit->bu_name ?? 'N/A' }}</td>
                            <td>{{ $employee->employmentType->type ?? 'N/A' }}</td>
                            <td>{{ $employee->start_date ? \Carbon\Carbon::parse($employee->start_date)->format('Y-m-d') : 'N/A' }}
                            </td>
                            <td>{{ $employee->end_date ? \Carbon\Carbon::parse($employee->end_date)->format('Y-m-d') : 'N/A' }}
                            </td>
                            <td>{{ $employee->jobDescription->name ?? 'N/A' }}</td>
                            <td>{{ $employee->role->name ?? 'N/A' }}</td>
                            <td>{{ $employee->company->name ?? 'N/A' }}</td>
                            <td>{{ $employee->shiftwork ? 'Yes' : 'No' }}</td>
                            <td>{{ $employee->standard_starttime }}</td>
                            <td>{{ $employee->standard_endtime }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-start text-dark fw-normal fs-8 text-uppercase bg-gray-200">
                        <th>Actions</th>
                        <th>Full Name</th>
                        <th>Call Name</th>
                        <th>Employee Number</th>
                        <th>BU</th>
                        <th>Employement Type</th>
                        <th>Employement Start-Date</th>
                        <th>Employement End-Date</th>
                        <th>Job Description</th>
                        <th>Role</th>
                        <th>Company</th>
                        <th>Shiftwork</th>
                        <th>Standard Start Time</th>
                        <th>Standard End Time</th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>

    <!-- Start Employee Modal -->
    <div class="modal fade" tabindex="-1" id="record_employee_modal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="employeeModalTitle">Record Employee</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-dark ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <form id="storeEmployee" method="POST" action="{{ route('employee.store') }}">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="modal-body">
                        <div class="pt-4 p-3">
                            <h4 class="mb-3">Details of Employee:</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="person_id" class="form-label">Person</label>
                                    <select class="form-select bg-light text-dark" id="person_id" name="person_id"
                                        required style="width: 100%;">
                                        <option></option> <!-- Empty option for the placeholder -->
                                        @foreach ($persons as $person)
                                            <option value="{{ $person->id }}"
                                                data-first-name="{{ $person->first_name }}"
                                                data-last-name="{{ $person->last_name }}">
                                                {{ $person->first_name }} - {{ $person->initials }} -
                                                {{ $person->last_name }} - {{ $person->birth_date ?? 'No DOB' }} -
                                                {{ $person->id_number ?? 'No ID#' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="employee_first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control bg-light text-dark"
                                        id="employee_first_name" name="first_name" required>
                                </div>
                                <div class="col">
                                    <label for="employee_last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control bg-light text-dark" id="employee_last_name"
                                        name="last_name" required>
                                </div>
                                <div class="col">
                                    <label for="call_name" class="form-label">Call Name</label>
                                    <input type="text" class="form-control bg-light text-dark" id="call_name"
                                        name="call_name">
                                </div>
                                <div class="col">
                                    <label for="emp_number" class="form-label">Employee Number</label>
                                    <input type="text" class="form-control bg-light text-dark" id="emp_number"
                                        name="emp_number">
                                </div>
                            </div>

                            <div class="separator border-light my-8"></div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="bu_id" class="form-label">Business Unit</label>
                                    <select class="form-select bg-light text-dark" id="bu_id" name="bu_id" required
                                        style="width: 100%;">
                                        @foreach ($businessUnits as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->bu_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="employment_type_id" class="form-label">Employment Type</label>
                                    <select class="form-select bg-light text-dark" id="employment_type_id"
                                        name="employment_type_id" required style="width: 100%;">
                                        @foreach ($employmentTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="datetime-local" class="form-control bg-light text-dark" id="start_date"
                                        name="start_date" required placeholder="Date & Time">
                                </div>
                                <div class="col">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="datetime-local" class="form-control bg-light text-dark" id="end_date"
                                        name="end_date" placeholder="Date & Time">
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="job_description_id" class="form-label">Job Description</label>
                                    <select class="form-select bg-light text-dark" id="job_description_id"
                                        name="job_description_id" required style="width: 100%;">
                                        @foreach ($jobDescriptions as $job)
                                            <option value="{{ $job->id }}">{{ $job->name }} -
                                                {{ $job->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="role_id" class="form-label">Role</label>
                                    <select class="form-select bg-light text-dark" id="role_id" name="role_id" required
                                        style="width: 100%;">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="company_id" class="form-label">Company</label>
                                    <select class="form-select bg-light text-dark" id="company_id" name="company_id"
                                        required style="width: 100%;">
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="col d-flex flex-column align-items-center">
                                <label for="shiftwork" class="form-label">Shiftwork?</label>
                                <input type="checkbox" class="styled-checkbox" id="shiftwork" name="shiftwork">
                                <label for="shiftwork" class="styled-checkbox-label" id="shiftworkLabel">No</label>
                            </div> --}}
                                <div class="col d-flex flex-column align-items-center">
                                    <label class="form-label">Shiftwork?</label>
                                    <div class="d-flex fs-3 mx-auto my-auto">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="shiftwork"
                                                id="shiftworkYes" value="yes">
                                            <label class="form-check-label" for="shiftworkYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="shiftwork"
                                                id="shiftworkNo" value="no" checked>
                                            <label class="form-check-label" for="shiftworkNo">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="standard_starttime" class="form-label">Standard Start Time</label>
                                    <input type="time" class="form-control bg-light text-dark" id="standard_starttime"
                                        name="standard_starttime" placeholder="Start Time">
                                </div>
                                <div class="col">
                                    <label for="standard_endtime" class="form-label">Standard End Time</label>
                                    <input type="time" class="form-control bg-light text-dark"
                                        id="standard_endtime" name="standard_endtime" placeholder="End Time">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="storeEmployeeBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Employee Modal -->



    <!-- Add New Person Modal -->
    <div class="modal fade" tabindex="-1" id="add_person_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title ">Add New Person</h3>
                    <div class="btn btn-dark btn-icon btn-sm btn-active-light-dark ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <form id="addPersonForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="first_name_add">First Name</label>
                            <input type="text" class="form-control bg-light text-dark" id="first_name_add"
                                name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="initials">Initials</label>
                            <input type="text" class="form-control bg-light text-dark" id="initials"
                                name="initials">
                        </div>
                        <div class="form-group">
                            <label for="last_name_add">Last Name</label>
                            <input type="text" class="form-control bg-light text-dark" id="last_name_add"
                                name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="screen_name">Screen Name</label>
                            <input type="text" class="form-control bg-light text-dark" id="screen_name"
                                name="screen_name">
                        </div>
                        <div class="form-group">
                            <label for="id_number">ID Number</label>
                            <input type="text" class="form-control bg-light text-dark" id="id_number"
                                name="id_number">
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Birth Date</label>
                            <input type="date" class="form-control bg-light text-dark" id="birth_date"
                                name="birth_date">
                        </div>
                        {{-- <div class="form-group">
                        <label for="marriage_status_id" >Marital Status</label>
                        <select class="form-select bg-light text-dark" id="marriage_status_id" name="marriage_status_id">
                            <option value="1">Single</option>
                            <option value="2">Married</option>
                            <option value="3">Divorced</option>
                            <option value="4">Widowed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gender_id" >Gender</label>
                        <select class="form-select bg-light text-dark" id="gender_id" name="gender_id">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Other</option>
                        </select>
                    </div> --}}
                        <div class="form-group">
                            <label for="residence_country_id">Residence Country</label>
                            <select class="form-select bg-light text-dark" id="residence_country_id"
                                name="residence_country_id">
                                <option value="197">South Africa</option>
                                <!-- Add other countries as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection

@push('scripts')
    {{-- These are for bootstrap 5 datatables --}}

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- Include DataTables -->
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <!-- Include Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Include DataTables Bootstrap 5 integration -->
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>

    {{-- Shift work checkbox button  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shiftworkCheckbox = document.getElementById('shiftwork');
            const shiftworkLabel = document.getElementById('shiftworkLabel');

            shiftworkCheckbox.addEventListener('change', function() {
                if (shiftworkCheckbox.checked) {
                    shiftworkLabel.textContent = 'Yes';
                    shiftworkLabel.style.backgroundColor = '#28a745'; // Green background
                } else {
                    shiftworkLabel.textContent = 'No';
                    shiftworkLabel.style.backgroundColor = '#ff0000'; // Red background
                }
            });

            // Initialize the label based on the checkbox state
            if (shiftworkCheckbox.checked) {
                shiftworkLabel.textContent = 'Yes';
                shiftworkLabel.style.backgroundColor = '#28a745'; // Green background
            } else {
                shiftworkLabel.textContent = 'No';
                shiftworkLabel.style.backgroundColor = '#ff0000'; // Red background
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.btn-edit');
            const modal = document.querySelector('#record_employee_modal');
            const form = modal.querySelector('form');
            const modalTitle = document.querySelector('#employeeModalTitle');
            const submitButton = document.querySelector('#storeEmployeeBtn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const employeeId = this.dataset.employeeId;
                    console.log('Edit button clicked for employee ID:',
                        employeeId); // Debugging line

                    fetch(`/admin/employee/${employeeId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            console.log('Data received for employee:', data); // Debugging line

                            form.setAttribute('action', `/admin/employee/${employeeId}`);
                            form.querySelector('input[name="_method"]').value = 'PUT';
                            modalTitle.textContent = 'Edit Employee';
                            submitButton.textContent = 'Update';

                            console.log('Setting form values with received data');
                            $('#employee_first_name').val(data.first_name);
                            $('#employee_last_name').val(data.last_name);
                            form.querySelector('input[name="call_name"]').value = data
                                .call_name;
                            form.querySelector('input[name="emp_number"]').value = data
                                .emp_number;
                            form.querySelector('select[name="bu_id"]').value = data.bu_id;
                            form.querySelector('select[name="employment_type_id"]').value = data
                                .employment_type_id;
                            form.querySelector('input[name="start_date"]').value = data
                                .start_date;
                            form.querySelector('input[name="end_date"]').value = data.end_date;
                            form.querySelector('select[name="job_description_id"]').value = data
                                .job_description_id;
                            form.querySelector('select[name="role_id"]').value = data.role_id;
                            form.querySelector('select[name="company_id"]').value = data
                                .company_id;
                            form.querySelector('input[name="shiftwork"]').checked = data
                                .shiftwork;
                            form.querySelector('input[name="standard_starttime"]').value = data
                                .standard_starttime;
                            form.querySelector('input[name="standard_endtime"]').value = data
                                .standard_endtime;

                            console.log('Setting person select value and triggering change');
                            const personSelect = $('#person_id');
                            personSelect.val(data.person_id).trigger('change');

                            new bootstrap.Modal(modal).show();
                        })
                        .catch(error => {
                            console.error('Error fetching employee data:',
                                error); // Debugging line
                        });
                });
            });

            // Reset modal for creating new employee
            const createButton = document.querySelector('#createEmployeeBtn');
            if (createButton) {
                createButton.addEventListener('click', function() {
                    form.setAttribute('action', '{{ route('employee.store') }}');
                    form.querySelector('input[name="_method"]').value = 'POST';
                    modalTitle.textContent = 'Record Employee';
                    submitButton.textContent = 'Save';

                    console.log('Clearing form values for new employee');
                    $('#employee_first_name').val('');
                    $('#employee_last_name').val('');
                    form.querySelector('input[name="call_name"]').value = '';
                    form.querySelector('input[name="emp_number"]').value = '';
                    form.querySelector('select[name="bu_id"]').value = '';
                    form.querySelector('select[name="employment_type_id"]').value = '';
                    form.querySelector('input[name="start_date"]').value = '';
                    form.querySelector('input[name="end_date"]').value = '';
                    form.querySelector('select[name="job_description_id"]').value = '';
                    form.querySelector('select[name="role_id"]').value = '';
                    form.querySelector('select[name="company_id"]').value = '';
                    form.querySelector('input[name="shiftwork"]').checked = false;
                    form.querySelector('input[name="standard_starttime"]').value = '';
                    form.querySelector('input[name="standard_endtime"]').value = '';

                    $('#person_id').val(null).trigger('change'); // Clear the person_id select

                    new bootstrap.Modal(modal).show();
                });
            }
        });
    </script>






    <!-- Initialize Select2 and adding of button to select2 -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const employeeModal = new bootstrap.Modal(document.getElementById('record_employee_modal'), {
                focus: false
            });
            const personModal = new bootstrap.Modal(document.getElementById('add_person_modal'), {
                focus: false
            });

            let openModals = [];

            // Utility function to capitalize the first letter of a string
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
            }

            // Function to format the name fields before submission
            function formatNameFields(form) {
                form.find('input[id="first_name_add"]').val(function(i, val) {
                    return capitalizeFirstLetter(val);
                });
                form.find('input[id="last_name_add"]').val(function(i, val) {
                    return capitalizeFirstLetter(val);
                });
                form.find('input[id="initials"]').val(function(i, val) {
                    return val.toUpperCase();
                });
            }

            // Initialize Select2
            $('#person_id').select2({
                placeholder: "Select a person",
                allowClear: true,
                dropdownParent: $('#record_employee_modal'),
                language: {
                    noResults: function() {
                        return 'No results found';
                    }
                },
                escapeMarkup: function(markup) {
                    return markup;
                }
            }).on('select2:open', function() {
                console.log('Select2 dropdown opened');
                // Append the button to the dropdown
                if (!document.getElementById('add-new-person-btn')) {
                    let buttonHtml =
                        '<div class="select2-add-button-container" style="text-align: center; padding: 10px;">' +
                        '<button type="button" class="btn btn-primary btn-sm mt-2" id="add-new-person-btn">Add New Person</button>' +
                        '</div>';
                    $('.select2-results__options').after(buttonHtml);
                }
                $('.select2-search__field').focus(); // Ensure search field is focused when opened
            }).on('change', function() {
                const selectedOption = $(this).find(':selected');
                const firstName = selectedOption.data('first-name') || '';
                const lastName = selectedOption.data('last-name') || '';

                console.log('Selected Option:', selectedOption); // Debugging
                console.log('First Name:', firstName); // Debugging
                console.log('Last Name:', lastName); // Debugging

                $('#employee_first_name').val(firstName);
                $('#employee_last_name').val(lastName);
            });

            // Handle click on the "Add New Person" button
            $(document).on('click', '#add-new-person-btn', function() {
                console.log('Add New Person button clicked');
                employeeModal.hide();
                personModal.show();
            });

            // Handle form submission for adding a new person
            $('#addPersonForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                console.log('Add Person form submitted');

                // Format name fields
                formatNameFields(form);

                $.ajax({
                    type: 'POST',
                    url: '{{ route('person.store') }}',
                    data: form.serialize(),
                    success: function(response) {
                        console.log('Person added successfully', response);
                        if (response.success) {
                            var newPerson = response.person;
                            var newOption = new Option(newPerson.first_name + ' - ' + newPerson
                                .initials + ' - ' + newPerson.last_name + ' - ' + newPerson
                                .birth_date + ' - ' + newPerson.id_number, newPerson.id,
                                false, true);
                            $('#person_id').append(newOption).trigger('change');
                            $('#employee_first_name').val(newPerson
                                .first_name); // Populate the first name field
                            $('#employee_last_name').val(newPerson
                                .last_name); // Populate the last name field
                            personModal.hide();
                            employeeModal.show();
                        }
                    },
                    error: function(response) {
                        console.log('Error adding person', response);
                    }
                });
            });

            // Handle form submission for the employee modal
            $('#storeEmployee').on('submit', function(e) {
                // Format name fields
                formatNameFields($(this));
            });

            // Ensure the first modal stays open when the second is shown and closed
            $('#add_person_modal').on('shown.bs.modal', function() {
                console.log('Add Person modal shown');
                if (!openModals.includes('#add_person_modal')) {
                    openModals.push('#add_person_modal');
                }
                var zIndex = 1040 + (10 * openModals.length);
                $(this).css('z-index', zIndex);
                setTimeout(function() {
                    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass(
                        'modal-stack');
                }, 0);
            }).on('hidden.bs.modal', function() {
                console.log('Add Person modal hidden');
                openModals = openModals.filter(modal => modal !== '#add_person_modal');
                if (openModals.length) {
                    $(document.body).addClass('modal-open');
                } else {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
                employeeModal.show();
            });

            $('#record_employee_modal').on('shown.bs.modal', function() {
                console.log('Employee modal shown');
                if (!openModals.includes('#record_employee_modal')) {
                    openModals.push('#record_employee_modal');
                }
                var zIndex = 1040 + (10 * openModals.length);
                $(this).css('z-index', zIndex);
                setTimeout(function() {
                    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass(
                        'modal-stack');
                }, 0);
            }).on('hidden.bs.modal', function() {
                console.log('Employee modal hidden');
                openModals = openModals.filter(modal => modal !== '#record_employee_modal');
                if (openModals.length) {
                    $(document.body).addClass('modal-open');
                } else {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            });
        });
    </script>



    <script>
        "use strict";

        var KTFuneralsDatatables = function() {
            var dt;

            var initDatatable = function() {
                dt = $("#employees").DataTable({
                    searchDelay: 500,
                    order: [],
                    dom: "<'row'<'col-sm-12'tr>>" + // Only the table and rows
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // Info and pagination
                    columnDefs: [{
                        targets: 6,
                        orderable: false
                    }]
                });
            };

            var handleSearch = function() {
                var searchInput = document.querySelector('[data-kt-docs-table-filter="search"]');
                searchInput.addEventListener('keyup', function(e) {
                    dt.search(e.target.value).draw();
                });
            };

            var handleLengthChange = function() {
                var lengthSelect = document.getElementById('customLength');
                lengthSelect.addEventListener('change', function(e) {
                    dt.page.len(e.target.value).draw();
                });
            };

            var handleFilter = function() {
                var filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');
                var resetButton = document.querySelector('[data-kt-docs-table-filter="reset"]');
                var statusRadios = document.querySelectorAll('[name="funeral_status"]');

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
                    // Debug log to check what is being set as filter value
                    console.log("Filtering by:", filterValue);

                    dt.columns(3).search(filterValue).draw(); // Assumes 'Status' is in the 4th column
                });

                resetButton.addEventListener('click', function() {
                    statusRadios.forEach(function(radio) {
                        radio.checked = radio.value === "all";
                    });
                    dt.search('').columns().search('').draw();
                });
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
            KTFuneralsDatatables.init();
        });
    </script>



    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script>
        function toggleDetails(selector) {
            $(selector).slideToggle('slow');
        }
    </script>

        {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#start_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                "locale": {
                    "firstDayOfWeek": 1 // start week on Monday
                }
            });

            flatpickr("#end_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                "locale": {
                    "firstDayOfWeek": 1 // start week on Monday
                }
            });

            flatpickr("#standard_endtime", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });

            flatpickr("#standard_starttime", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });

        });
    </script> --}}
@endpush
