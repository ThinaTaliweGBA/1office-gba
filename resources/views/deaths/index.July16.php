{{-- @extends('layouts.app2')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.css" rel="stylesheet">
@endpush

@section('row_content')
    <div class="card mx-auto border-gba -light p-4 my-4">
        @foreach ($memberships as $membership)
            <div>
                <h3 class="card-title ">Membership ID: {{ $membership->membership_code }}</h3>
                <p>Belongs to: {{ $membership->person->first_name }}</p>
                @if ($membership->person->dependant->isNotEmpty())
                    <p class="card-title -light">Dependants under this Membership:</p>
                    <ul>
                        @foreach ($membership->person->dependant as $dependant)
                            <li>
                                {{ $dependant->personDep->first_name }} - Relationship:
                                {{ $dependant->relationshipType->name }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No dependants under this membership.</p>
                @endif
            </div>
        @endforeach
    </div>



    <div class="-light rounded">
        <table id="kt_datatable_row_grouping" class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100">
            <thead class="">
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
                <tr>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011/07/25</td>
                    <td>$170,750</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>

    <script>
        var groupColumn = 2;

        var table = $("#kt_datatable_row_grouping").DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": groupColumn
            }],
            "order": [
                [groupColumn, "asc"]
            ],
            "displayLength": 25,
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: "current"
                }).nodes();
                var last = null;

                api.column(groupColumn, {
                    page: "current"
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            "<tr class=\"group fs-5 fw-bolder\"><td colspan=\"5\">" + group +
                            "</td></tr>"
                        );

                        last = group;
                    }
                });
            }
        });

        $("#kt_datatable_row_grouping tbody").on("click", "tr.group", function() {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
                table.order([groupColumn, "desc"]).draw();
            } else {
                table.order([groupColumn, "asc"]).draw();
            }
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush --}}

@extends('layouts.app2')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }

        .btn-toggle-expand {
            background-color: #28a745;
            /* Bootstrap green */
            color: white;
            /* White text color for better contrast */
            border: none;
            /* No border for a cleaner look */
            cursor: pointer;
            /* Cursor changes to pointer to indicate it's clickable */
        }

        .btn-toggle-expand i {
            color: white;
            /* Ensures the icon is also white for visibility */
        }

        .select {
            position: relative !important;
            /* Required for z-index to take effect */
            z-index: 1050 !important;
            /* Bootstrap modals usually have high z-index values */
        }

        .modal-body {
            overflow-y: auto;
            /* Ensures you can scroll within the modal if needed */
        }

        .form-control {
            padding: 0.275rem 0.25rem;
            font-size: 1rem;
            /* Adjust based on your design needs */
            height: auto;
            /* Ensures the select height adapts to content */
        }

        .col {
            min-height: 100px;
            overflow: visible;
        }
    </style>

    <style>
        .card {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .th,
        .td {
            padding: 8px 16px;
            border: 1px solid #ddd;
        }
    </style>
@endpush

@section('row_content')
    {{-- <div class="card mx-auto border-gba -light p-4 my-4">
        @foreach ($memberships as $membership)
            <div>
                <h3 class="card-title ">Membership ID: {{ $membership->membership_code }}</h3>
                <p>Belongs to: {{ $membership->person->first_name }}</p>
                @if ($membership->person->dependant->isNotEmpty())
                    <p class="card-title -light">Dependants under this Membership:</p>
                    <ul>
                        @foreach ($membership->person->dependant as $dependant)
                            <li>
                                {{ $dependant->personDep->first_name }} - Relationship:
                                {{ $dependant->relationshipType->name }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No dependants under this membership.</p>
                @endif
            </div>
        @endforeach
    </div> --}}

















    {{-- <p>{{ $membership->surname }}</p> --}}
    <div class="card my-10">
        <div class="card-header p-1 m-2 mx-aut0">
            <h1 class="mx-auto mt-1">Deaths</h1>
        </div>
        <table id="kt_datatable_row_grouping" class="table gy-5 gs-7 rounded w-100">
            <thead class="">
                <tr>
                    <th>Actions</th>
                    <th>Membership ID</th>
                    <th>Main Member Details</th>
                    <th>Dependant Name</th>
                    <th>Relationship</th>

                </tr>
            </thead>
            <!-- Assuming the previous sections remain unchanged, focus on the tbody content -->

            <tbody>
                @foreach ($memberships as $membership)
                    <!-- Main member row with data-group for identification -->
                    <tr class="group-header" data-group="{{ $membership->membership_code }}">
                        <td><a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal"
                                class="btn btn-icon btn-danger" data-member-id="{{ $membership->person->id }}"
                                title="Mark As Deceased"><i class="bi bi-person-x-fill fs-4 me-0"></i></a>
                        </td>
                        <td>
                            <button class="btn btn-icon btn-toggle-expand btn-sm me-4 btn-success" aria-expanded="false">
                                <i class="bi bi-plus-lg" style="color: white;"></i>
                            </button>
                            {{ $membership->membership_code }}
                        </td>
                        <td>{{ $membership->person->first_name }} {{ $membership->person->surname }}</td>
                        <td><!-- Placeholder for main member row --></td>
                        <td><!-- Placeholder --></td>

                    </tr>

                    @foreach ($membership->person->dependants as $dependant)
                        <!-- Dependant rows with data-group for parent identification -->
                        <tr class="dependant-row hidden" data-group="{{ $membership->membership_code }}">
                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal"
                                    class="btn btn-icon btn-danger" data-member-id="{{ $dependant->personDep->id }}"
                                    title="Mark As Deceased"><i class="bi bi-person-x fs-4 me-0"></i></a>
                            </td>
                            <td>{{ $membership->membership_code }}</td>
                            <td><!-- Placeholder; could be empty --></td>
                            <td>{{ $dependant->personDep->first_name ?? 'N/A' }}
                                {{ $dependant->personDep->last_name ?? 'N/A' }}
                            </td>
                            <td>{{ $dependant->relationshipType->name }}</td>

                        </tr>
                    @endforeach
                @endforeach
            </tbody>

        </table>
    </div>


    <!-- Start Death Modal -->
    <div class="modal fade" tabindex="-1" id="record_death_modal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="background-color: #448C74">
                <div class="modal-header">
                    <h3 class="modal-title text-white">Record Death</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-dark ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form id="recordDeath" method="POST" action="{{ route('deaths.store') }}">
                    @csrf
                    <div class="modal-body">

                        <input type="hidden" id="deceased_id" name="deceased_id">

                        <div class="pt-4 p-3">

                            <!-- Contact Details of Person Reporting Death -->
                            <h4 class="text-white mb-3">Contact Details of Person Reporting Death:</h4>
                            <!-- Contact Details of Person Reporting Death -->
                            <div class="row">
                                <div class="col">
                                    <label for="reporter_name" class="form-label text-white">Name:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="reporter_name"
                                        name="reporter_name">
                                </div>
                                <div class="col">
                                    <label for="reporter_surname" class="form-label text-white">Surname:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="reporter_surname"
                                        name="reporter_surname">
                                </div>
                                <div class="col">
                                    <label for="reporter_tel" class="form-label text-white">Tel:</label>
                                    <input type="tel" class="form-control bg-light text-dark" id="reporter_tel"
                                        name="reporter_tel">
                                </div>
                                <div class="col">
                                    <label for="reporter_whatsapp" class="form-label text-white">WhatsApp
                                        yes/no:</label>
                                    <select class="form-control bg-light text-dark" id="reporter_whatsapp"
                                        name="reporter_whatsapp">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="reporter_email" class="form-label text-white">E-mail:</label>
                                    <input type="email" class="form-control bg-light text-dark" id="reporter_email"
                                        name="reporter_email">
                                </div>
                            </div>

                            <div class="separator border-light my-8"></div>

                            <!-- Tracking Number (not in the modal but mentioned in the image) -->
                            <div class="row">
                                <div class="col">
                                    <label for="tracking_number" class="form-label text-white">Tracking Number:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="tracking_number"
                                        name="tracking_number" placeholder="20240321/1453" readonly>
                                </div>
                            </div>

                            <div class="separator border-light my-8"></div>

                            <!-- Deceased Details -->
                            <h4 class="text-white mb-3">Deceased Person's Details:</h4>

                            <div class="row">
                                <div class="col">
                                    <label for="deceased_name" class="form-label text-white">Name:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_name"
                                        name="deceased_name">
                                </div>
                                <div class="col">
                                    <label for="deceased_initials" class="form-label text-white">Initials:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_initials"
                                        name="deceased_initials">
                                </div>
                                <div class="col">
                                    <label for="deceased_surname" class="form-label text-white">Surname:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_surname"
                                        name="deceased_surname">
                                </div>

                                <div class="col">
                                    <label for="deceased_maiden_name" class="form-label text-white">Maiden Name:</label>
                                    <input type="text" class="form-control bg-light text-dark"
                                        id="deceased_maiden_name" name="deceased_maiden_name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="deceased_address" class="form-label text-white">Address:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_address"
                                        name="deceased_address">


                                    <input type="hidden" id="deceased_address_line1" name="deceased_address_line1">
                                    <input type="hidden" id="deceased_address_line2" name="deceased_address_line2">
                                    <input type="hidden" id="deceased_address_postalCode"
                                        name="deceased_address_postalCode">
                                    <input type="hidden" id="deceased_address_city" name="deceased_address_city">
                                    <input type="hidden" id="deceased_address_townSuburb"
                                        name="deceased_address_townSuburb">
                                    <input type="hidden" id="deceased_address_province"
                                        name="deceased_address_province">
                                    <input type="hidden" id="deceased_address_country" name="deceased_address_country">
                                    <input type="hidden" id="deceased_address_placeName"
                                        name="deceased_place_of_death_placeName">


                                </div>
                            </div>
                            <div class="row  my-2">
                                <div class="col">
                                    <label for="deceased_id_number" class="form-label text-white">ID Number:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_id_number"
                                        name="deceased_id_number">
                                </div>
                                <div class="col">
                                    <label for="deceased_birth_date" class="form-label text-white">Birth Date:</label>
                                    <input type="date" class="form-control bg-light text-dark"
                                        id="deceased_birth_date" name="deceased_birth_date">
                                </div>
                                <div class="col">
                                    <label for="deceased_age" class="form-label text-white">Age:</label>
                                    <input type="number" class="form-control bg-light text-dark" id="deceased_age"
                                        name="deceased_age">
                                </div>
                                <div class="col">
                                    <label for="deceased_birth_town" class="form-label text-white">Birth Town:</label>
                                    <input type="text" class="form-control bg-light text-dark"
                                        id="deceased_birth_town" name="deceased_birth_town">
                                </div>


                                <input type="hidden" id="deceased_birth_town_line1" name="deceased_birth_town_line1">
                                <input type="hidden" id="deceased_birth_town_line2" name="deceased_birth_town_line2">
                                <input type="hidden" id="deceased_birth_town_postalCode"
                                    name="deceased_birth_town_postalCode">
                                <input type="hidden" id="deceased_birth_town_city" name="deceased_birth_town_city">
                                <input type="hidden" id="deceased_birth_town_townSuburb"
                                    name="deceased_birth_town_townSuburb">
                                <input type="hidden" id="deceased_birth_town_province"
                                    name="deceased_birth_town_province">
                                <input type="hidden" id="deceased_birth_town_country"
                                    name="deceased_birth_town_country">
                                <input type="hidden" id="deceased_birth_town_placeName"
                                    name="deceased_place_of_death_placeName">



                            </div>
                            <div class="row my-2">
                                <div class="col">
                                    <label for="deceased_sex" class="form-label text-white">Sex:</label>
                                    <select class="form-control" id="deceased_sex" name="deceased_sex">
                                        <option value="" disabled selected>Select Sex</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="deceased_marital_status" class="form-label text-white">Marital
                                        Status:</label>
                                    <select class="form-control" id="deceased_marital_status"
                                        name="deceased_marital_status">
                                        <option value="" disabled selected>Select Marital Status</option>
                                        @foreach ($maritalStatuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="deceased_language" class="form-label text-white">Language:</label>

                                    <select class="form-control" id="deceased_language" name="deceased_language">
                                        <option value="" disabled selected>Select Language</option>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="deceased_occupation" class="form-label text-white">Occupation:</label>
                                    <input type="text" class="form-control bg-light text-dark"
                                        id="deceased_occupation" name="deceased_occupation">
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col">
                                    <label for="deceased_dr_number" class="form-label text-white">DR (BI 1663
                                        NR):</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_dr_number"
                                        name="deceased_dr_number">
                                </div>
                                <div class="col">
                                    <label for="deceased_date_of_death" class="form-label text-white">Date of
                                        Death:</label>
                                    <input type="date" class="form-control bg-light text-dark"
                                        id="deceased_date_of_death" name="deceased_date_of_death">
                                </div>
                                <div class="col">
                                    <label for="deceased_place_of_death" class="form-label text-white">Place of
                                        Death:</label>
                                    <input type="text" class="form-control bg-light text-dark"
                                        id="deceased_place_of_death" name="deceased_place_of_death">
                                </div>

                                <input type="hidden" id="deceased_place_of_death_line1"
                                    name="deceased_place_of_death_line1">
                                <input type="hidden" id="deceased_place_of_death_line2"
                                    name="deceased_place_of_death_line2">
                                <input type="hidden" id="deceased_place_of_death_postalCode"
                                    name="deceased_place_of_death_postalCode">
                                <input type="hidden" id="deceased_place_of_death_city"
                                    name="deceased_place_of_death_city">
                                <input type="hidden" id="deceased_place_of_death_townSuburb"
                                    name="deceased_place_of_death_townSuburb">
                                <input type="hidden" id="deceased_place_of_death_province"
                                    name="deceased_place_of_death_province">
                                <input type="hidden" id="deceased_place_of_death_country"
                                    name="deceased_place_of_death_country">
                                <input type="hidden" id="deceased_place_of_death_placeName"
                                    name="deceased_place_of_death_placeName">



                                <div class="col">
                                    <label for="deceased_doctor" class="form-label text-white">Doctor:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_doctor"
                                        name="deceased_doctor">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-warning" id="recordDeathBtn">Record Death</button> --}}
                        <button type="submit" class="btn btn-success" id="recordDeathToFuneralBtn">Record & Begin
                            Funeral</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Death Modal -->

    <div class="card shadow mb-10">
        <div class="card-header">
            <h3 class="card-title text-dark fs-1 mx-auto">Deaths</h3>
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
                            placeholder="Deaths Search" />
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
                                <label class="form-label fs-5 fw-semibold mb-3">Death Status:</label>
                                <!--end::Label-->

                                <!--begin::Options-->
                                <div class="d-flex flex-column flex-wrap fw-semibold"
                                    data-kt-docs-table-filter="funeral_status">
                                    <!--begin::Option-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                        <input class="form-check-input" type="radio" name="funeral_status"
                                            value="all" checked="checked" />
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
                    <a type="button" class="btn btn-light bg-secondary" data-bs-toggle="tooltip" title="Record Death"
                        href="#">
                        <i class="ki-duotone ki-plus fs-2"></i> Record Death
                    </a>
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->

            </div>
            <!--end::Wrapper-->

            <table id="memberships-table" class="table table-rounded table-row-dashed fs-6 g-5 gs-5">
                <thead>
                    <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                        <th class="text-center">Manage</th>
                        <th class="text-center">Membership ID</th>
                        <th class="text-center">Main Member Details</th>
                        <th class="text-center">Dependant Name</th>
                        <th class="text-center">Relationship</th>

                    </tr>
                </thead>
                <tbody class="bg-light">
                    {{-- @foreach ($memberships as $membership) --}}
                    <tr>
                        <td class="text-m font-weight-normal pt-3 text-center">

                            {{-- <span class="badge bg-warning fs-6 fw-bold m-1 p-2 text-dark" data-bs-toggle="modal"
                                    data-bs-target="#editMembershipModal" data-bs-id="{{ $membership->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </span> --}}

                            {{-- <span class="badge bg-success fs-7 fw-bold m-1 p-2">
                                        <a class="text-dark" href="/view-member/{{ $membership->id }}"
                                            style="text-decoration: none;"><i class="bi bi-eye-fill"></i> View</a>
                                    </span> --}}

                            {{-- <span class="badge bg-primary fs-7 fw-bold m-1 p-2">
                                        <a class="text-dark" data-membership-id="{{ $membership->id }}"
                                            style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#kt_modal_scrollable_2"><i class="bi bi-eye-fill"></i> View 2</a>
                                    </span> --}}
                            {{-- <span class="badge bg-primary fs-7 fw-bold m-1 p-2">
                                        <a class="text-dark" data-membership-id="{{ $membership->id }}" href="#"
                                        data-bs-toggle="modal" data-bs-target="#kt_modal_scrollable_2"
                                        style="text-decoration: none;"><i class="bi bi-eye-fill"></i> View 2</a>
                                    </span> --}}
                            {{-- <a class="btn btn-sm btn-icon btn-success" data-bs-toggle="modal" title="View"
                                    data-bs-target="#exampleModal2" ><i
                                        class="bi bi-eye-fill fs-4 me-0"></i> </a>
                                <a class="btn btn-sm btn-icon btn-warning"
                                    style="text-decoration: none;" data-bs-toggle="tooltip" title="Edit"><i
                                        class="bi bi-pencil-fill fs-4 me-0"></i>
                                </a>
                                <a class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" title="Remove"
                                    href="#" 
                                    style="text-decoration: none;"><i class="bi bi-trash3 fs-4 me-0"></i>
                                </a> --}}
                            <a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal"
                                class="btn btn-icon btn-danger btn-sm" data-member-id="{{ $membership->person->id }}"
                                title="Mark As Deceased"><i class="bi bi-person-x-fill fs-4 me-0"></i></a>


                            <button class="btn btn-icon btn-toggle-expand btn-sm me-4 btn-success" aria-expanded="false">
                                <i class="bi bi-plus-lg" style="color: white;"></i>
                            </button>
                            {{ $membership->membership_code }}

                            {{-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-bs-id="@mdo">Modal View</button> --}}


                        </td>
                        <td class="text-m font-weight-normal pt-3 text-dark fw-bold text-hover-primary text-center">
                            {{-- {{ $name = $membership->name ?? 'N/A' }} --}}
                        </td>


                        {{-- <td class="text-m font-weight-normal pt-3 text-center"> --}}
                        {{-- {{ $telephone = $membership->primary_contact_number ?? 'N/A' }} --}}
                        {{-- </td> --}}
                        {{-- <td class="text-m font-weight-normal pt-3 text-center"> --}}
                        {{-- {{ $joinDateFormatted = $membership->join_date ? Carbon\Carbon::parse($membership->join_date)->format('d/m/Y') : 'N/A' }} --}}
                        {{-- </td> --}}
                        {{-- <td class="text-m font-weight-normal pt-3 text-center"> --}}
                        {{-- <span --}}
                        {{-- class="badge badge-light-primary fs-7 fw-bold">{{ $statuses[$membership->bu_membership_status_id] }}</span> --}}
                        {{-- <span class="badge badge-light-primary fs-7 fw-bold">{{ $membership->status }}</span> --}}
                        {{-- </td> --}}
                        {{-- <td class="text-m font-weight-normal pt-3 text-center"> --}}
                        {{-- {{ $endDateFormatted = $membership->end_date ? Carbon\Carbon::parse($membership->end_date)->format('d/m/Y') : 'N/A' }} --}}
                        {{-- </td> --}}

                    </tr>
                    {{-- @endforeach --}}

                    @foreach ($memberships as $membership)
                        <!-- Main member row with data-group for identification -->
                        <tr class="group-header" data-group="{{ $membership->membership_code }}">
                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal"
                                    class="btn btn-icon btn-danger" data-member-id="{{ $membership->person->id }}"
                                    title="Mark As Deceased"><i class="bi bi-person-x-fill fs-4 me-0"></i></a>
                            </td>
                            <td>
                                <button class="btn btn-icon btn-toggle-expand btn-sm me-4 btn-success"
                                    aria-expanded="false">
                                    <i class="bi bi-plus-lg" style="color: white;"></i>
                                </button>
                                {{ $membership->membership_code }}
                            </td>
                            <td>{{ $membership->person->first_name }} {{ $membership->person->surname }}</td>
                            <td><!-- Placeholder for main member row --></td>
                            <td><!-- Placeholder --></td>

                        </tr>

                        @foreach ($membership->person->dependants as $dependant)
                            <!-- Dependant rows with data-group for parent identification -->
                            <tr class="dependant-row hidden" data-group="{{ $membership->membership_code }}">
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal"
                                        class="btn btn-icon btn-danger" data-member-id="{{ $dependant->personDep->id }}"
                                        title="Mark As Deceased"><i class="bi bi-person-x fs-4 me-0"></i></a>
                                </td>
                                <td class="text-m font-weight-normal pt-3 text-center">{{ $membership->membership_code }}
                                </td>
                                <td class="text-m font-weight-normal pt-3 text-center"><!-- Placeholder; could be empty -->
                                </td>
                                <td class="text-m font-weight-normal pt-3 text-center">
                                    {{ $dependant->personDep->first_name ?? 'N/A' }}
                                    {{ $dependant->personDep->last_name ?? 'N/A' }}
                                </td>
                                <td class="text-m font-weight-normal pt-3 text-center">
                                    {{ $dependant->relationshipType->name }}</td>

                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                        <th class="text-center">Manage</th>
                        <th class="text-center">Membership ID</th>
                        <th class="text-center">Main Member Details</th>
                        <th class="text-center">Dependant Name</th>
                        <th class="text-center">Relationship</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>



                    @foreach ($memberships as $membership)
                    <!-- Main member row with data-group for identification -->
                    <tr class="group-header" data-group="{{ $membership->membership_code }}">
                        <td><a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal"
                                class="btn btn-icon btn-danger" data-member-id="{{ $membership->person->id }}"
                                title="Mark As Deceased"><i class="bi bi-person-x-fill fs-4 me-0"></i></a>
                        </td>
                        <td>
                            <button class="btn btn-icon btn-toggle-expand btn-sm me-4 btn-success" aria-expanded="false">
                                <i class="bi bi-plus-lg" style="color: white;"></i>
                            </button>
                            {{ $membership->membership_code }}
                        </td>
                        <td>{{ $membership->person->first_name }} {{ $membership->person->surname }}</td>
                        <td><!-- Placeholder for main member row --></td>
                        <td><!-- Placeholder --></td>

                    </tr>

                    @foreach ($membership->person->dependants as $dependant)
                        <!-- Dependant rows with data-group for parent identification -->
                        <tr class="dependant-row hidden" data-group="{{ $membership->membership_code }}">
                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal"
                                    class="btn btn-icon btn-danger" data-member-id="{{ $dependant->personDep->id }}"
                                    title="Mark As Deceased"><i class="bi bi-person-x fs-4 me-0"></i></a>
                            </td>
                            <td>{{ $membership->membership_code }}</td>
                            <td><!-- Placeholder; could be empty --></td>
                            <td>{{ $dependant->personDep->first_name ?? 'N/A' }}
                                {{ $dependant->personDep->last_name ?? 'N/A' }}
                            </td>
                            <td>{{ $dependant->relationshipType->name }}</td>

                        </tr>
                    @endforeach
                @endforeach

<div class="container my-4">
    <input type="text" id="searchInput" class="form-control search-box" placeholder="Search...">
    <div class="accordion" id="parentChildAccordion">
        @foreach ($memberships as $membership)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $membership->membership_code }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $membership->membership_code }}" aria-expanded="false" aria-controls="collapse{{ $membership->membership_code }}">
                        {{ $membership->person->first_name }} {{ $membership->person->surname }} - {{ $membership->membership_code }}
                    </button>
                </h2>
                <div id="collapse{{ $membership->membership_code }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $membership->membership_code }}" data-bs-parent="#parentChildAccordion">
                    <div class="accordion-body">
                        <table class="table table-bordered dependants-table" id="table{{ $membership->membership_code }}">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Membership Code</th>
                                    <th>Dependant First Name</th>
                                    <th>Dependant Last Name</th>
                                    <th>Relationship Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($membership->person->dependants as $dependant)
                                    <tr>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal" class="btn btn-icon btn-danger" data-member-id="{{ $dependant->personDep->id }}" title="Mark As Deceased">
                                                <i class="bi bi-person-x fs-4 me-0"></i>
                                            </a>
                                        </td>
                                        <td>{{ $membership->membership_code }}</td>
                                        <td>{{ $dependant->personDep->first_name ?? 'N/A' }}</td>
                                        <td>{{ $dependant->personDep->last_name ?? 'N/A' }}</td>
                                        <td>{{ $dependant->relationshipType->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection


@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        var myJQuery = jQuery.noConflict(true);
        myJQuery(document).ready(function($) {
            // Initialize the DataTable with grouping but without automatically hiding any rows
            var table = $('#kt_datatable_row_grouping').DataTable({
                "columnDefs": [{
                    "targets": [0], // Optionally hide the Membership ID column
                    "visible": true
                }],
                "order": [
                    [0, 'asc']
                ],
                "responsive": true
                // Removed the "drawCallback" for brevity, assuming it's similar to previous implementations
            });

            // Toggle visibility of dependant rows and icon on group header button click
            $('#kt_datatable_row_grouping tbody').on('click', 'button.btn-toggle-expand', function() {
                var membershipCode = $(this).closest('tr').data('group');
                // Find all dependant rows belonging to the clicked group and toggle their visibility
                var dependantRows = $("tr.dependant-row[data-group='" + membershipCode + "']");
                dependantRows.toggleClass('hidden');
                $(this).attr('aria-expanded', function(i, attr) {
                    return attr == 'false' ? 'true' : 'false';
                });
                // Toggle icon
                $(this).find('i').toggleClass('bi-plus-lg bi-dash-lg');
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById('record_death_modal');

            if (modal) {
                modal.addEventListener('show.bs.modal', function(event) {
                    let button = event.relatedTarget;
                    let memberId = button.getAttribute('data-member-id');

                    $.ajax({
                        url: `/person-details/${memberId}`,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // Include CSRF token in header
                        },
                        success: function(data) {
                            console.log('AJAX success', data); // Log successful data retrieval
                            $('#deceased_id').val(data.id);
                            $('#deceased_name').val(data.name);
                            $('#deceased_initials').val(data.initials);
                            $('#deceased_surname').val(data.surname);
                            $('#deceased_id_number').val(data.id_number);
                            // Format the birth_date to "yyyy-MM-dd" for the date input
                            // Extract only the date part (first 10 characters) from the date string
                            if (data.birth_date) {
                                var dateString = data.birth_date.slice(0, 10); // "1999-02-02"
                                $('#deceased_birth_date').val(dateString);
                            }
                            $('#deceased_age').val(data.age);
                            $('#deceased_sex').val(data.sex);
                            $('#deceased_marital_status').val(data.marital_status_id);
                        },
                        error: function(xhr, status, error) {
                            console.log('AJAX error', status, error); // Log any AJAX errors
                            console.log('Response:', xhr
                                .responseText); // Log the full server response
                        }
                    });
                });
            } else {
                console.log('Modal not found'); // Error if modal not found
            }
        });
    </script>





    {{-- Accordion Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dependants-table').each(function() {
            $(this).DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "pageLength": 5
            });
        });

        $('#searchInput').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('.accordion-item').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

@endpush
