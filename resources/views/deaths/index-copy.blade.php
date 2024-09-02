@extends('layouts.app2')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <!-- Add Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

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

        /* CSS to change the background color of even rows in the table */
        tbody tr.odd {
            background-color: white;
            /* Light gray background */
        }

        tbody tr.even {
            background-color: white;
            /* Light gray background */
        }

        /* CSS to style the active pagination button */
        ul.pagination li.paginate_button.active a {
            background-color: #02bb86;
            /* Sets the background color to red */
            color: white;
            /* Sets the text color to white for better readability */
            border: 1px forestgreen solid;
            border-radius: 4px;
            /* Optional: Adds rounded corners to the active button */
            padding: 5px 10px;
            /* Optional: Adds some padding to increase the button size */
        }

        /* Additional styling for hover effects on the active button */
        ul.pagination li.paginate_button.active a:hover {
            background-color: #08bb99;
            /* Darkens the red on hover for a nice effect */
        }
    </style>
@endpush

@section('content')
    <div class="bg-gba-light rounded border-gba-light m-8 shadow">
        <div class="bg-gba p-1 m-2 rounded border-gba-light">
            <h1 class="text-center mt-1">{{ $memberships->count() }} Total Membership(s)</h1>
        </div>

        <div class="m-8">
            <table id="membersTable" class="display table table-bordered" style="width:100%">
                <thead>
                    <tr class="bg-gba-light">
                        <th class="text-center" style="width:5%">Show/Hide</th> <!-- for expand/collapse control -->
                        {{-- <th class="text-center">id</th> --}}
                        <th class="text-center" style="width:8%">Dependants</th>
                        <th class="text-center" style="width:15%">Code</th>
                        <th class="text-center" style="width:20%">Main Member</th>
                        <th class="text-center" style="width:15%">Id number</th>
                        <th class="text-center" style="width:10%">Fee</th>
                        <th class="text-center" style="width:10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($memberships as $membership)
                        <tr>
                            <td class="details-control text-center font-extrabold"><i class="bi bi-plus-lg"></i></td>

                            {{-- <td class="text-center">{{ $membership->id }}</td> --}}

                            <td class="text-center">{{ $membership->person->dependant ? $membership->person->dependant->count() : '0' }}
                            </td>

                            <td class="text-center">{{ $membership->membership_code }}</td>

                            <td class="text-center">
                                {{ $membership->person ? $membership->person->first_name : 'N/A' }}
                                {{ $membership->person ? $membership->person->last_name : '' }}
                            </td>

                            <td class="text-center">{{ $membership->id_number }} </td>

                            <td class="text-center">{{ $membership->membership_fee }} </td>

                            <td class="text-center">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal"
                                    class="btn btn-sm btn-icon btn-danger"
                                    data-member-id="{{ $membership->person ? $membership->person->id : '' }}"
                                    title="Mark As Deceased">
                                    <i class="bi bi-person-x-fill fs-4 me-0"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                <form id="recordDeath" method="POST" action="{{ route('StoreFuneralAddress') }}">
                    @csrf
                    <div class="modal-body">

                        <div class="pt-4 p-3">

                            <!-- Contact Details of Person Reporting Death -->
                            <h4 class="text-white mb-3">Contact Details of Person Reporting Death:</h4>
                            <!-- Contact Details of Person Reporting Death -->
                            <div class="row">
                                <div class="col">
                                    <label for="reporting_name" class="form-label text-white">Name:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="reporting_name"
                                        name="reporting_name">
                                </div>
                                <div class="col">
                                    <label for="reporting_surname" class="form-label text-white">Surname:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="reporting_surname"
                                        name="reporting_surname">
                                </div>
                                <div class="col">
                                    <label for="reporting_tel" class="form-label text-white">Tel:</label>
                                    <input type="tel" class="form-control bg-light text-dark" id="reporting_tel"
                                        name="reporting_tel">
                                </div>
                                <div class="col">
                                    <label for="reporting_whatsapp" class="form-label text-white">WhatsApp
                                        yes/no:</label>
                                    <select class="form-control bg-light text-dark" id="reporting_whatsapp"
                                        name="reporting_whatsapp">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="reporting_email" class="form-label text-white">E-mail:</label>
                                    <input type="email" class="form-control bg-light text-dark" id="reporting_email"
                                        name="reporting_email">
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
                                    <label for="deceased_initials" class="form-label text-white">Name:</label>
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
                                </div>
                            </div>
                            <div class="row  my-2">
                                <div class="col">
                                    <label for="deceased_id" class="form-label text-white">ID #:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_id"
                                        name="deceased_id">
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
                        <button type="button" class="btn btn-success" id="recordDeathToFuneralBtn">Record & Begin
                            Funeral</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Death Modal -->
@endsection

@push('scripts')
    <script>
        var myJQuery = jQuery.noConflict(true);
        myJQuery(document).ready(function($) {
            var memberships = @json($memberships);

            var table = $('#membersTable').DataTable({
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                    "className": 'details-control',
                    "data": null,
                    "defaultContent": '<i class="bi bi-plus-lg"></i>'
                }],
                "order": [
                    [1, 'desc']
                ]
            });

            // Add event listener for opening and closing details
            $('#membersTable tbody').on('click', 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var icon = $(this).find('i');

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                    icon.removeClass('bi-dash-lg').addClass('bi-plus-lg'); // Change to collapse icon
                } else {
                    // Open this row to show dependant details
                    var data = row.data();
                    var membership = memberships.find(m => m.id == data[0]);
                    row.child(formatDependants(membership)).show();
                    tr.addClass('shown');
                    icon.removeClass('bi-plus-lg').addClass('bi-dash-lg'); // Change to expand icon
                }
            });

            function formatDependants(membership) {
                if (!membership.person || !membership.person.dependant || membership.person.dependant.length == 0) {
                    return '<tr><td class="bg-warning">No dependants found.</td></tr>';
                }

                var dependantsHtml =
                    '<table cellpadding="2" cellspacing="0" border="0" style="padding-left:20px;">';
                membership.person.dependant.forEach(function(dependant) {
                    dependantsHtml +=
                        '<tr class="bg-info-subtle" style="line-height: 1;">' +
                        // Adjust line-height to reduce spacing
                        '<th scope="row" style="padding: 4px;">Id:</th>' +
                        '<td style="padding: 4px;">' + dependant.secondary_person.id + '</td>' +
                        '<th scope="row" style="padding: 4px;">Name:</th>' +
                        '<td style="padding: 4px;">' + dependant.secondary_person.screen_name + '</td>' +
                        '<th scope="row" style="padding: 4px;">Relationship:</th>' +
                        '<td style="padding: 4px;">' + dependant.relationship_type.description + '</td>' +
                        '<th scope="row" style="padding: 4px;">Id Number:</th>' +
                        '<td style="padding: 4px;">' + dependant.secondary_person.id_number + '</td>' +
                        '<th scope="row" style="padding: 4px;">Action:</th>' +
                        '<td style="padding: 4px;">' +
                        '<a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal" class="btn btn-sm btn-icon btn-danger" data-member-id="' +
                        dependant.secondary_person.id + '" title="Mark As Deceased">' +
                        '<i class="bi bi-person-x fs-4 me-0"></i>' +
                        '</a>' +
                        '</td>' +
                        '</tr>';

                });
                dependantsHtml += '</table>';

                return dependantsHtml;
            }
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
                            $('#deceased_name').val(data.name);
                            $('#deceased_initials').val(data.initials);
                            $('#deceased_surname').val(data.surname);
                            $('#deceased_id').val(data.id_number);
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
@endpush
