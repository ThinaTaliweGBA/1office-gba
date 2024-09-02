@extends('layouts.app2')

@push('styles')
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

                    <!--begin::Add customer-->
                    <a type="button" class="btn bg-secondary" data-bs-toggle="tooltip" title="PDF,EXCEL,CSV"
                        href="#">
                        <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span
                                class="path2"></span></i>Export
                    </a>
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->

            </div>
            <!--end::Wrapper-->

            <table id="dependants-table" class="table table-rounded table-row-dashed fs-6 g-5 gs-5">
                <thead>
                    <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                        <th class="text-center">Name</th>
                        <th class="text-center">Surname</th>
                        <th class="text-center">ID Number</th>
                        <th class="text-center">Date Of Birth</th>
                        <th class="text-center">Age</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Main Member</th>
                        <!-- <th class="text-center">Manage</th> -->
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach ($dependants as $dependant)
                        <tr>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                {{ $dependant->personDep->first_name ?? 'N/A' }}</td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                {{ $dependant->personDep->last_name ?? 'N/A' }}</td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                {{ $dependant->personDep->id_number ?? 'N/A' }}</td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                {{ substr($dependant->personDep->birth_date, 0, 10) ?? 'N/A' }}
                            </td>
                            @php
                                $age = ageFromDOB($dependant->personDep->birth_date);
                            @endphp
                            <td class="text-center mx-auto">
                                <a
                                    class="btn btn-icon btn-sm {{ $age < 15 ? 'btn-success' : ($age <= 20 ? 'btn-warning' : 'btn-danger') }} fw-bold">
                                    {{ $age }}
                                </a>
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                @if ($dependant->personDep->gender_id == 1 || $dependant->personDep->gender_id == 'M')
                                    <i class="bi bi-gender-male text-dark"></i> Male
                                @elseif ($dependant->personDep->gender_id == 2 || $dependant->personDep->gender_id == 'F')
                                    <i class="bi bi-gender-female text-dark"></i> Female
                                @else
                                    <i class="bi bi-gender-ambiguous text-dark"></i> Other
                                @endif
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                            {{-- @dump($dependant->personMain->membership->first()->id) --}}
                                    {{-- {{ $dependant->personMain->screen_name ?? 'N/A' }} --}}
                                {{-- <a href="/edit-member/2">
                                    {{ $dependant->personMain->screen_name ?? 'N/A' }}</a> --}}
                                    {{-- <a href="/edit-member/{{ $dependant->personMain->membership->first()->id }}">
                                    {{ $dependant->personMain->screen_name ?? 'N/A' }}</a> --}}
                                    <a href="{{ route('dependant.main-member', ['id' => $dependant->id]) }}">
    @if($dependant->personMain && $dependant->personMain->screen_name)
         {{ $dependant->personMain->screen_name }} <i class="bi bi-check-circle text-success fs-4"></i>
    @else
       N/A <i class="bi bi-x-circle text-danger fs-4"></i> 
    @endif
</a>

                            </td>

                            {{--}} <td class="text-center w-5 font-weight-normal">
                                    <a class="btn btn-link text-black text-gradient mx-3 mb-0"
                                        href="/view-member/{{ $dependant->personMain->membership->first()->id }}#pills-dependants"><i
                                            class="bi bi-eye-fill"></i>View</a>
                                    <a class="btn btn-link text-black text-gradient mx-3 mb-0"
                                        href="/edit-member/{{ $dependant->personMain->membership->first()->id }}"><i
                                            class="bi bi-pencil-fill"></i>Edit</a>
                                </td> --}}
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                        <th class="text-center">Name</th>
                        <th class="text-center">Surname</th>
                        <th class="text-center">ID Number</th>
                        <th class="text-center">Date Of Birth</th>
                        <th class="text-center">Age</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Main Member</th>

                        <!-- <th class="text-center">Manage</th> -->
                    </tr>
                </tfoot>
            </table>

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

    <script>
        "use strict";

        var KTDependantsDatatables = function() {
            var dt;

            var initDatatable = function() {
                dt = $("#dependants-table").DataTable({
                    searchDelay: 500,
                    order: [],
                    dom: "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
            KTDependantsDatatables.init();
        });
    </script>
    
@endpush
