@extends('layouts.app2')

@push('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.bootstrap5.css">
@endpush

@section('row_content')
    <div class="card border border-1 shadow mb-10">
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

        <div class="card-header">
            <h3 class="card-title text-dark fs-1 mx-auto">Dependants</h3>
        </div>
        @if (session()->has('message'))
            <p style="margin: 2rem; color: #2F855A; font-weight: bold;">
                {{ session()->get('message') }}
            </p>
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
                            placeholder="Search for Dependant" />
                    </div>
                </div>

                <!--end::Search-->

                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                    <!--begin::Filter-->
                    <button type="button" class="btn me-3 bg-secondary" data-kt-menu-trigger="click"
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
                                <label class="form-label fs-5 fw-semibold mb-3">Dependant Status:</label>
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

                                <button type="submit" class="btn btn-dark " data-kt-menu-dismiss="true"
                                    data-kt-docs-table-filter="filter">Apply</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Menu 1--> <!--end::Filter-->

                    
                    <!--begin::Button-->
                    @can('permission create')
                        <div class="d-print-none with-border">
                            <a href="{{ route('permission.create') }}" class="btn bg-secondary ms-auto"><span
                                    class="btn-inner--icon pe-2"><i class="ki-duotone ki-plus-square fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i></span>{{ __('Add Permission') }}</a>
                        </div>
                    @endcan
                    <!--end::Button-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Wrapper-->

            <table id="dependants-table" class="table table-rounded fs-6 g-5 gs-5">
                <thead>

                    <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                        @canany(['permission edit', 'permission delete'])
                            <th class="text-center"> {{ __('Actions') }}</th>
                        @endcanany
                        <th class="text-center"> {{ __('Name') }}</th>
                        <th class="text-center"> {{ __('Assigned to') }}</th>
                        <th class="text-center"> {{ __('Created Date') }}</th>

                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach ($permissions as $permission)
                        <tr>
                            <!-- <td><a href="{{ route('permission.show', $permission->id) }}">{{ $permission->id }}</a></td> -->
                            @canany(['permission edit', 'permission delete'])
                                <td class="p-2 text-center">
                                    <form action="{{ route('permission.destroy', $permission->id) }}" method="POST">
                                        @can('permission edit')
                                            <a class="btn btn-sm btn-icon btn-warning"
                                                href="{{ route('permission.edit', $permission->id) }}"
                                                style="text-decoration: none;" data-bs-toggle="tooltip" title="Edit"><i
                                                    class="bi bi-pencil-fill fs-4 me-0"></i>
                                            </a>
                                        @endcan

                                        @can('permission delete')
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                                title="Remove" style="text-decoration: none;"><i
                                                    class="bi bi-trash3 fs-4 me-0"></i>
                                            </button>
                                        @endcan
                                    </form>
                                </td>
                            @endcanany
                            <td class="text-center">
                                {{ $permission->name }}
                            </td>
                            <td class="text-center">
                                <a href="../../demo15/dist/apps/user-management/roles/view.html"
                                    class="badge badge-light-primary fs-7 m-1">Super-Admin</a>
                                <a href="../../demo15/dist/apps/user-management/roles/view.html"
                                    class="badge badge-light-danger fs-7 m-1">Admin</a>
                            </td>
                            <td class="text-center">{{ $permission->created_at }}</td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                        @canany(['permission edit', 'permission delete'])
                            <th class="text-center"> {{ __('Actions') }}</th>
                        @endcanany
                        <th class="text-center"> {{ __('Name') }}</th>
                        <th class="text-center"> {{ __('Assigned to') }}</th>
                        <th class="text-center"> {{ __('Created Date') }}</th>

                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="assets/js/custom/apps/user-management/permissions/list.js"></script>
    <script src="assets/js/custom/apps/user-management/permissions/add-permission.js"></script>
    <script src="assets/js/custom/apps/user-management/permissions/update-permission.js"></script>
    <script src="assets/js/widgets.bundle.js"></script>
    <script src="assets/js/custom/widgets.js"></script>
    <script src="assets/js/custom/apps/chat/chat.js"></script>
    <script src="assets/js/custom/utilities/modals/users-search.js"></script>
    <!--end::Custom Javascript-->

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- Include DataTables -->
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <!-- Include Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Include DataTables Bootstrap 5 integration -->
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>
    <script>
        "use strict";

        var KTFuneralsDatatables = function() {
            var dt;

            var initDatatable = function() {
                dt = $("#kt_permissions_table").DataTable({
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
@endpush
