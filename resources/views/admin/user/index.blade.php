@extends('layouts.app2')

@push('style')
    
@endpush

@section('row_content')
    <div class="card shadow mb-18">
        <div class="card-header border-0 pt-6 mx-auto">
            <h2>All Users</h2>
        </div>
        @if (session()->has('message'))
            <p>
                {{ session()->get('message') }}
            </p>
        @endif
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
                    <div class="ki-duotone ki-magnifier position-absolute ms-6 ">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </div>
                    <input type="text" data-kt-docs-table-filter="search"
                        class="form-control form-control-solid w-250px ps-15 bg-secondary" placeholder="Search for a User" />
                </div>
            </div>
            <!--end::Search-->
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                <!--begin::Filter-->
                <button type="button" class="btn text-light me-3 bg-dark" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-filter fs-2 text-light"><span class="path1"></span><span class="path2"></span></i>
                        Filter
                    </button>
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
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
                            <label class="form-label fs-5 fw-semibold mb-3">Membership Status:</label>
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
                                    <input class="form-check-input" type="radio" name="funeral_status" value="Pending" />
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

                @can('user create')
                    <!--begin::Add customer-->
                    <a type="button" class="btn btn-dark" data-bs-toggle="tooltip" title="Add User"
                        href="{{ route('user.create') }}">
                        <i class="ki-duotone ki-plus fs-2 text-light"></i> Add New User
                    </a>
                @endcan
                <!--end::Add customer-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Wrapper-->


        <table id="table_users" class="table table-rounded fs-6 g-5 gs-5 my-8">
            <thead>
                <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                                    @canany(['user edit', 'user delete'])
                        
                        <th class="text-center">{{ __('Actions') }}</th>
                    @endcanany
                    <th class="text-center">Name</th>
                    <th class="text-center">{{ __('Email') }}</th>
                    <th class="text-center">Role</th> <!-- Added Role Column -->
                    <th class="text-center">Joined Date</th> <!-- Add column header for joined date -->

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                                                @canany(['user edit', 'user delete'])
                            <td class="text-center">
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" style="display:none;">{{ __('View') }}<span><i></i></span></a>
                                    @can('user edit')
                                        {{-- <a href="{{ route('user.edit', $user->id) }}"
                                            class="btn btn-icon btn-active-light-primary btn-flex btn-center btn-sm">{{ __('Edit') }}<span><i
                                        class="bi bi-pencil-fill fs-4 me-0"></i></span></a> --}}

                                        <a class="btn btn-sm btn-icon btn-warning" href="{{ route('user.edit', $user->id) }}"
                                    style="text-decoration: none;" data-bs-toggle="tooltip" title="Edit"><i
                                        class="bi bi-pencil-fill fs-4 me-0"></i>
                                </a>
                                    @endcan
                                    @can('user delete')
                                        @csrf
                                        @method('DELETE')
                                        {{-- <button
                                            class="btn btn-icon btn-active-light-primary btn-flex btn-center btn-sm">{{ __('Delete') }}<span><i class="bi bi-trash3 fs-4 me-0"></i></span></button> --}}

                                            <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" title="Remove"
                                    href="#" style="text-decoration: none;"><i class="bi bi-trash3 fs-4 me-0"></i>
                                </button>
                                    @endcan
                                </form>
                            </td>
                        @endcanany
                        <td>
                            <div class="text-center">
                                <a href="{{ route('user.show', $user->id) }}"
                                    class="text-gray-800 text-hover-primary mb-1"></a>{{ $user->name }}
                            </div>
                        </td>
                        <td class="text-center">{{ $user->email }}</td>

                        
                            <td class="text-center">
                                @foreach ($user->roles as $role)
                                    <div
                                        class="	@if ($role->name == 'super-admin') badge badge-light-danger fw-bold
															@elseif($role->name == 'admin')
															badge badge-light-warning fw-bold
															@elseif($role->name == 'writer')
															badge badge-light-success fw-bold
															@elseif($role->name == '')
															badge badge-light-info fw-bold @endif">
                                        {{ $role->name }}
                                    </div>

                                @endforeach
                            </td> <!-- Display user's role -->
                            <td class="text-center">{{ $user->created_at->format('d M Y, h:i a') }}</td>
                            <!-- Display joined date -->

                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                                    @canany(['user edit', 'user delete'])
                        
                        <th class="text-center">{{ __('Actions') }}</th>
                    @endcanany
                    <th class="text-center">Name</th>
                    <th class="text-center">{{ __('Email') }}</th>
                    <th class="text-center">Role</th> <!-- Added Role Column -->
                        <th class="text-center">Joined Date</th> <!-- Add column header for joined date -->
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    <script>
        window.deleteConfirm = function(membershipId) {
            Swal.fire({
                icon: "warning",
                text: "Do you want to cancel this membership?",
                showCancelButton: true,
                confirmButtonText: "Delete",
                confirmButtonColor: "#e3342f",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Select Reason for Cancellation",
                        input: "select",
                        inputOptions: {
                            reason1: "Reason 1",
                            reason2: "Reason 2",
                            reason3: "Reason 3",
                            reason4: "Reason 4",
                        },
                        inputPlaceholder: "Select a reason",
                        showCancelButton: true,
                        inputValidator: (value) => {
                            return new Promise((resolve) => {
                                if (value === "") {
                                    resolve("You need to select a reason for cancellation");
                                } else {
                                    window.location.href = membershipId;
                                }
                            });
                        },
                    });
                }
            });
        };
    </script>

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

        var KTFuneralTables = function() {
            var dt;

            var initDatatable = function() {
                dt = $("#table_users").DataTable({
                    searchDelay: 500,
                    order: [],
                    dom: "<'row'<'col-sm-12'tr>>" + // Only the table and rows
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // Info and pagination
                    columnDefs: [{
                        targets: 3,
                        orderable: true
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
            KTFuneralTables.init();
        });
    </script>
@endpush
