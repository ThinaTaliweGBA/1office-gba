@extends('layouts.app2')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.bootstrap5.css">

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

    {{-- Start Comments Box Styling --}}
    <style>
        #commentsBox {
            position: relative;
        }

        #commentsBox>#commentContainer {
            position: absolute;
            top: 0;
        }

        #commentsBox i {
            font-size: 32px;
        }

        #commentsBox a {
            position: absolute;
            bottom: 15px;
        }

        #commentsBox #addComment {
            right: 20px;
            font-weight: bold;
        }

        #commentsBox #removeComment {
            left: 20px;
            font-weight: bold;
        }
    </style>
    {{-- Start Comments Box Styling --}}

    <style>
        #AddMemberBox {
            position: relative;
        }

        #AddMemberBox>AddMemberButton {
            position: absolute;
            width: 50%;
        }
    </style>

    {{-- Start Commented Box Styling --}}
    <style>
        .containerC {}

        .form {
            background-color: #eee;
            border-radius: 6px;
            padding: 5px;
            display: flex;
            align-items: center;
        }

        .input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            flex: 1;
        }

        .input:focus,
        .add:focus {
            outline: none;
        }

        .add {
            border: none;
            background-color: #f44336;
            color: white;
            padding: 10px;
            border-radius: 6px;
            margin-left: 10px;
            cursor: pointer;
        }

        .tasks {
            background-color: #eee;
            margin-top: 20px;
            border-radius: 6px;
            padding: 20px;
        }

        .tasks .task {
            background-color: white;
            padding: 10px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
            cursor: pointer;
            border: 1px solid #ccc;
        }

        .tasks .task:not(:last-child) {
            margin-bottom: 15px;
        }

        .tasks .task:hover {
            background-color: #f7f7f7;
        }

        .tasks .task.done {
            opacity: 0.5;
            position: relative;
        }

        .task.done::after {
            position: absolute;
            content: "";
        }

        .tasks .task span {
            font-weight: bold;
            font-size: 10px;
            background-color: red;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-all {
            width: calc(100% - 45px);
            margin: auto;
            padding: 12px;
            text-align: center;
            font-size: 14px;
            color: white;
            background-color: #f44336;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
    {{-- End Commented Box Styling --}}

    <style>
        .custom-modal-size {
            max-width: 2000px !important;
            /* Adjust width as needed */
            height: auto !important;
            /* Adjust height as needed */
        }

        .imputsection {
            border-radius: 10px;
            border: 1px solid var(--bs-secondary);
            padding: 1em;
            margin: 1em;
        }
        
    </style>

    {{-- <style>
        #kt_header,
        #kt_footer{
            display: none !important;
        }
    </style> --}}

 <script>
        function getDOB(idNumber) {
            if (idNumber.length === 13) {
                let year = idNumber.substring(0, 2);
                let month = idNumber.substring(2, 4);
                let day = idNumber.substring(4, 6);

                // If the year is greater than the current year, then it must be from the 1900s
                year = (year < new Date().getFullYear() % 100) ? `20${year}` : `19${year}`;

                const dob = new Date(`${year}-${month}-${day}`);
                const age = calculateAge(dob);

                document.getElementById('age').value = age; // Set the age in the age input field
            } else {
                document.getElementById('age').value = ''; // Clear the age input if the ID number is invalid
            }
        }

        function calculateAge(dob) {
            const diffMs = Date.now() - dob.getTime();
            const ageDt = new Date(diffMs);

            return Math.abs(ageDt.getUTCFullYear() - 1970);
        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            return !(charCode > 31 && (charCode < 48 || charCode > 57));
        }
    </script>
@endpush

@section('row_content')

    {{-- @if ($errors->any())
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
    @endif --}}

    <div class="card shadow mb-10">
        <div class="card-header">
            <h3 class="card-title text-dark fs-1 mx-auto">Memberships</h3>
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
                            placeholder="Search for Membership" />
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
                    {{-- <a type="button" class="btn btn-light bg-secondary" data-bs-toggle="tooltip" title="New Membership"
                        href="/add-member">
                        <i class="ki-duotone ki-plus fs-2"></i> Add New Membership
                    </a> --}}
                    <!--end::Add customer-->
                    <!-- Modal Trigger Button -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                        Add New Membership
                    </button>
                </div>
                <!--end::Toolbar-->

            </div>
            <!--end::Wrapper-->

            <table id="memberships-table" class="table table-rounded table-row-dashed fs-6 g-5 gs-5">
                <thead>
                    <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                        <th class="text-center">Manage</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Surname</th>
                        <th class="text-center">ID Number</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Telephone</th>
                        <th class="text-center">Join Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">End Date</th>

                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach ($memberships as $membership)
                        <tr>
                            <td class="text-m font-weight-normal pt-3 text-center">
                            
                                {{-- <span class="badge bg-warning fs-6 fw-bold m-1 p-2 text-dark" data-bs-toggle="modal"
                                    data-bs-target="#editMembershipModal" data-bs-id="{{ $membership->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
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
                                <a class="btn btn-sm btn-icon btn-success" data-bs-toggle="modal" title="View"
                                    data-bs-target="#exampleModal2" data-bs-id="{{ $membership->id }}"><i
                                        class="bi bi-eye-fill fs-4 me-0"></i> </a>
                                <a class="btn btn-sm btn-icon btn-warning" href="/edit-member/{{ $membership->id }}"
                                    style="text-decoration: none;" data-bs-toggle="tooltip" title="Edit"><i
                                        class="bi bi-pencil-fill fs-4 me-0"></i> </a>
                                         {{-- <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="modal" title="Edit"
                                    data-bs-target="#exampleModal3" data-bs-id="{{ $membership->id }}"><i
                                        class="bi bi-pencil-fill fs-4 me-0"></i> </a> --}}
                                </a>
                                <a class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" title="Remove"
                                    href="#" onclick="deleteConfirm('/cancel-member/{{ $membership->id }}')"
                                    style="text-decoration: none;"><i class="bi bi-trash3 fs-4 me-0"></i>
                                </a>

                                <!-- Button trigger modal -->
                                {{-- <button type="button" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Edit
                                </button> --}}

                                {{-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-bs-id="@mdo">Modal View</button> --}}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-dark fw-bold text-hover-primary text-center">
                                {{ $name = $membership->name ?? 'N/A' }}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                {{ $surname = $membership->surname ?? 'N/A' }}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                {{ $id_number = $membership->id_number ?? 'N/A' }}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                @if ($membership->gender_id == 'M' || $membership->gender_id == '1')
                                    Male
                                @elseif($membership->gender_id == 'F' || $membership->gender_id == '2')
                                    Female
                                @else
                                    Other
                                @endif
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                {{ $telephone = $membership->primary_contact_number ?? 'N/A' }}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                {{ $joinDateFormatted = $membership->join_date ? Carbon\Carbon::parse($membership->join_date)->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                <span
                                    class="badge badge-light-primary fs-7 fw-bold">{{ $statuses[$membership->bu_membership_status_id] ?? 'Unknown Status' }}</span>
                                {{-- <span class="badge badge-light-primary fs-7 fw-bold">{{ $membership->status }}</span> --}}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                {{ $endDateFormatted = $membership->end_date ? Carbon\Carbon::parse($membership->end_date)->format('d/m/Y') : 'N/A' }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                        <th class="text-center">Manage</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Surname</th>
                        <th class="text-center">ID Number</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Telephone</th>
                        <th class="text-center">Join Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">End Date</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Modal at mdo--> <!-- Modal at getbootstrap-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Membership Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="membershipModalBody">
                    <!-- Dynamic content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog custom-modal-size fixed">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Membership Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="editMembershipModalBody">
                    <!-- Dynamic content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
        </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="editMembershipModal" tabindex="-1" aria-labelledby="editMembershipLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editMembershipLabel">Edit Membership Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                    <!-- Form for editing will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal at mdo script-->


    <!-- Add New Member Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog custom-modal-size fixed"> <!-- Apply custom size class -->
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="addMemberModalLabel">Add New Member</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Place your existing form here -->

                    <form method="POST" action="{{ route('add-member.store') }}" autocomplete="off" id="memberForm">
                        @csrf
                        <div class="card-title  mt-4 bg-body rounded-2">
                            <!--begin::Form-->
                            <div class="mx-0">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="row" id="AddMemberBox">
                                <div class="col-9">

                                    <div class="card-body imputsection p-4 shadow">
                                        <div>
                                            <!--begin::Title-->
                                            <h1 class="fw-bold d-flex align-items-center text-gba">Personal Info
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Fill all required information about the membership your adding.">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                    {{--                                    </span> --}}
                                            </h1>
                                            <!--end::Title-->
                                            <!--begin::Notice-->
                                            <div class="fw-semibold fs-6">Mandatory information</div>
                                            <!--end::Notice-->
                                        </div>
                                        <div>
                                            {{-- <div class="row">
                                                <div class="col-12 col-sm-6 mx-auto ">
                                                <div
                                                    class="form-check form-switch col d-flex justify-content-center align-items-center mt-5 mb-0">
                                                    <label class="fw-semibold fs-2 form-label">Select Language : </label>
                                                    <div class="btn-group rounded-top border border-primary-subtle" role="group"
                                                        aria-label="Language selection">
                                                        <input type="radio" class="btn-check bg-gba" name="language" id="2"
                                                            autocomplete="off">
                                                        <label class="btn btn-outline-success bg-gba-light" for="2">English</label>

                                                        <input type="radio" class="btn-check" name="language" id="1"
                                                            autocomplete="off">
                                                        <label class="btn btn-outline-success bg-gba-light" for="1">Afrikaans</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div> --}}
                                            <div class="row">
                                                <div class="col-6 col-sm-6">

                                                    <div
                                                        class="form-floating @error('Name') is-invalid focused is-focused  @enderror mt-3 mb-0 bold-placeholder">

                                                        <input type="text" class="form-control text-black"
                                                            name="Name" id="Name" value="{{ old('Name') }}"
                                                            placeholder="" required>
                                                        <label for="Name" class="fs-4 text-gray-600">Name<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    @error('Name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-6 col-sm-6">
                                                    <div
                                                        class="form-floating  @error('Surname') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                        <input type="text" class="form-control text-black"
                                                            name="Surname" id="Surname" value="{{ old('Surname') }}"
                                                            placeholder="" required>
                                                        <label for="Surname" class="fs-4 text-gray-600">Surname<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    @error('Surname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-3 col-sm-3">
                                                    <div id="IDNumber"
                                                        class="form-floating  @error('IDNumber') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                        <input type="text" class="form-control" name="IDNumber"
                                                            id="IDNumber" value="{{ old('IDNumber') }}" placeholder=""
                                                            maxlength="13" size="13" onchange="getDOB(this.value)" required>
                                                        <label for="IDNumber" class="fs-4 text-gray-600">ID
                                                            Number<span class="text-danger">*</span></label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="error"></span>
                                                    @error('IDNumber')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-3 col-sm-3"
                                                    style="
                                                        padding-top: 0.18rem;
                                                    ">
                                                    <div
                                                        class="py-2 col d-flex justify-content-center align-items-center mx-auto">
                                                        <!-- <div style="white-space:nowrap;" class="px-4">
                                                                                                                                                <label class="form-label">Date Of Birth</label>

                                                                                                                                                </div> -->
                                                        <div id="inputDayDiv"
                                                            class="form-floating @error('inputDay') is-invalid @enderror">

                                                            <input type="text" onkeypress="return isNumberKey(event)"
                                                                class="form-control" name="inputDay" id="inputDay"
                                                                value="{{ old('inputDay') }}" placeholder=""
                                                                maxlength="2" size="2" required>
                                                            <label for="inputDay" class="fs-4 text-gray-600">Day<span
                                                                    class="text-danger">*</span></label>
                                                            @error('inputDay')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: red;">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <span class="px-2"></span>
                                                        <div id="inputMonthDiv"
                                                            class="form-floating">

                                                            <input type="text" onkeypress="return isNumberKey(event)"
                                                                class="form-control" name="inputMonth" id="inputMonth"
                                                                
                                                                value="{{ old('inputMonth') }}" placeholder=""
                                                                maxlength="2" size="2" required>
                                                            <label for="inputMonth" class="fs-4 text-gray-600">MM<span
                                                                    class="text-danger">*</span></label>

                                                        </div>
                                                        {{-- @error('inputMonth')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                        @enderror --}}
                                                        <span class="px-2"></span>
                                                        <div id="inputYearDiv"
                                                            class="form-floating @error('inputYear') is-invalid @enderror">

                                                            <input type="text" onkeypress="return isNumberKey(event)"
                                                                class="form-control" name="inputYear" id="inputYear"
                                                                value="{{ old('inputYear') }}" placeholder=""
                                                                maxlength="4" size="4" required>
                                                            <label for="inputYear" class="fs-4 text-gray-600">Year<span
                                                                    class="text-danger">*</span></label>
                                                            @error('inputYear')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: red;">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <span class="px-2"></span>
                                                       
                                                        <div id="ageDiv" class="form-floating" >

                                                            <input type="text" onkeypress="return isNumberKey(event)"
                                                                class="form-control" name="age" id="age"
                                                                value="{{  old('age') }}" placeholder=""
                                                                maxlength="4" size="3" readonly>
                                                            <label for="age" class="fs-4 text-gray-600">Age</label>
                                                            @error('age')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: red;">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-2 pt-3 mt-sm-0" style="margin-top: 25px;">
                                                    {{-- <div class="btn-group  col d-flex justify-content-center align-items-center mx-auto">

                                                        <input type="radio" class="btn-check form-check-input " name="radioGender"
                                                            id="Male" value="M" />
                                                        <label class="btn bg-gba-light btn-outline-success" for="Male">Male</label>

                                                        <input type="radio" class="btn-check form-check-input " name="radioGender"
                                                            id="Female" value="F" />
                                                        <label class="btn bg-gba-light btn-outline-success" for="Female">Female</label>

                                                    </div> --}}
                                                    <div
                                                        class="btn-group col d-flex justify-content-center align-items-center mx-auto my-auto @error('radioGender') is-invalid @enderror">
                                                        <select class="form-select form-select-solid text-dark bg-light"
                                                            id="radioGender" name="radioGender" required>
                                                            <option value="">Select Gender<span
                                                                    class="text-danger">*</span>
                                                            </option>
                                                            @foreach ($genders as $gender)
                                                                <option value="{{ $gender->id }}"
                                                                    {{ old('radioGender') == $gender->id ? 'selected' : '' }}>
                                                                    {{ $gender->id }} - {{ $gender->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('radioGender')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong style="color: red;">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-2">
                                                    {{-- <div class="btn-group col d-flex justify-content-center align-items-center mx-auto"
                                                        style="padding-top: 0.75rem;">
                                                        <input type="radio" class="btn-check form-check-input" name="language" id="2"
                                                            autocomplete="off">
                                                        <label class="btn bg-gba-light btn-outline-success" for="2">English</label>

                                                        <input type="radio" class="btn-check form-check-input" name="language" id="1"
                                                            autocomplete="off">
                                                        <label class="btn bg-gba-light btn-outline-success" for="1">Afrikaans</label>
                                                    </div> --}}
                                                    <div class="btn-group col d-flex" style="padding-top: 0.75rem;">
                                                        <select class="form-select form-select-solid text-dark bg-light"
                                                            id="language" name="language" required>
                                                            <option value="">Select Language*</option>
                                                            @foreach ($languages as $language)
                                                                <option value="{{ $language->id }}"
                                                                    {{ old('language') == $language->id ? 'selected' : '' }}>
                                                                    {{ $language->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-2 mt-3 mt-sm-0">
                                                    <div class="pb-2">
                                                        <!-- <label class="form-label col d-flex justify-content-center mx-auto">Marital status</label> -->
                                                        {{-- <div class="btn-group  col d-flex justify-content-center align-items-center mx-auto"
                                                            style="padding-top: 0.75rem;">
                                                            <input type="radio" class="btn-check form-check-input" name="marital_status"
                                                                id="Married" value="1" />
                                                            <label class="btn bg-gba-light btn-outline-success" for="Married">Married</label>

                                                            <input type="radio" class="btn-check form-check-input" name="marital_status"
                                                                id="Single" value="2" />
                                                            <label class="btn bg-gba-light btn-outline-success" for="Single">Single</label>

                                                            <input type="radio" class="btn-check form-check-input" name="marital_status"
                                                                id="Widowed" value="3" />
                                                            <label class="btn bg-gba-light btn-outline-success" for="Widowed">Widowed</label>

                                                            <input type="radio" class="btn-check form-check-input" name="marital_status"
                                                                id="Divorced" value="4" />
                                                            <label class="btn bg-gba-light btn-outline-success" for="Divorced">Divorced</label>
                                                        </div> --}}
                                                        <div class="btn-group col d-flex justify-content-center align-items-center mx-auto"
                                                            style="padding-top: 0.75rem;">
                                                            <select
                                                                class="form-select form-select-solid text-dark bg-light"
                                                                id="marital_status" name="marital_status" required>
                                                                <option value="">Select Marital Status*</option>
                                                                @foreach ($maritalStatuses as $status)
                                                                    <option value="{{ $status->id }}"
                                                                        {{ old('marital_status') == $status->id ? 'selected' : '' }}>
                                                                        {{ $status->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body imputsection p-4 shadow">
                                        <div>
                                            <!--begin::Title-->
                                            <h1 class="fw-bold d-flex align-items-center text-gba">Location
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Were is your physical address?">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </h1>
                                            <!--end::Title-->
                                            <!--begin::Notice-->
                                            <div class=" fw-semibold fs-6">Tell us where you live</div>
                                            <!--end::Notice-->
                                        </div>
                                        <div>
                                            <div class="row mt-3">
                                                <div class="col-6">
                                                    <div
                                                        class="form-floating @error('Line1') is-invalid focused is-focused  @enderror  mb-0">
                                                        <input type="text" class="form-control" name="Line1"
                                                            id="Line1" value="{{ old('Line1') }}" placeholder="" required>
                                                        <label for="Line1" class="fs-4 text-gray-600">Address Line
                                                            1<span class="text-danger">*</span></label>
                                                    </div>
                                                    @error('Line1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-sm-6">
                                                    <div
                                                        class="form-floating  @error('Line2') is-invalid focused is-focused  @enderror  mb-0">

                                                        <input type="text" class="form-control" name="Line2"
                                                            id="Line2" value="{{ old('Line2') }}" placeholder="">
                                                        <label for="Line2" class="fs-4 text-gray-600">Address Line
                                                            2<span class="text-danger">*</span></label>
                                                    </div>
                                                    @error('Line2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-3 col-sm-3 ">
                                                    <div
                                                        class="form-floating  @error('Province') is-invalid focused is-focused  @enderror ">

                                                        <input type="text" class="form-control" name="Province"
                                                            id="Province" value="{{ old('Province') }}" placeholder="">
                                                        <label for="Province" class="fs-4 text-gray-600">Province<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    @error('Province')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-3 col-sm-3">
                                                    <div
                                                        class="form-floating  @error('TownSuburb') is-invalid focused is-focused  @enderror ">

                                                        <input type="text" autocomplete="off" class="form-control"
                                                            name="TownSuburb" id="TownSuburb"
                                                            value="{{ old('TownSuburb') }}" placeholder="">
                                                        <label for="TownSuburb"
                                                            class="fs-4 text-gray-600">Town/Suburb<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    @error('TownSuburb')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-3 col-sm-3">
                                                    <div
                                                        class="form-floating  @error('City') is-invalid focused is-focused  @enderror ">

                                                        <input type="text" class="form-control" name="City"
                                                            id="City" value="{{ old('City') }}" placeholder="">
                                                        <label for="City" class="fs-4 text-gray-600">City<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    @error('City')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                                <div class="col-2 col-sm-2">
                                                    <div
                                                        class="form-floating  @error('Country') is-invalid focused is-focused  @enderror ">

                                                        <input type="text" class="form-control" name="Country"
                                                            id="Country" value="{{ old('Province') }}" placeholder="">
                                                        <label for="Country" class="fs-4 text-gray-600">Country<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    @error('Country')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-1 col-sm-1">
                                                    <div
                                                        class="form-floating  @error('PostalCode') is-invalid focused is-focused  @enderror ">

                                                        <input type="text" class="form-control" name="PostalCode"
                                                            id="PostalCode" value="{{ old('PostalCode') }}"
                                                            placeholder="">
                                                        <label for="PostalCode" class="fs-4 text-gray-600">Zip<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    @error('PostalCode')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body imputsection p-4 shadow">
                                        <div>
                                            <!--begin::Title-->
                                            <h1 class="fw-bold d-flex align-items-center text-gba">Contact Details
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="How do we keep in contact with this member?">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                                </h2>
                                                <!--end::Title-->
                                                <!--begin::Notice-->
                                                <div class=" fw-semibold fs-6">Please provide at least one</div>
                                                <!--end::Notice-->
                                        </div>
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col-3">
                                                    <div
                                                        class="form-floating @error('Telephone') is-invalid focused is-focused @enderror mt-3 mb-0">
                                                        <input type="tel" class="form-control" name="Telephone"
                                                            id="Telephone" value="{{ old('Telephone') }}"
                                                            placeholder="">
                                                        <label for="Telephone" class="fs-4 text-gray-600">Add
                                                            Telephone (Cell)</label>
                                                    </div>
                                                    @error('Telephone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    <div
                                                        class="form-floating @error('WorkTelephone') is-invalid focused is-focused @enderror mt-3 mb-0">
                                                        <input type="tel" class="form-control" name="WorkTelephone"
                                                            id="WorkTelephone" value="{{ old('WorkTelephone') }}"
                                                            placeholder="">
                                                        <label for="WorkTelephone" class="fs-4 text-gray-600">Add
                                                            Telephone (Work)</label>
                                                    </div>
                                                    @error('WorkTelephone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                                <div class="col-6">
                                                    <div
                                                        class="form-floating  @error('Email') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                        <input type="email" class="form-control" name="Email"
                                                            id="Email" value="{{ old('Email') }}" placeholder="" required>
                                                        <label for="Email" class="fs-4 text-gray-600">Enter Email
                                                            Address<span class="text-danger">*</span></label>
                                                    </div>
                                                    @error('Email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="button-row d-flex mt-4 col-12">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card-body imputsection p-4 shadow">
                                        <!--begin::Title-->
                                        <h1 class="fw-bold d-flex align-items-center text-gba">Membership Type
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                title="Choose your membership type">
                                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </h1>
                                        <!--end::Title-->
                                        <!--begin::Notice-->
                                        <div class="fw-semibold fs-6">Please select one<span class="text-danger">*</span>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 mt-3">
                                                        <div class="dropdown">
                                                            <select id="memtype" name="memtype"
                                                                class="btn bg-light shadow-dark dropdown-toggle w-100 my-4 @error('memtype') is-invalid @enderror text-dark border border-secondary"
                                                                style="height: 38px;" aria-label="Select Membership Type">
                                                                <option selected value="0" disabled> Select
                                                                    Membership Type
                                                                </option>
                                                                @foreach ($memtypes as $memtype)
                                                                    @if (old('memtype') == $memtype->id)
                                                                        <option value="{{ $memtype->id }}" selected>
                                                                            {{ $memtype->id }}.
                                                                            {{ $memtype->name }} -
                                                                            {{ $memtype->description }} -
                                                                            R{{ round($memtype->membership_fee, 2) }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $memtype->id }}">
                                                                            {{ $memtype->id }}.
                                                                            {{ $memtype->name }} -
                                                                            {{ $memtype->description }} -
                                                                            R{{ round($memtype->membership_fee, 2) }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            @error('memtype')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: red;">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4"></div>
                                        </div>
                                    </div>

                                    <div class="card-body imputsection p-4 shadow" id="commentsBox">
                                        <h1 class="fw-bold d-flex align-items-center text-gba">Comments
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                title="Add Comments (optional)">
                                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </h1>
                                        <!--begin::Input group-->
                                        <div class="fw-semibold fs-6 pb-4">Membership Comments</div>

                                        {{-- <form method="POST" action="{{ route('comments.store') }}"> --}}
                                        @csrf <!-- CSRF token for security -->

                                        <div class="form-floating">
                                            {{-- <textarea class="form-control bg-light text-dark" placeholder="" id="floatingTextarea2"
                                            name="text"   style="height:690px"></textarea> --}}
                                            <div class="containerC px-0" id="commentContainer">
                                                <div class="form">
                                                    <input type="text" name="text"
                                                        class="input form-control text-black bg-white"
                                                        {{ old('text') }} />
                                                    <input type="button" class="add bg-success" value="Add" />
                                                </div>
                                                <div class="tasks"></div>
                                                {{-- <div class="delete-all wrap">Delete all</div> --}}
                                            </div>
                                            {{-- <label for="floatingTextarea2">Insert your comment here.</label> --}}
                                            {{-- @error('floatingTextarea2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="color: red">{{ $message }}</strong>
                                                </span>
                                            @enderror --}}
                                        </div>
                                        {{-- <a id="addComment"><i class="bi bi-check-circle text-success"></i></a>
                                            <a id="removeComment"><i class="bi bi-x-circle text-danger"></i></a> --}}
                                        <input type="hidden" name="tasksData" id="tasksDataField">
                                        <input type="hidden" name="author" value="{{ Auth::user()->name }}">
                                        <!-- Example value -->
                                        <input type="hidden" name="link" value="{{ route('view-member', 0) }}">
                                        <!-- Example value -->
                                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="model_name" value="Membership">
                                        <!-- Example value -->
                                        <input type="hidden" name="model_record" value="0">
                                        <!-- Example, should be dynamically set -->
                                        {{-- <button type="submit" class="btn btn-success mt-2">Add</button> --}}
                                        {{-- </form> --}}
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!-- Ensuring button takes full width but with proper spacing -->
                            </div>
                            <!--end::Form-->
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary" onclick="submitForm();">Save Member</button> --}}
                        <button class="btn text-white" type="submit" title="Add a Membership" id="AddMemberButton"
                            text="Add" style="background-color: #00923f;">Add
                            Membership</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewButtons = document.querySelectorAll('.view-membership-btn');
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const membershipId = this.getAttribute('data-id');
                // Clear the modal content before fetching new data
                modalBody.innerHTML = '<div class="text-center">Loading...</div>';
                fetch(`/view-member/${membershipId}`)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('membershipModalBody').innerHTML = data;
                    });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewButtons = document.querySelectorAll('.edit-membership-btn');
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const membershipId = this.getAttribute('data-id');
                // Clear the modal content before fetching new data
                modalBody.innerHTML = '<div class="text-center">Loading...</div>';
                fetch(`/edit-member/${membershipId}`)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('editMembershipModalBody').innerHTML = data;
                    });
            });
        });
    });
</script>

        <script>
            const exampleModal = document.getElementById('exampleModal')
            if (exampleModal) {
                exampleModal.addEventListener('show.bs.modal', event => {
                    // Button that triggered the modal
                    const button = event.relatedTarget
                    // Extract info from data-bs-* attributes
                    const recipient = button.getAttribute('data-bs-id')
                    // If necessary, you could initiate an Ajax request here
                    // and then do the updating in a callback.

                    // Update the modal's content.
                    const modalTitle = exampleModal.querySelector('.modal-title')
                    const modalBodyInput = exampleModal.querySelector('.modal-body input')

                    modalTitle.textContent = `New message to ${recipient}`
                    modalBodyInput.value = recipient
                })
            }
        </script>

        <script>
            $(document).ready(function() {
                const exampleModal2 = document.getElementById('exampleModal2');
                if (exampleModal2) {
                    exampleModal2.addEventListener('show.bs.modal', function(event) {
                        // Button that triggered the modal
                        const button = event.relatedTarget;
                        // Extract membership ID from data-bs-id attribute
                        const membershipId = button.getAttribute('data-bs-id');

                        // Perform an AJAX request to your Laravel backend
                        $.get(`/view-member/${membershipId}`, function(data) {
                            // Assuming 'data' is the HTML content to display in the modal
                            //$(exampleModal2).find('.modal-body').html(data);
                            document.getElementById('membershipModalBody').innerHTML = data;
                        });
                    });
                }
            });
        </script>
         <script>
            $(document).ready(function() {
                const exampleModal3 = document.getElementById('exampleModal3');
                if (exampleModal3) {
                    exampleModal3.addEventListener('show.bs.modal', function(event) {
                        // Button that triggered the modal
                        const button = event.relatedTarget;
                        // Extract membership ID from data-bs-id attribute
                        const membershipId = button.getAttribute('data-bs-id');

                        // Perform an AJAX request to your Laravel backend
                        $.get(`/edit-member/${membershipId}`, function(data) {
                            // Assuming 'data' is the HTML content to display in the modal
                            //$(exampleModal2).find('.modal-body').html(data);
                            document.getElementById('editMembershipModalBody').innerHTML = data;
                        });
                    });
                }
            });
        </script>

<script>
    $(document).ready(function() {
        $('#membershipForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(), // Serialize the form data
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '<ul>';

                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value[0] + '</li>';
                    });

                    errorHtml += '</ul>';

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: errorHtml,
                        showConfirmButton: true
                    });
                }
            });
        });
    });
</script>

        

        <script>
            $(document).ready(function() {
                const editMembershipModal = document.getElementById('editMembershipModal');
                if (editMembershipModal) {
                    editMembershipModal.addEventListener('show.bs.modal', function(event) {
                        const button = event.relatedTarget; // Button that triggered the modal
                        const membershipId = button.getAttribute('data-bs-id'); // Extract ID

                        // Perform an AJAX request to get the edit form
                        $.get(`/edit-member/${membershipId}`, function(data) {
                            // Load the form into the modal body+
                            $(editMembershipModal).find('.modal-body').html(data);
                        });
                    });

                    // Handle the save button
                    $(editMembershipModal).find('.btn-primary').click(function() {
                        // Serialize the form data
                        const formData = $(editMembershipModal).find('form').serialize();

                        // Send a POST request to update the membership
                        $.post(`/update-member/${membershipId}`, formData, function(response) {
                            // Handle the response
                            alert('Membership updated successfully!');
                            // You might want to close the modal and refresh the page or part of it
                            $(editMembershipModal).modal('hide');
                        }).fail(function() {
                            alert('Error updating membership.');
                        });
                    });
                }
            });
        </script>

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

            var KTFuneralsDatatables = function() {
                var dt;

                var initDatatable = function() {
                    dt = $("#memberships-table").DataTable({
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
                                reason1: "Main Member Deceased",
                                reason2: "Dependant Deceased",
                                reason3: "Other",
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById('kt_modal_stacked_2');

                modal.addEventListener('shown.bs.modal', function() {
                    // Get the membership ID from the button that opened the modal
                    var opener = document.querySelector('[data-bs-stacked-modal="#kt_modal_stacked_2"]');
                    var membershipId = opener.getAttribute('data-membership-id');
                    console.log(membershipId);

                    var fetchUrl = `/dependantsData?id=${membershipId}`; // Use the ID in the fetch URL

                    fetch(fetchUrl) // Use the dynamic URL with the membership ID
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            const tbody = document.getElementById('dependantsBody');
                            tbody.innerHTML = ''; // Clear existing rows
                            if (data.length === 0) {
                                document.getElementById('noDataAlert').classList.remove('d-none');
                            } else {
                                data.forEach(dep => {
                                    const row = `<tr>
                            <td>${dep.name}</td>
                            <td>${dep.id}</td>
                            <td>${dep.gender}</td>
                            <td>${dep.relationship}</td>
                            <td>${dep.dob}</td>
                            <td>${dep.age}</td>
                            <td><button class="btn bg-gba">Edit</button></td>
                        </tr>`;
                                    tbody.innerHTML += row;
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error loading the dependants data:', error);
                            document.getElementById('noDataAlert').classList.remove('d-none');
                        });
                });
            });
        </script>


































        {{-- All scripts add new membership are here! --}}

        <script>
            let inputEle = document.querySelector(".input");
            let submitEle = document.querySelector(".add");
            let tasksDiv = document.querySelector(".tasks")
            let containerDiv = document.querySelector(".containerC")
            let deleteAll = document.querySelector(".delete-all");
            let arrayOfTasks = [];
            var commentsData;

            if (window.localStorage.getItem("tasks")) {
                arrayOfTasks = JSON.parse(window.localStorage.getItem("tasks"))
            }

            getTaskFromLocalStorage();

            submitEle.onclick = function() {
                if (inputEle.value !== "") {
                    addTaskToArray(inputEle.value);
                    inputEle.value = "";
                }
            }

            function addTaskToArray(taskText) {
                const task = {
                    id: Date.now(),
                    title: taskText,
                };
                arrayOfTasks.push(task);
                console.log(arrayOfTasks);
                addTaskToPage(arrayOfTasks);

                addTaskToLocalStorage(arrayOfTasks);
            }

            function addTaskToPage(arrayOfTasks) {
                tasksDiv.innerHTML = "";

                arrayOfTasks.forEach((task) => {
                    let div = document.createElement("div");
                    div.className = "task text-black";
                    if (task.complated) {
                        div.className = "task done";
                    }
                    div.setAttribute("data-id", task.id);
                    div.appendChild(document.createTextNode(task.title));
                    let span = document.createElement("span");
                    span.className = "del";
                    span.appendChild(document.createTextNode("Delete"));
                    div.appendChild(span);
                    tasksDiv.appendChild(div);
                    console.log(div);
                });
            }


            function addTaskToLocalStorage(arrayOfTasks) {
                window.localStorage.setItem("tasks", JSON.stringify(arrayOfTasks));
                commentsData = JSON.stringify(arrayOfTasks);
                sendCommentsToServer(commentsData);
            }

            //Functions add last to save to databse
            function sendCommentsToServer(data) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "/add-member", true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        console.log('Comments received on server');
                    }
                };

                xhr.send(data);
            }

            function getTaskFromLocalStorage() {
                let data = window.localStorage.getItem("tasks")
                if (data) {
                    let tasks = JSON.parse(data);
                    // console.log(tasks)
                    addTaskToPage(tasks);
                }
            }

            function addElementsToPageFrom(arrayOfTasks) {
                // Empty Tasks Div
                tasksDiv.innerHTML = "";
                // Looping On Array Of Tasks
                arrayOfTasks.forEach((task) => {
                    // Create Main Div
                    let div = document.createElement("div");
                    div.className = "task";
                    // Check If Task is Done
                    if (task.completed) {
                        div.className = "task done";
                    }
                    div.setAttribute("data-id", task.id);
                    div.appendChild(document.createTextNode(task.title));
                    // Create Delete Button
                    let span = document.createElement("span");
                    span.className = "del";
                    span.appendChild(document.createTextNode("Delete"));
                    // Append Button To Main Div
                    div.appendChild(span);
                    // Add Task Div To Tasks Container
                    tasksDiv.appendChild(div);
                });
            }

            // Click On Task Element
            tasksDiv.onclick = ((e) => {
                if (e.target.classList.contains("del")) {
                    // e.target.parentElement.remove();
                    e.target.parentElement.remove();
                    deleteTaskFromLocalStorage(e.target.parentElement.getAttribute("data-id"));
                }
                if (e.target.classList.contains("task")) {
                    e.target.classList.toggle("done");
                    updateStatusInLocalStorage(e.target.getAttribute("data-id"));
                }
            })


            function deleteTaskFromLocalStorage(taskId) {
                arrayOfTasks = arrayOfTasks.filter((task) => task.id != taskId);
                addTaskToLocalStorage(arrayOfTasks);
            }

            function updateStatusInLocalStorage(taskId) {
                arrayOfTasks.forEach((task) => {
                    if (task.id == taskId)
                        task.complated == false ? task.complated = true : task.complated = false;
                });

                addTaskToLocalStorage(arrayOfTasks);
            }

            deleteAll.onclick = function(e) {
                tasksDiv.innerHTML = "";
                window.localStorage.removeItem("tasks")
            }
        </script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 library --> --}}

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
            document.addEventListener('DOMContentLoaded', (event) => {
                // Check if there's a success message in the session
                @if (Session::has('success'))
                    // Trigger the SweetAlert
                    Swal.fire({
                        text: "{{ Session::get('success') }}",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                @endif
            });
        </script>

        {{-- Start Appending/Removing Comments --}}
        <script>
            document.getElementById('addComment').addEventListener('click', function() {
                const textarea = document.getElementById('floatingTextarea2');
                const text = textarea.value.trim();

                if (text) {
                    // Add comment to array (you might want to have this array globally available)
                    comments.push(text);

                    // Clear the textarea for new comment
                    textarea.value = '';
                    textarea.focus();

                    // Display comment
                    const commentDiv = document.createElement('div');
                    commentDiv.classList.add('saved-comment');
                    commentDiv.textContent = text;
                    textarea.parentNode.insertBefore(commentDiv, textarea);

                    // Optionally, create a new textarea below each comment
                    //const newTextArea = document.createElement('textarea');
                    //newTextArea.classList.add('form-control', 'bg-light', 'text-dark');
                    //newTextArea.style.height = '100px';
                    //commentDiv.parentNode.insertBefore(newTextArea, commentDiv.nextSibling);
                } else {
                    document.querySelector('.invalid-feedback').style.display = 'block';
                    //document.querySelector('.invalid-feedback').textContent = 'Please enter a comment before adding.';
                }
            });

            document.getElementById('removeComment').addEventListener('click', function() {
                if (comments.length > 0) {
                    comments.pop(); // Adjust if you want specific deletion behavior
                    // Assuming last comment is always removed. Modify as needed for your use case.

                    // Remove the last displayed comment
                    const savedComments = document.querySelectorAll('.saved-comment');
                    if (savedComments.length > 0) {
                        const lastComment = savedComments[savedComments.length - 1];
                        lastComment.parentNode.removeChild(lastComment);
                    }
                }
            });

            let comments = []; // Initialize the comments array
        </script>
        {{-- End Appending/Removing Comments --}}

        <script>
            $(document).ready(function() {
                $('#memtype').select2({
                    width: '100%', // Ensures the width of the select matches container
                    placeholder: 'Select Membership Type', // Placeholder if needed
                    allowClear: true // Allows clearing the selection
                });
            });
        </script>

        <script>
            var tasksData, tasks;

            function displayData() {
                // Get data from Local Storage
                tasksData = localStorage.getItem('tasks');
                //console.log(tasksData);
                // Parse the data from JSON format if it exists
                tasks = tasksData ? JSON.parse(tasksData) : [];

                //console.log(tasks);

                // Update hidden form field
                document.getElementById('tasksDataField').value = JSON.stringify(tasks);

            }

            // Attach event listener to the form submit
            document.addEventListener('DOMContentLoaded', function() {
                var form = document.getElementById('memberForm');
                form.addEventListener('submit', displayData);
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.getElementById('memberForm');
                form.addEventListener('submit', function(event) {
                    localStorage.removeItem('tasks'); // Clear the local storage variable upon form submission
                });
            });
        </script>

















<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-membership-btn');
    const header = document.getElementById('kt_header');
    const footer = document.getElementById('kt_footer');

    // Function to hide header and footer
    function hideHeaderFooter() {
        if (header) header.style.display = 'none';
        if (footer) footer.style.display = 'none';
    }

    // Function to show header and footer
    function showHeaderFooter() {
        if (header) header.style.display = '';
        if (footer) footer.style.display = '';
    }

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const membershipId = this.getAttribute('data-id');
            // Clear the modal content before fetching new data
            modalBody.innerHTML = '<div class="text-center">Loading...</div>';
            fetch(`/view-member/${membershipId}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('membershipModalBody').innerHTML = data;
                    hideHeaderFooter();
                });
        });
    });

    // Ensure header and footer are shown when the modal is closed
    document.getElementById('membershipModal').addEventListener('hidden.bs.modal', function () {
        showHeaderFooter();
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.edit-membership-btn');
    const header = document.getElementById('kt_header');
    const footer = document.getElementById('kt_footer');

    // Function to hide header and footer
    function hideHeaderFooter() {
        if (header) header.style.display = 'none';
        if (footer) footer.style.display = 'none';
    }

    // Function to show header and footer
    function showHeaderFooter() {
        if (header) header.style.display = '';
        if (footer) footer.style.display = '';
    }

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const membershipId = this.getAttribute('data-id');
            // Clear the modal content before fetching new data
            modalBody.innerHTML = '<div class="text-center">Loading...</div>';
            fetch(`/edit-member/${membershipId}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('editMembershipModalBody').innerHTML = data;
                    hideHeaderFooter();
                });
        });
    });

    // Ensure header and footer are shown when the modal is closed
    document.getElementById('editMembershipModal').addEventListener('hidden.bs.modal', function () {
        showHeaderFooter();
    });
});
</script>













        {{-- Scripts for View Membership --}}
        <!-- Google maps auto-complete form -->
    <script>
        "use strict";
        Object.defineProperty(exports, "__esModule", {
            value: true
        });
        var autocomplete;
        var address1Field;
        var address2Field;
        var postalField;

        function initAutocomplete() {
            address1Field = document.getElementById("Line1");
            address2Field = document.getElementById("Line2");
            postalField = document.getElementById("PostalCode");
            // Create the autocomplete object, restricting the search predictions to
            // addresses in the US and Canada.
            autocomplete = new google.maps.places.Autocomplete(address1Field, {
                componentRestrictions: {
                    country: ["za"]
                },
                fields: ["address_components", "geometry"],
                types: ["address"],
            });
            address1Field.focus();
            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete.addListener("place_changed", fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();
            var address1 = "";
            var postcode = "";
            // Get each component of the address from the place details,
            // and then fill-in the corresponding field on the form.
            // place.address_components are google.maps.GeocoderAddressComponent objects
            // which are documented at http://goo.gle/3l5i5Mr
            for (const component of place.address_components) {
                // @ts-ignore remove once typings fixed
                const componentType = component.types[0];

                // alert(componentType);

                switch (componentType) {
                    case "street_number": {
                        address1 = `${component.long_name} ${address1}`;
                        break;
                    }

                    case "route": {
                        address1 += component.short_name;
                        break;
                    }

                    case "postal_code": {
                        postcode = component.long_name;

                        break;
                    }

                    case "postal_code_suffix": {
                        postcode = component.long_name;
                        break;
                    }
                    case "locality": {
                        document.getElementById("City").value = component.long_name;
                        break;
                    }
                    case "sublocality_level_1": {
                        document.getElementById("TownSuburb").value = component.long_name;
                        break;
                    }
                    case "administrative_area_level_1": {
                        document.getElementById("Province").value = component.long_name;
                        break;
                    }
                    case "administrative_area_level_2": {
                        document.getElementById("Line2").value = component.long_name;
                        break;
                    }
                    case "country":
                        document.getElementById("Country").value = component.long_name.toUpperCase();
                        break;
                }
            }

            address1Field.value = address1;
            document.getElementById("PostalCode").value = postcode;

            // After filling the form with address components from the Autocomplete
            // prediction, set cursor focus on the second address line to encourage
            // entry of subpremise information such as apartment, unit, or floor number.
            address2Field.focus();
        }
        window.initAutocomplete = initAutocomplete;
    </script>

    <!-- Google maps auto-complete form -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF1KOXQsWQgBsFdgoKlPAa38CS0nTzAmM&libraries=places&callback=initAutocomplete">
    </script>
    {{--
  //This is for the member form - original
  <script>
    function getDOB(IDNumber) {
      var Year = IDNumber.substring(0, 2);
      var Month = IDNumber.substring(2, 4);
      var Day = IDNumber.substring(4, 6);
  
      var cutoff = (new Date()).getFullYear() - 2000;
  
      var Y = (Year > cutoff ? '19' : '20') + Year;
  
  
      document.getElementById("inputYear").value += Y;
      document.getElementById("inputMonth").value += Month;
      document.getElementById("inputDay").value += Day;
  
    }
  
  </script> --}}


    {{-- This is for the member form - Test --}}
    <script>
        function getDOB(IDNumber) {
            // first clear any left over error messages
            $('#error span').remove();
            //This clears the red x mark
            document.getElementById("IDNumber").classList.remove('is-invalid');
            document.getElementById("inputYearDiv").classList.remove('is-invalid');
            document.getElementById("inputMonthDiv").classList.remove('is-invalid');
            document.getElementById("inputDayDiv").classList.remove('is-invalid');

            //This clears the green checkmark
            document.getElementById("IDNumber").classList.remove('is-valid');
            document.getElementById("inputYearDiv").classList.remove('is-valid');
            document.getElementById("inputMonthDiv").classList.remove('is-valid');
            document.getElementById("inputDayDiv").classList.remove('is-valid');

            // store the error div, to save typing
            var error = $('#error');

            // assume everything is correct and if it later turns out not to be, just set this to false
            var correct = true;

            // SA ID Number have to be 13 digits, so check the length
            if (IDNumber.length != 13 || !isNumber(IDNumber)) {
                error.append('<p>SA ID number not a valid number</p>');
                correct = false;
            }
            // get first 6 digits as a valid date
            var tempDate = new Date(IDNumber.substring(0, 2), IDNumber.substring(2, 4) - 1, IDNumber.substring(4, 6));

            var id_date = tempDate.getDate();
            var id_month = tempDate.getMonth();
            var id_year = tempDate.getFullYear();

            var Year = IDNumber.substring(0, 2);

            var cutoff = (new Date()).getFullYear() - 2000;

            var Y = (Year > cutoff ? '19' : '20') + Year;

            var fullDate = id_date + "-" + (id_month + 1) + "-" + id_year;

            if (!((tempDate.getYear() == IDNumber.substring(0, 2)) && (id_month == IDNumber.substring(2, 4) - 1) && (
                    id_date == IDNumber.substring(4, 6)))) {
                error.append('<p>SA ID number not valid</p>');
                correct = false;
            }

            // if no error found, hide the error message
            if (correct) {
                error.css('display', 'none');

                //This adds the green checkmark
                document.getElementById("IDNumber").classList.add('is-valid');
                document.getElementById("inputYearDiv").classList.add('is-valid');
                document.getElementById("inputMonthDiv").classList.add('is-valid');
                document.getElementById("inputDayDiv").classList.add('is-valid');

                // and put together a result message
                document.getElementById("inputYear").value += Y;
                document.getElementById("inputMonth").value += (id_month + 1);
                document.getElementById("inputDay").value += id_date;
            }
            // otherwise, show the error
            else {
                error.css('display', 'block');
                //This adds the green checkmark
                document.getElementById("IDNumber").classList.add('is-invalid');
                document.getElementById("inputYearDiv").classList.add('is-invalid');
                document.getElementById("inputMonthDiv").classList.add('is-invalid');
                document.getElementById("inputDayDiv").classList.add('is-invalid');
            }

            return false;
        }

        function isNumber(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
        }
    </script>

    @endpush
