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

    <div class="card my-8 shadow">
        <div class="card-header">
            <h3 class="card-title mx-auto">Roles</h3>
        </div>
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
                            class="form-control form-control-solid w-250px ps-15  bg-secondary"
                            placeholder="Search Employee Roles" />
                    </div>
                </div>

                <!--end::Search-->

                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                    <!--begin::Filter-->
                    <button type="button" class="btn btn-secondary me-3" data-kt-menu-trigger="click"
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
                                <label class="form-label fs-5 fw-semibold mb-3">Role Status:</label>
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
                        data-bs-target="#record_role_modal">
                        <i class="ki-duotone ki-plus fs-2"></i> Add Role
                    </button>
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->

            </div>
            <!--end::Wrapper-->
            <table id="roles" class="table table-rounded fs-6 g-2 gs-2">
                <thead>
                    <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-secondary">
                        <th>Actions</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Roles</th>
                        <th>BU</th>
                        <th>Created Date</th>
                        <th>Updated Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>
                                {{-- <button class="btn btn-sm btn-primary btn-edit"
                                    data-role-id="{{ $role->id }}">Edit</button> --}}
                                <a class="btn btn-sm btn-icon btn-edit btn-warning" data-role-id="{{ $role->id }}"
                                    style="text-decoration: none;" data-bs-toggle="tooltip" title="Edit"><i
                                        class="bi bi-pencil-fill fs-4 me-0"></i>
                                </a>
                                <form action="{{ route('employeerole.destroy', $role->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    {{-- <button type="submit" class="btn btn-sm btn-danger">Delete</button> --}}
                                    <button type="submit" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                        title="Remove" style="text-decoration: none;"><i
                                            class="bi bi-trash3 fs-4 me-0"></i>
                                    </button>
                                </form>
                            </td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                @php
                                    $roleList = [];
                                    foreach ($roleColumns as $roleKey => $roleName) {
                                        if ($role->$roleKey) {
                                            $roleList[] = $roleName;
                                        }
                                    }
                                @endphp
                                {{ implode(', ', $roleList) }}
                            </td>
                            <td>{{ $role->businessUnit->bu_name ?? 'N/A' }}</td>
                            <td>{{ $role->created_at ? $role->created_at->format('Y-m-d') : 'N/A' }}</td>
                            <td>{{ $role->updated_at ? $role->updated_at->format('Y-m-d') : 'N/A' }}</td>


                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-secondary">
                        <th>Actions</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Roles</th>
                        <th>BU</th>
                        <th>Created Date</th>
                        <th>Updated Date</th>

                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Start Role Modal -->
    <div class="modal fade" tabindex="-1" id="record_role_modal">
        <div class="modal-dialog modal-dialog-centered modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title ">{{ isset($employeerole) ? 'Edit Role' : 'Create Role' }}</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-dark ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form id="storeEmployeeRole" method="POST" action="{{ route('employeerole.store') }}">

                    @csrf
                    @if (isset($employeerole))
                        @method('PUT')
                    @endif

                    <!--begin::Modal body-->
                    <div class="modal-body mx-lg-5 my-7">
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header"
                            data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                            <div class="fv-row mb-10">
                                <label class="fs-5 fw-bold form-label mb-2 ">
                                    <span class="required">Role name</span>
                                </label>
                                <input class="form-control form-control-solid border border-secondary" placeholder="Enter a role name"
                                    name="employee_role_name" required />
                            </div>

                            <div class="fv-row mb-10">
                                <label class="fs-5 fw-bold form-label mb-2 ">
                                    <span>Role Description</span>
                                </label>
                                <input class="form-control form-control-solid border border-secondary" placeholder="Enter role description"
                                    name="employee_role_description" />
                            </div>

                            <div class="fv-row mb-10">
                                <label for="bu_id" class="form-label ">Business Unit</label>
                                <select class="form-select text-dark" id="bu_id" name="bu_id"
                                    style="width: 100%;">
                                    @foreach ($businessUnits as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->bu_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="fv-row">
                                <label class="fs-5 fw-bold form-label mb-2 ">Employee Roles</label>
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <tbody class="text-gray-600 fw-semibold">
                                            @foreach ($roleColumns as $roleKey => $roleName)
                                                <tr>
                                                    <td class="">{{ $roleName }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="form-check form-switch form-check-custom form-check-success form-check-solid">
                                                                <input class="form-check-input border border-2 border-secondary"
                                                                    type="checkbox" value="1"
                                                                    id="{{ $roleKey }}"
                                                                    name="{{ $roleKey }}"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"
                            id="storeRoleBtn">{{ isset($employeerole) ? 'Update' : 'Save' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Role Modal -->

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.btn-edit');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const roleId = this.dataset.roleId;
                    fetch(`/admin/employeerole/${roleId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            const modal = document.querySelector('#record_role_modal');
                            modal.querySelector('form').setAttribute('action',
                                `/admin/employeerole/${roleId}`);

                            // Add PUT method
                            modal.querySelector('form').insertAdjacentHTML('beforeend',
                                '<input type="hidden" name="_method" value="PUT">');

                            modal.querySelector('input[name="employee_role_name"]').value = data
                                .name;
                            modal.querySelector('input[name="employee_role_description"]')
                                .value = data.description;
                            modal.querySelector('select[name="bu_id"]').value = data.bu_id;

                            // Clear all checkboxes
                            modal.querySelectorAll('input[type="checkbox"]').forEach(
                                checkbox => {
                                    checkbox.checked = false;
                                });

                            // Check the roles that are set to true
                            for (const [key, value] of Object.entries(data)) {
                                if (value === 1) {
                                    const checkbox = modal.querySelector(
                                        `input[name="${key}"]`);
                                    if (checkbox) {
                                        checkbox.checked = true;
                                    }
                                }
                            }

                            new bootstrap.Modal(modal).show();
                        });
                });
            });
        });
    </script>


    <script>
        "use strict";

        var KTFuneralsDatatables = function() {
            var dt;

            var initDatatable = function() {
                dt = $("#roles").DataTable({
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
@endpush
