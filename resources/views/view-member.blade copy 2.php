@extends('layouts.app2')

@push('styles')
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/material-dashboard.css?v=3.0.4') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('row_content')
    <!-- Stacked Modal End -->
    <div class="modal bg-body fade" tabindex="-1" id="kt_modal_2" style="margin-right: 12px !important;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Membership Code: {{ $membership->membership_code }}</h5>
                    <a type="button" class="btn-closes bg-danger p-1 bordered" data-bs-dismiss="modal" onclick="window.history.back();"
                        aria-label="Close"><i class="bi bi-x-circle"></i></a>
                </div>
                <div class="modal-body">

                    <div class="row text-center">
                        <div class="col-4">
                            <button type="button" class="btn bg-gba" data-bs-stacked-modal="#kt_modal_stacked_2">
                                View Dependants
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn bg-gba" data-bs-stacked-modal="#kt_modal_stacked_3">
                                View Addresses
                            </button>
                        </div>
                        <div class="col-4">

                            <button type="button" class="btn bg-gba" data-bs-stacked-modal="#kt_modal_stacked_4">
                                View Billing History
                            </button>
                        </div>
                    </div>

                    <!-- Membership Details View-Only Section -->
                    <div id="membership" class="container bg-gba-light m-6 text-center mx-auto border-gba">
                        <div class="card">
                            <div class="card-title bg-gba my-0">
                                <h2 class="text-center">Membership Details</h2>
                            </div>

                            <div class="card-body fs-6 bg-gba-light">
                                <!-- Preferred Language Section -->
                                <div class="mb-7">
                                    <div class="mb-4">
                                        <div class="symbol symbol-60px symbol-circle me-3">
                                            <!-- Placeholder for image or icon -->
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fs-4 fw-bold text-gray-900 me-2">Preferred
                                                Language</span>
                                            <span
                                                class="fw-semibold text-white">{{ $membership->language == '1' ? 'English' : 'Afrikaans' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="separator separator-dashed mb-7"></div>

                                <!-- Personal Details Section -->
                                <div class="mb-7">
                                    <h5 class="mb-4">Personal Details</h5>
                                    <div class="mb-0">
                                        <span class="fw-semibold text-white">Name: {{ $membership->name }}</span><br>
                                        <span class="fw-semibold text-white">Surname:
                                            {{ $membership->surname }}</span><br>
                                        <span class="fw-semibold text-white">Gender:
                                            {{ $membership->gender_id }}</span><br>
                                        <span class="fw-semibold text-white">Identity Number:
                                            {{ $membership->id_number }}</span><br>
                                        <span class="fw-semibold text-white">Telephone (Cell):
                                            {{ $membership->primary_contact_number }}</span><br>
                                        <span class="fw-semibold text-white">Email Address:
                                            {{ $membership->primary_e_mail_address }}</span><br>
                                        <span class="fw-semibold text-white">Date of Birth:
                                            {{ $membership->dob }}</span><br>
                                        <!-- Additional details as needed -->
                                    </div>
                                </div>

                                <div class="separator separator-dashed mb-7"></div>

                                <!-- Membership Type Section -->
                                <div class="mb-10">
                                    <h5 class="mb-4">Membership Type</h5>
                                    <span class="fw-semibold text-white">Type: </span>
                                    <!-- Replace A1 with actual data -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Membership Details View-Only Section -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="window.history.back();">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="kt_modal_stacked_2">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">View Dependants</h3>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2 bg-danger" data-bs-dismiss="modal"
                        aria-label="Close"><i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="dependants">
                        <h2>Dependants Content</h2>
                        <p class="text-dark fw-semibold fs-6">See all your dependant details.</p>

                        <!-- Alert for no data -->
                        <div class="alert alert-danger d-none" id="noDataAlert">
                            <strong>No Dependants Found:</strong> Your list of dependants is currently empty.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <!-- Dependants List -->
                        <div class="card bg-secondary">
                            <div class="card-header">
                                <h3 class="fw-bold">Dependants List</h3>
                            </div>
                            <div class="card-body">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>ID</th>
                                            <th>Gender</th>
                                            <th>Relationship</th>
                                            <th>DOB</th>
                                            <th>Age</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dependantsBody">
                                        <!-- Rows will be added here dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Stacked Modal End -->

    <!-- Start Stacked Modal for Address Management -->
    <div class="modal fade" tabindex="-1" id="kt_modal_stacked_3">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title mx-auto">Addresses</h3>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2 bg-danger"
                        data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addresses">
                        <p class="text-dark fw-semibold fs-6 mx-auto">See all your address details.</p>

                        <!-- Alert for No Addresses Found (hidden by default) -->
                        <div class="alert alert-danger d-none" id="noAddressesAlert">
                            <strong>No Addresses Found:</strong> Your list of addresses is currently empty.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>

                        <!-- Addresses List -->
                        <div class="card bg-secondary">
                            <div class="card-header">
                                <h3 class="fw-bold">Existing Addresses</h3>
                            </div>
                            <div class="card-body">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>Postal Code</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="addressesBody">
                                        <!-- Rows will be added here dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Stacked Modal -->

    {{-- Start Stacked Modal --}}

    <!-- Payment Details Modal Start -->
    <div class="modal fade" tabindex="-1" id="kt_modal_stacked_4">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Payment Details</h3>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2 bg-danger"
                        data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="payments">
                        <h2>Payments Content</h2>
                        <p class="text-dark fw-semibold fs-6">See all your payment details.</p>

                        <!-- Billing History Card -->
                        <div class="card mt-4 bg-secondary">
                            <div class="card-header">
                                <h3 class="fw-bold">Billing History</h3>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-row-bordered align-middle">
                                        <thead class="border-bottom border-gray-200 fs-6 text-gray-600 fw-bold bg-light">
                                            <tr>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody id="billingHistoryBody">
                                            <!-- Dynamically populated rows will go here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment Details Modal End -->

    {{-- End Stacked Modal --}}
    <!-- Bootstrap Bundle with Popper -->
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script> --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection

@push('scripts')
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('kt_modal_2'), {
                keyboard: false,
                backdrop: 'static' // Prevent closing by clicking outside or pressing escape
            });
            myModal.show();

            document.getElementById('kt_modal_2').addEventListener('hidden.bs.modal', function(event) {
                // Redirect user or perform another action after the modal is closed
                // For example, to redirect to another page:
                // window.location.href = 'https://www.example.com';

                // Or simply make sure the user cannot interact with the page content
                document.body.classList.add(
                    "modal-open"); // Re-add class to body to maintain modal-open state
            });
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
    <script>
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
    </script>
    {{-- End dependants population --}}

    {{-- Start Address population --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('kt_modal_stacked_3');

            modal.addEventListener('shown.bs.modal', function() {
                fetch('') // Adjust the API endpoint as needed
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

    {{-- Start script to populate they table for billing --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var paymentModal = document.getElementById('kt_modal_stacked_4');

            paymentModal.addEventListener('shown.bs.modal', function() {
                fetch('') // Adjust the API endpoint as needed
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('billingHistoryBody');
                        tbody.innerHTML = ''; // Clear existing rows
                        if (data && data.length > 0) {
                            data.forEach(payment => {
                                const row = `<tr>
                            <td>${payment.date}</td>
                            <td>${payment.description}</td>
                            <td>${payment.amount}</td>
                            <td><a href="#" target="_blank">View</a></td>
                        </tr>`;
                                tbody.innerHTML += row;
                            });
                        } else {
                            tbody.innerHTML =
                                '<tr><td colspan="4" class="text-center">No payment details available</td></tr>';
                        }
                    })
                    .catch(error => {
                        console.error('Error loading the payment data:', error);
                        const tbody = document.getElementById('billingHistoryBody');
                        tbody.innerHTML =
                            '<tr><td colspan="4" class="text-center">Failed to load data</td></tr>';
                    });
            });
        });
    </script>
    {{-- End script to populate they table for billing --}}
@endpush
