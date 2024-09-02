@extends('layouts.app2')

@push('styles')
    <!-- CSS Files -->
    {{-- <link id="pagestyle" href="{{ asset('css/material-dashboard.css?v=3.0.4') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <style>
        #kt_wrapper>#kt_header,
        #kt_footer {
            display: none !important;
        }
    </style>
@endpush

@section('row_content')

        <div class="row">

            <div class="mt-8">

                <ul class="nav nav-pills mb-3 justify-content-evenly" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">
                            <div
                                class="position-relative py-2 px-4 text-bg-secondary border border-secondary rounded-pill">
                                Membership <svg width="1em" height="1em" viewBox="0 0 16 16"
                                    class="position-absolute top-100 start-50 translate-middle mt-1"
                                    fill="var(--bs-secondary)" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                </svg>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">
                            <div
                                class="position-relative py-2 px-4 text-bg-secondary border border-secondary rounded-pill">
                                Dependants <svg width="1em" height="1em" viewBox="0 0 16 16"
                                    class="position-absolute top-100 start-50 translate-middle mt-1"
                                    fill="var(--bs-secondary)" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                </svg>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                            aria-selected="false">
                            <div
                                class="position-relative py-2 px-4 text-bg-secondary border border-secondary rounded-pill">
                                Addresses <svg width="1em" height="1em" viewBox="0 0 16 16"
                                    class="position-absolute top-100 start-50 translate-middle mt-1"
                                    fill="var(--bs-secondary)" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                </svg>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-disabled" type="button" role="tab"
                            aria-controls="pills-disabled" aria-selected="false">
                            <div
                                class="position-relative py-2 px-4 text-bg-secondary border border-secondary rounded-pill">
                                Payments <svg width="1em" height="1em" viewBox="0 0 16 16"
                                    class="position-absolute top-100 start-50 translate-middle mt-1"
                                    fill="var(--bs-secondary)" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                </svg>
                            </div>
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab" tabindex="0">
                        <div id="membership" class="container m-6 text-center mx-auto">
                            <div class="card">
                                <div class="card-title bg-secondary my-0 p-4">
                                    <h2 class="text-center">Membership Details</h2>
                                </div>

                                <div class="card-body fs-6 bg-secondary-subtle">
                                    <!-- Preferred Language Section -->
                                    <div class="mb-7">
                                        <div class="mb-4">
                                            <div class="symbol symbol-60px symbol-circle me-3">
                                                <!-- Placeholder for image or icon -->
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span
                                                    class="fs-4 fw-bold text-dark me-2 text-decoration-underline">Preferred
                                                    Language</span>
                                                <span
                                                    class="fw-semibold text-dark">{{ $membership->language_id == '2' ? 'English' : 'Afrikaans' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="separator separator-dashed mb-7"></div>

                                    

                                    <!-- Personal Details Section -->
                                    <div class="mb-7">
                                        <h5 class="mb-4 text-decoration-underline text-dark">Personal Details</h5>
                                        <div class="mb-0">
    
                                            <span class="fw-semibold text-dark">Name: {{ $membership->name }}</span><br>
                                            <span class="fw-semibold text-dark">Surname:
                                                {{ $membership->surname }}</span><br>
                                            <span class="fw-semibold text-dark">Gender:
                                                @if ($membership->gender_id == 'M')
                                                    Male
                                                @elseif ($membership->gender_id == 'F')
                                                    Female
                                                @else
                                                    Other
                                                @endif

                                                @if (
                                                $membership->gender_id == 'M' ||
                                                    $membership->gender_id == 'm' ||
                                                    $membership->gender_id == '1' ||
                                                    $membership->gender_id == 'male')
                                                <i class="fa-sharp fa-solid fa-person fs-1"></i> {{-- Icon for Male --}}
                                            @elseif (
                                                $membership->gender_id == 'F' ||
                                                    $membership->gender_id == 'f' ||
                                                    $membership->gender_id == '2' ||
                                                    $membership->gender_id == 'female')
                                                <i class="fa-sharp fa-solid fa-person-dress fs-1"></i> {{-- Icon for Female --}}
                                            @else
                                                <i class="fa-sharp fa-solid fa-venus-mars fs-1"></i> {{-- Icon for Other --}}
                                            @endif
                                            </span>
                                            <br>
                                            <span class="fw-semibold text-dark">Identity Number:
                                                {{ $membership->id_number }}</span><br>
                                            <span class="fw-semibold text-dark">Telephone (Cell):
                                                {{ $membership->primary_contact_number }}</span><br>
                                            <span class="fw-semibold text-dark">Email Address:
                                                {{ $membership->primary_e_mail_address }}</span><br>
                                            <!-- Additional details as needed -->
                                        </div>
                                    </div>

                                    <div class="separator separator-dashed mb-7"></div>

                                    <!-- Membership Type Section -->
                                    <div class="mb-10">
                                        <h5 class="mb-4 text-decoration-underline text-dark">Membership Type</h5>
                                        <span class="fw-semibold text-dark">Type: {{ $membership->bu_membership_type_id }}
                                            with fee
                                            R{{ $membership->membership_fee }}</span>
                                        <!-- Replace A1 with actual data -->
                                    </div>
                                    <a class="btn btn-sm btn-warning" href="/edit-member/{{ $membership->id }}"
                                            style="text-decoration: none;"  data-bs-toggle="tooltip" title="Edit"><i class="bi bi-pencil-fill fs-4 me-0"></i>Edit Membership
                                            </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                        tabindex="0">

                        <div id="dependants">
                            <div class="card-body bg-secondary rounded border-bottom p-4 pt-8">
                                <div class="table-responsive p-0">
                                    <h1 class="text-center pb-4">Dependants List</h1>
                                    <table class="table table-bordered border-dark rounded p-0 m-0">
                                        <thead class="text-uppercase bg-gba-light p-0 m-0">
                                            <tr>
                                                <th class="bg-secondary text-center">Name</th>
                                                <th class="bg-secondary text-center">ID</th>
                                                <th class="bg-secondary text-center">Gender</th>
                                                <th class="bg-secondary text-center">Relationship Code</th>
                                                <th class="bg-secondary text-center">Date Of Birth</th>
                                                <th class="bg-secondary text-center">Age</th>
                                                {{-- <th class="bg-secondary text-center">Manage</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody class="bg-light p-0 m-0">
                                            @foreach ($dependants as $dependant)
                                                @php
                                                    $age = ageFromDOB($dependant->personDep->birth_date); // Ensure you have a method to calculate age from DOB
                                                @endphp
                                                <tr>
                                                    <td class="text-center">
                                                        <p class="text-dark ">
                                                            {{ $dependant->personDep->screen_name ?? 'N/A' }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-dark ">
                                                            {{ $dependant->personDep->id_number ?? 'N/A' }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-dark">
                                                            {{ $dependant->personDep->gender_id == 'M' ? 'Male' : ($dependant->personDep->gender_id == 'F' ? 'Female' : 'Other') }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-dark">
                                                            {{ $dependant->person_relationship_id ?? 'Unknown Relationship' }}
                                                        </p>
                                                    </td>

                                                    <td class="text-center">
                                                        <p class="text-dark">
                                                            {{ substr($dependant->personDep->birth_date, 0, 10) ?? 'N/A' }}
                                                        </p>
                                                    </td>
                                                    <td class="text-light justify-content-center badge badge {{ changeAgeBackground($age) }} mt-2 ml-6">
                                                        <span class="text-bold fw-bolder">{{ $age }}</span>
                                                    </td>
                                                    {{-- <td class="text-right">
                                                        <a class="btn btn-sm btn-danger btn-active-light-primary"
                                                            href="/remove-dependant/{{ $dependant->secondary_person_id }}">Remove</a>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                        tabindex="0">

                        <div id="addresses">

                            <div class="card bg-secondary p-4">

                                <div class="card-body pt-4 p-3">
                                    <ul class="list-group">
                                        <h1 class="text-center pb-4">Membership Addresses</h1>
                                        <table
                                            class="table table-bordered mt-4 bg-light bg-blend-lighten border border-dark rounded-3"
                                            id="addressesTable">
                                            <thead>
                                                <tr class="bg-secondary text-dark">
                                                    <th>ID</th>
                                                    <th>Street</th>
                                                    <th>Suburb</th>
                                                    <th>City</th>
                                                    <th>ZIP</th>
                                                    <th>District</th>
                                                    <th>Province</th>
                                                    <th>Created</th>
                                                    {{-- <th>Manage</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data will be fetched and displayed here -->
                                                @foreach ($addresses as $address)
                                                    <tr>
                                                        <td>{{ $address->id ?? 'N/A' }}</td>
                                                        <td>{{ $address->line1 ?? 'N/A' }}</td>
                                                        <td>{{ $address->suburb ?? 'N/A' }}</td>
                                                        <td>{{ $address->city ?? 'N/A' }}</td>
                                                        <td>{{ $address->ZIP ?? 'N/A' }}</td>
                                                        <td>{{ $address->district ?? 'N/A' }}</td>
                                                        <td>{{ $address->province ?? 'N/A' }}</td>
                                                        <td>{{ $address->created_at ?? 'N/A' }}</td>

                                                        {{-- <td>
                                                            <button onclick="deleteAddress({{ $address->id }})" class="btn btn-danger">Delete</button>
                                                            <form id="delete-address-form"
                                                                action="/delete-address/{{ $address->id }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Are you sure you want to delete this address?')">Delete</button>
                                                            </form>
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </ul>
                                </div>
                            </div>

                            <!-- Addresses List -->

                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab"
                        tabindex="0">

                        <div id="payments">

                            <div class="card-body px-3 pt-4 pb-2 bg-secondary rounded mt-2">
                                <div class="table-responsive pt-4">
                                    <h1 class="text-center">Payments History</h1>
                                    <table
                                        class="table table-bordered table-bordered mt-8 bg-light bg-blend-lighten border border-dark rounded-3"
                                        id="datatable-billing">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase font-weight-bolder bg-secondary">Bill ID</th>
                                                <th class="text-uppercase font-weight-bolder bg-secondary">Date Issued
                                                </th>
                                                <th class="text-uppercase font-weight-bolder bg-secondary">Amount</th>
                                                <th class="text-uppercase font-weight-bolder bg-secondary">Status</th>
                                                <th class="text-uppercase font-weight-bolder bg-secondary">Due Date
                                                </th>
                                                {{-- <th class="text-uppercase font-weight-bolder bg-secondary">Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (empty($billings))
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        <div class="alert alert-danger" role="alert">
                                                            This membership does not have any billing history.
                                                        </div>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($billings as $billing)
                                                    @if ($billing->membership_id == $membership->id)
                                                        <tr>
                                                            <td>{{ $billing->id }}</td>
                                                            <td>{{ $billing->transaction_date }}</td>
                                                            <td>{{ number_format($billing->receipt_value, 2) }}
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge {{ $billing->transaction_description == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                                                    {{ ucfirst($billing->transaction_description) }}
                                                                </span>
                                                            </td>
                                                            <td>{{ $billing->created_at }}</td>
                                                            {{-- <td>
                                                                <form id="delete-billing-form"
                                                                    action="/delete-billing/{{ $billing->id }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('Are you sure you want to delete this billing?')"><i
                                                                            class="material-icons text-sm">delete_outline</i>Remove</button>
                                                                </form>

                                                            </td> --}}
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="p-3 bg-secondary-gradient justify-content-center">
                                <h4 class="text-center">Add Payment: <span><a class="icon-link icon-link-hover"
                                            style="--bs-link-hover-color-rgb: 25, 135, 84;" href="/payments"> Make
                                            Payment (<i class="bi bi-cash-coin fs-3 text-success"></i>)</a></span></h4>
                            </div>
                            <!-- Payment Details Modal End -->
                        </div>


                    </div>
                </div>

            </div>

        </div>

    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script> --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection

@push('scripts')
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('#datatable-dependant tbody tr');

            searchInput.addEventListener('keyup', function() {
                const searchQuery = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    const isVisible = rowText.includes(searchQuery);
                    row.style.display = isVisible ? '' : 'none';
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rowsPerPage = 5;
            const rows = document.querySelectorAll('#datatable-dependant tbody tr');
            const rowsCount = rows.length;
            const pageCount = Math.ceil(rowsCount / rowsPerPage);
            const pagination = document.getElementById('pagination');

            function setPage(page) {
                rows.forEach((row, index) => {
                    row.style.display = (index >= page * rowsPerPage && index < (page + 1) * rowsPerPage) ?
                        '' : 'none';
                });
            }

            for (let i = 0; i < pageCount; i++) {
                const btn = document.createElement('button');
                btn.innerText = i + 1;
                btn.addEventListener('click', () => setPage(i));
                pagination.appendChild(btn);
            }

            setPage(0); // Set initial page
        });
    </script>



    <!-- Bootstrap CSS CDN -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    {{-- Start Modal Script --}}
    <script>
        var elements = Array.prototype.slice.call(document.querySelectorAll("[data-bs-stacked-modal]"));
        if (elements && elements.length > 0) {
            elements.forEach((element) => {
                if (element.getAttribute("data-kt-initialized") === "1") {
                    return;
                }
                element.setAttribute("data-kt-initialized", "1");
                element.addEventListener("click", function(e) {
                    e.preventDefault();
                    const modalEl = document.querySelector(this.getAttribute("data-bs-stacked-modal"));
                    if (modalEl) {
                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    }
                });
            });
        }
    </script>
    {{-- End Modal Script --}}

    {{-- No Data List Found  Alert --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Example: Check if there are any dependants listed in your table's tbody
            var dependantsList = document.querySelector('#dependants .table-responsive tbody');

            // Assuming your data loading logic updates the dependantsList innerHTML or children count
            if (dependantsList.children.length === 0) {
                // If there are no dependants, show the alert
                document.getElementById('noDataAlert').style.display = 'flex';
            } else {
                // If there are dependants, ensure the alert is not shown
                document.getElementById('noDataAlert').style.display = 'none';
            }
        });
    </script>

    {{-- Start dependants population --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('kt_modal_stacked_2');

            modal.addEventListener('shown.bs.modal', function() {
                fetch('') // Adjust the API endpoint as needed
                    .then(response => response.json())
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
                    .catch(error => console.error('Error loading the dependants data:', error));
            });
        });
    </script> --}}
    {{-- End dependants population --}}

    {{-- Start Address population --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('kt_modal_stacked_3');

        var addressDataUrl = "<?php echo env('ADDRESS_DATA_URL'); ?>";
        console.log(addressDataUrl); // This will log the value from the .env file

            modal.addEventListener('shown.bs.modal', function() {
                fetch(addressDataUrl) // Adjust the API endpoint as needed
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('addressesBody');
                        tbody.innerHTML = ''; // Clear existing rows
                        if (data.length === 0) {
                            document.getElementById('noAddressesAlert').classList.remove('d-none');
                        } else {
                            data.forEach(addr => {
                                const row = `<tr>
                            <td>${addr.address}</td>
                            <td>${addr.city}</td>
                            <td>${addr.state}</td>
                            <td>${addr.country}</td>
                            <td>${addr.postalCode}</td>
                            <td><button class="btn btn-info">Edit</button></td>
                        </tr>`;
                                tbody.innerHTML += row;
                            });
                        }
                    })
                    .catch(error => console.error('Error loading the addresses data:', error));
            });
        });
    </script>
    {{-- End Address population --}}

    <!-- Including jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#datatable-dependant').DataTable({
                "pagingType": "simple", // Enable simple pagination
                "lengthChange": false, // Disable the ability to change the number of records shown
                "pageLength": 10 // Set default number of rows to 10
            });
        });
    </script>
@endpush
