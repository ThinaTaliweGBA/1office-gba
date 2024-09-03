@extends('layouts.app2')

@push('styles')
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }

        .btn-toggle-expand {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-toggle-expand i {
            color: white;
        }

        .card {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .th, .td {
            padding: 8px 16px;
            border: 1px solid #ddd;
        }
    </style>

@endpush

@section('row_content')
<div class="card shadow">
    <div class="card-header">
        <h2 class="card-title emphasis">Deaths</h2>
        <div class="card-toolbar">
            <input type="text" id="searchInput" class="form-control search-box shadow-sm" placeholder="Deaths Search...">
        </div>
    </div>
    <div class="card-body">
        <div id="noResultsAlert" class="alert alert-warning text-center m-0" role="alert" style="display: none;">
        No results found for the search query.
    </div>
       <div class="accordion shadow-sm" id="parentChildAccordion">
        @foreach ($memberships as $membership)
            <div class="accordion-item bg-gray-200">
                <h2 class="accordion-header" id="heading{{ $membership->membership_code }}">
                    <button class="accordion-button collapsed bg-gray-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $membership->membership_code }}" aria-expanded="false" aria-controls="collapse{{ $membership->membership_code }}">
                       <a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal" class="btn btn-icon btn-danger btn-sm me-4" data-member-id="{{ $membership->person->id }}" title="Mark As Deceased"><i class="fa fa-user-minus"></i></a> 
                       {{ $membership->person->first_name ?? 'N/A' }} {{ $membership->person->surname }} - {{ $membership->membership_code }}                
                    </button>
                </h2>
                <div id="collapse{{ $membership->membership_code }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $membership->membership_code }}" data-bs-parent="#parentChildAccordion">
                    <div class="accordion-body">
                        <table class="table table-sm table-bordered dependants-table" id="table{{ $membership->membership_code }}">
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
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#record_death_modal" class="btn btn-icon btn-danger btn-sm" data-member-id="{{ $dependant->personDep->id }}" title="Mark As Deceased">
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
    <div class="card-footer">
         <nav>
        <ul class="pagination justify-content-center" id="pagination">
        </ul>
    </nav>
    </div>
</div>

    <!-- Start Death Modal -->
    <div class="modal fade" tabindex="-1" id="record_death_modal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title ">Record Death</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-dark ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <form id="recordDeath" method="POST" action="{{ route('deaths.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="deceased_id" name="deceased_id">
                        <div class="pt-4 p-3">
                            <h4 class=" mb-3">Contact Details of Person Reporting Death:</h4>
                            <div class="row">
                                <div class="col">
                                    <label for="reporter_name" class="form-label ">Name:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="reporter_name" name="reporter_name">
                                </div>
                                <div class="col">
                                    <label for="reporter_surname" class="form-label ">Surname:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="reporter_surname" name="reporter_surname">
                                </div>
                                <div class="col">
                                    <label for="reporter_tel" class="form-label ">Tel:</label>
                                    <input type="tel" class="form-control bg-light text-dark" id="reporter_tel" name="reporter_tel">
                                </div>
                                <div class="col">
                                    <label for="reporter_whatsapp" class="form-label ">WhatsApp yes/no:</label>
                                    <select class="form-control bg-light text-dark" id="reporter_whatsapp" name="reporter_whatsapp">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="reporter_email" class="form-label ">E-mail:</label>
                                    <input type="email" class="form-control bg-light text-dark" id="reporter_email" name="reporter_email">
                                </div>
                            </div>
                            <div class="separator border-light my-8"></div>
                            <div class="row">
                                <div class="col">
                                    <label for="tracking_number" class="form-label ">Tracking Number:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="tracking_number" name="tracking_number" placeholder="20240321/1453" readonly>
                                </div>
                            </div>
                            <div class="separator border-light my-8"></div>
                            <h4 class=" mb-3">Deceased Person's Details:</h4>
                            <div class="row">
                                <div class="col">
                                    <label for="deceased_name" class="form-label ">Name:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_name" name="deceased_name">
                                </div>
                                <div class="col">
                                    <label for="deceased_initials" class="form-label ">Initials:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_initials" name="deceased_initials">
                                </div>
                                <div class="col">
                                    <label for="deceased_surname" class="form-label ">Surname:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_surname" name="deceased_surname">
                                </div>
                                <div class="col">
                                    <label for="deceased_maiden_name" class="form-label ">Maiden Name:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_maiden_name" name="deceased_maiden_name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="deceased_address" class="form-label ">Address:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_address" name="deceased_address">
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
                                    <label for="deceased_id_number" class="form-label ">ID Number:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_id_number" name="deceased_id_number">
                                </div>
                                <div class="col">
                                    <label for="deceased_birth_date" class="form-label ">Birth Date:</label>
                                    <input type="date" class="form-control bg-light text-dark" id="deceased_birth_date" name="deceased_birth_date">
                                </div>
                                <div class="col">
                                    <label for="deceased_age" class="form-label ">Age:</label>
                                    <input type="number" class="form-control bg-light text-dark" id="deceased_age" name="deceased_age">
                                </div>
                                <div class="col">
                                    <label for="deceased_birth_town" class="form-label ">Birth Town:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_birth_town" name="deceased_birth_town">
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
                                    <label for="deceased_sex" class="form-label ">Sex:</label>
                                    <select class="form-control" id="deceased_sex" name="deceased_sex">
                                        <option value="" disabled selected>Select Sex</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="deceased_marital_status" class="form-label ">Marital Status:</label>
                                    <select class="form-control" id="deceased_marital_status" name="deceased_marital_status">
                                        <option value="" disabled selected>Select Marital Status</option>
                                        @foreach ($maritalStatuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="deceased_language" class="form-label ">Language:</label>
                                    <select class="form-control" id="deceased_language" name="deceased_language">
                                        <option value="" disabled selected>Select Language</option>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="deceased_occupation" class="form-label ">Occupation:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_occupation" name="deceased_occupation">
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col">
                                    <label for="deceased_dr_number" class="form-label ">DR (BI 1663 NR):</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_dr_number" name="deceased_dr_number">
                                </div>
                                <div class="col">
                                    <label for="deceased_date_of_death" class="form-label ">Date of Death:</label>
                                    <input type="date" class="form-control bg-light text-dark" id="deceased_date_of_death" name="deceased_date_of_death">
                                </div>
                                <div class="col">
                                    <label for="deceased_place_of_death" class="form-label ">Place of Death:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_place_of_death" name="deceased_place_of_death">
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
                                    <label for="deceased_doctor" class="form-label ">Doctor:</label>
                                    <input type="text" class="form-control bg-light text-dark" id="deceased_doctor" name="deceased_doctor">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="recordDeathToFuneralBtn">Record & Begin Funeral</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Death Modal -->
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

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
            var noResults = true;
            $('.accordion-item').filter(function() {
                var match = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(match);
                if (match) noResults = false;
            });
            $('#noResultsAlert').toggle(noResults);
        });

        // Pagination logic
        var itemsPerPage = 5;
        var $accordionItems = $('.accordion-item');
        var totalItems = $accordionItems.length;
        var totalPages = Math.ceil(totalItems / itemsPerPage);

        function showPage(page) {
            var start = (page - 1) * itemsPerPage;
            var end = start + itemsPerPage;
            $accordionItems.hide().slice(start, end).show();
        }

        function createPagination() {
            var $pagination = $('#pagination');
            $pagination.empty();

            for (var i = 1; i <= totalPages; i++) {
                var $li = $('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>');
                $li.on('click', function(e) {
                    e.preventDefault();
                    var page = parseInt($(this).text());
                    showPage(page);
                    $(this).addClass('active').siblings().removeClass('active');
                });
                $pagination.append($li);
            }
            $pagination.find('li:first').addClass('active');
        }

        createPagination();
        showPage(1);
    });
</script>

@endpush
