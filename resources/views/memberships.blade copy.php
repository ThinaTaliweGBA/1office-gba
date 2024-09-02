@extends('layouts.app2')

@push('styles')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
    <style>
        .dt-buttons {
            padding-top: 15px;
        }

        .dt-buttons .buttons-copy,
        .dt-buttons .buttons-csv,
        .dt-buttons .buttons-excel,
        .dt-buttons .buttons-pdf,
        .dt-buttons .buttons-print {
            background-color: #02bb86;
        }

        .membership-page .dataTables_filter label {
            color: black;
            padding-top: 2px;
        }

        .dataTables_filter .form-control {
            background-color: white;
        }

        tbody tr.odd,
        tbody tr.even {
            background-color: white;
        }

        ul.pagination li.paginate_button.active a {
            background-color: #02bb86;
            color: white;
            border: 1px forestgreen solid;
            border-radius: 4px;
            padding: 5px 10px;
        }

        ul.pagination li.paginate_button.active a:hover {
            background-color: #08bb99;
        }
    </style>

    <style>
        /* Style for the button group container */
        .dt-buttons.btn-group.flex-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            /* Adjusts the space between buttons */
        }

        /* General button styles */
        .dt-buttons .btn {
            background-color: #02bb86 !important;
            /* Primary blue color */
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        /* Hover effect */
        .dt-buttons .btn:hover {
            background-color: #08bb02 !important;
            /* Darker blue for hover */
        }
    </style>

    <style>
        #searchbox {
            position: relative;
        }

        #searchbox>#searchinput {
            position: relative;
        }

        #searchbox>#searchbtn {
            position: absolute;
            font-size: 0.5em;
            right: 4px;
            top: 4px;
            z-index: 1000;
            /* Higher z-index to keep the button above the input */
        }

        #searchbox,
        #searchinput,
        #searchbtn {
            border-radius: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="card border-gba bg-gba-light shadow-lg m-16">
        <h2 class="text-center mt-4">Membership Search</h2>
        <div class="row mb-4">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <form method="GET" action="{{ route('memberships') }}">
                    <div class="input-group" id="searchbox">
                        <input id="searchinput" type="text" name="search" class="form-control" placeholder="Search..."
                            value="{{ request()->input('search') }}" style="background-color: white; color: black;">
                        <button id="searchbtn" class="btn btn-sm" type="submit"
                            style="background-color: #02bb86">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">

            </div>
            {{-- <div class="col-md-6 text-end">
                <a href="{{ route('memberships.export') }}" class="btn btn-success" id="export-btn">Export</a>
            </div> --}}
        </div>

        <div class="table-responsive mx-4 mt-2">
            <table class="table table-flush" id="memberships-table">
                <thead class="thead-light bg-gba">
                    <tr class="fw-bold text-dark bg-gba p-3">
                        <th class="text-center">Name</th>
                        <th class="text-center">Surname</th>
                        <th class="text-center">ID Number</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Telephone</th>
                        <th class="text-center">Join Date</th>
                        <th class="text-center">End Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($memberships as $membership)
                        <tr class="bg-gba border">
                            <td class="text-m font-weight-normal pt-3 text-dark fw-bold text-hover-primary text-center"
                                style="padding-left: 12px">
                                {{ $name = $membership->name ?? 'N/A' }}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center" style="padding-left: 12px">
                                {{ $surname = $membership->surname ?? 'N/A' }}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                {{ $id_number = $membership->id_number ?? 'N/A' }}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center" style="padding-left: 24px">
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
                                {{ $endDateFormatted = $membership->end_date ? Carbon\Carbon::parse($membership->end_date)->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center" style="padding-left: 24px">
                                <span
                                    class="badge badge-light-primary fs-7 fw-bold bg-gba-light">{{ $statuses[$membership->bu_membership_status_id] }}</span>
                                {{-- <span class="badge badge-light-primary fs-7 fw-bold">{{ $membership->status }}</span> --}}
                            </td>
                            <td class="text-m font-weight-normal pt-3 text-center">
                                <span class="badge bg-success fs-7 fw-bold m-1 p-2">
                                    <a class="text-light" href="/view-member/{{ $membership->id }}"
                                        style="text-decoration: none;"><i class="bi bi-eye-fill"></i> View</a>
                                </span>
                                <span class="badge bg-warning fs-7 fw-bold m-1 p-2">
                                    <a class="text-light" href="/edit-member/{{ $membership->id }}"
                                        style="text-decoration: none;"><i class="bi bi-pencil-fill"></i> Edit</a>
                                </span>
                                <span class="badge bg-danger fs-7 fw-bold m-1 p-2">
                                    <a class="text-light" href="#"
                                        onclick="deleteConfirm('/cancel-member/{{ $membership->id }}')"
                                        style="text-decoration: none;"><i class="bi bi-trash3-fill"></i> Delete
                                    </a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mb-8">
            {!! $memberships->appends(['search' => request()->input('search')])->links() !!}
        </div>
    </div>

@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#memberships-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush

